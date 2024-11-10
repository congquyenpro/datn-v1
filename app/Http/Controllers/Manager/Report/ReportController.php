<?php

namespace App\Http\Controllers\Manager\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function showTransaction()
    {
        $transactions = $this->reportService->getAll();
        //dd($transactions);
        return view('manager.report.transaction',compact('transactions'));
    }

    public function showFin()
    {
        return view('manager.report.fin');
    }
    public function showSale()
    {
        return view('manager.report.sale');
    }


    public function getRevenue(Request $request)
    {
        $data = [];
        $data['sale'] = $this->getSalesReport($request->start_date, $request->end_date);

        //Lấy thêm dữ liệu từ 1 tháng trước để so sánh
        $start_date_prev = date('Y-m-d', strtotime($request->start_date . ' -1 month'));
        $end_date_prev = date('Y-m-d', strtotime($request->end_date . ' -1 month'));
        $data['sale_last_month'] = $this->getSalesReport($start_date_prev, $end_date_prev);

        $data['transaction'] = $this->getTransaction($request->start_date, $request->end_date);
        return response()->json($data);
    }


    public function getSalesReport($startDate, $endDate)
    {
        $query = "
        SELECT 
            COALESCE(SUM(CASE WHEN od.status NOT IN (0, 6, 7) THEN oi.item_value ELSE 0 END), 0) AS total_sale,
            COALESCE(SUM(CASE WHEN od.status = 7 THEN oi.item_value ELSE 0 END), 0) AS total_return_sale,
            COALESCE(SUM(CASE WHEN od.status NOT IN (0, 6, 7) THEN oi.entry_price ELSE 0 END), 0) AS total_entry_value,
            COALESCE(SUM(CASE WHEN od.status NOT IN (0, 6, 7) THEN od.shipping_cost ELSE 0 END), 0) AS total_shipping_cost
            
        FROM orders AS od
        JOIN order_items oi ON oi.order_id = od.id
        WHERE 
            od.order_date BETWEEN ? AND ?
        ";
        $query2 = "
        SELECT 
            COALESCE(SUM(CASE WHEN od.status NOT IN (0, 6, 7) THEN od.shipping_cost ELSE 0 END), 0) AS total_shipping_cost
        FROM orders AS od
        WHERE 
            od.order_date BETWEEN ? AND ?
        ";
    
/*         $startDate = "2024-11-09 16:28:04";
        $endDate = "2024-12-09 16:29:0"; */

        // Thực thi query với tham số
        $salesData = \DB::select($query, [$startDate, $endDate]);
        $shipping_cost = \DB::select($query2, [$startDate, $endDate]);

        $total_sale = $salesData[0]->total_sale;
        $total_return_sale = $salesData[0]->total_return_sale;
        $total_entry_value = $salesData[0]->total_entry_value;
        $total_shipping_cost = $shipping_cost[0]->total_shipping_cost;
        
        //1. Doanh thu bán hàng = Tiền hàng thực bán + (Thuế VAT, Phí giao hàng thu khách, Chiết khấu) (set = 0)
        $total_real_sale = $total_sale - $total_return_sale; // = revenue
        $revenue = $total_real_sale;

        //2. Chi phí bán hàng = Tổng giá vốn + Tổng phí giao hàng + Thanh toán bằng điểm (=0)
        $total_cost_sale = $total_entry_value + $total_shipping_cost; // = cost

        //3. Thu nhập khác = Phiếu thu + phí khách trả hàng (Hiện tại chưa có)
        $other_income = 0;

        //4. Chi phí khác = Phiếu chi (Hiện tại lấy từ transaction)
        $other_cost = (int) $this->getTransaction($startDate, $endDate)[0]->total_trans_out;

        //Lợi nhuận = Doanh thu bán hàng - Chi phí bán hàng + Thu nhập khác - Chi phí khác = 1 - 2 + 3 - 4
        $profit = $revenue - $total_cost_sale + $other_income - $other_cost;

        return [
            'total_sale' => $total_sale,
            'total_return_sale' => $total_return_sale,
            'total_entry_value' => $total_entry_value,
            'total_shipping_cost' => $total_shipping_cost,
            'total_real_sale' => $total_real_sale,
            'revenue' => $revenue,
            'total_cost_sale' => $total_cost_sale,
            'other_income' => $other_income,
            'other_cost' => $other_cost,
            'profit' => $profit
        ];
    }

    public function getTransaction($startDate, $endDate)
    {
        $query = "
            SELECT 
                COALESCE(SUM(tb.amount_in), 0) AS total_trans_in,
                COALESCE(SUM(tb.amount_out), 0) AS total_trans_out
            FROM tb_transactions AS tb
            WHERE tb.created_at BETWEEN ? AND ?
        ";
/*         $startDate = "2024-11-06 03:00:04";
        $endDate = "2024-12-09 16:29:0"; */
        $transactions = \DB::select($query, [$startDate, $endDate]);
        return $transactions;
    }


    //Lấy doanh thu theo tháng
    public function getRevenueByMonth(Request $request)
    {
        $data = [];
        
        // Xác định năm (nếu có truyền vào từ request, nếu không sẽ mặc định lấy năm hiện tại)
        $year = $request->input('year', date('Y'));
    
        // Lặp qua tất cả các tháng trong năm (từ tháng 1 đến tháng 12)
        for ($month = 1; $month <= 12; $month++) {
            // Xác định ngày bắt đầu và kết thúc của tháng
            $startDate = date('Y-m-01 00:00:00', strtotime("$year-$month-01"));
            $endDate = date('Y-m-t 23:59:59', strtotime("$year-$month-01"));
    
            // Gọi hàm getSalesReport để lấy thông tin doanh thu và lợi nhuận
            $salesData = $this->getSalesReport($startDate, $endDate);
            
            // Lưu thông tin doanh thu, chi phí, lợi nhuận cho tháng hiện tại
            $data[] = [
                'month' => $month,
                'revenue' => $salesData['revenue'],
                'total_sale' => $salesData['total_sale'],
                'total_return_sale' => $salesData['total_return_sale'],
                'total_entry_value' => $salesData['total_entry_value'],
                'total_shipping_cost' => $salesData['total_shipping_cost'],
                'total_real_sale' => $salesData['total_real_sale'],
                'total_cost_sale' => $salesData['total_cost_sale'],
                'other_income' => $salesData['other_income'],
                'other_cost' => $salesData['other_cost'],
                'profit' => $salesData['profit'],
            ];
        }
    
        return response()->json($data);
    }

    public function getRevenueByDay(Request $request) {
        $data = [];
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $startDate = date('Y-m-d 00:00:00', strtotime("$year-$month-$day"));
            $endDate = date('Y-m-d 23:59:59', strtotime("$year-$month-$day"));
            $salesData = $this->getSalesReport($startDate, $endDate);
            $data[] = [
                'day' => $day,
                'revenue' => $salesData['revenue'],
                'total_sale' => $salesData['total_sale'],
                'total_return_sale' => $salesData['total_return_sale'],
                'total_entry_value' => $salesData['total_entry_value'],
                'total_shipping_cost' => $salesData['total_shipping_cost'],
                'total_real_sale' => $salesData['total_real_sale'],
                'total_cost_sale' => $salesData['total_cost_sale'],
                'other_income' => $salesData['other_income'],
                'other_cost' => $salesData['other_cost'],
                'profit' => $salesData['profit'],
            ];
        }
        return response()->json($data);
    }

    //Lấy tổng số sản phẩm tồn kho và giá trị tồn kho
    public function getInventory(Request $request)
    {
        $query = "
            SELECT 
                SUM(ps.inventory_quantity) AS inventory_quantity,
                SUM(ps.inventory_quantity * ps.entry_price) AS inventory_value
            FROM product_sizes AS ps
        ";
        $inventory = \DB::select($query);
        return response()->json($inventory);
    }
    
    
}
