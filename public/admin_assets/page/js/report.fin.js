FinReport = {
    show: () => {
        $(document).ready(function() {
            // Khởi tạo Datepicker cho các trường input
            $('#start_date').datepicker({
                format: 'mm/dd/yyyy',  // Định dạng ngày của Datepicker
                autoclose: true
            });
        
            $('#end_date').datepicker({
                format: 'mm/dd/yyyy',  // Định dạng ngày của Datepicker
                autoclose: true
            });
        
            // Thiết lập thời gian mặc định (đầu tháng và cuối tháng hiện tại)
            setDefaultDates();
        
            // Sự kiện khi nhấn nút "filter_financial"
            $('#filter_financial').on('click', function() {
                // Lấy giá trị từ các input datepicker
                var startDate = $('#start_date').val();  // Ví dụ: '11/13/2024'
                var endDate = $('#end_date').val();      // Ví dụ: '12/01/2024'
        
                // Kiểm tra nếu người dùng chưa chọn ngày
                if (!startDate || !endDate) {
                    alert("Vui lòng chọn cả ngày bắt đầu và ngày kết thúc.");
                    return;
                }
        
                // Chuyển đổi ngày tháng sang định dạng yyyy-mm-dd hh:mm:ss
                var formattedStartDate = formatDateToDatetime(startDate, true);  // Thêm giờ 00:00:00
                var formattedEndDate = formatDateToDatetime(endDate, false);    // Thêm giờ 23:59:00
        
                // Chuẩn bị dữ liệu để gửi lên server hoặc truy vấn
                var dataToSend = {
                    start_date: formattedStartDate,
                    end_date: formattedEndDate
                };
        
                // Thực hiện gọi AJAX hoặc gửi dữ liệu lên server
                console.log('Data to send:', dataToSend);
                FinReport.get(formattedStartDate, formattedEndDate);
            });
        
            // Hàm chuyển đổi định dạng ngày tháng từ mm/dd/yyyy sang yyyy-mm-dd hh:mm:ss
            function formatDateToDatetime(dateStr, isStartDate) {
                var dateParts = dateStr.split('/');  // Tách theo '/'
                var year = dateParts[2];
                var month = dateParts[0].padStart(2, '0');  // Thêm số 0 vào tháng nếu thiếu
                var day = dateParts[1].padStart(2, '0');   // Thêm số 0 vào ngày nếu thiếu
        
                // Đặt giờ cho ngày bắt đầu là 00:00:00, và ngày kết thúc là 23:59:00
                var time = isStartDate ? '00:00:00' : '23:59:00';
        
                return year + '-' + month + '-' + day + ' ' + time;
            }
        
            // Hàm thiết lập thời gian mặc định cho đầu tháng và cuối tháng hiện tại
            function setDefaultDates() {
                var now = new Date();
                var startMonth = now.getMonth(); // Lấy tháng hiện tại (0-11)
                var startYear = now.getFullYear(); // Lấy năm hiện tại
        
                // Tính ngày đầu tháng hiện tại
                var firstDayOfMonth = new Date(startYear, startMonth, 1);
                var firstDayFormatted = formatDate(firstDayOfMonth); // Định dạng ngày đầu tháng
        
                // Tính ngày cuối tháng hiện tại
                var lastDayOfMonth = new Date(startYear, startMonth + 1, 0); // Ngày cuối tháng
                var lastDayFormatted = formatDate(lastDayOfMonth); // Định dạng ngày cuối tháng
        
                // Thiết lập giá trị vào các input
                $('#start_date').val(firstDayFormatted); // Đặt ngày đầu tháng vào input
                $('#end_date').val(lastDayFormatted);   // Đặt ngày cuối tháng vào input

                var start_date_2 = formatDateToDatetime(firstDayFormatted, true);
                var end_date_2 = formatDateToDatetime(lastDayFormatted, false);
                FinReport.get(start_date_2, end_date_2);


            }
        
            // Hàm định dạng lại ngày theo dạng mm/dd/yyyy
            function formatDate(date) {
                var month = (date.getMonth() + 1).toString().padStart(2, '0');  // Tháng (1-12)
                var day = date.getDate().toString().padStart(2, '0'); // Ngày (1-31)
                var year = date.getFullYear(); // Năm (yyyy)
                return month + '/' + day + '/' + year;  // Trả về chuỗi ngày theo định dạng mm/dd/yyyy
            }
        });
                
    },
    get: (start_date, end_date) => {
        console.log(start_date, end_date);  
        Api.Report.getReport(start_date,end_date).done((res) => {
            console.log(res);
            $('#report-table').html(`
                <table class="table table-bordered">
                <thead>
                    <tr class="font-size-15">
                        <th class="font-weight-bold">CHỈ TIÊU BÁO CÁO</th>
                        <th class="font-weight-bold">KỲ HIỆN TẠI</th>
                        <th class="font-weight-bold">KỲ TRƯỚC</th>
                        <th class="font-weight-bold">THAY ĐỔI </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dòng 1 -->
                    <tr class="table-info">
                        <td class="font-weight-bold">I. Doanh Thu Bán Hàng (1+2+3-4)</td>
                        <td id="pre_1" >${res.sale.revenue}</td>
                        <td id="now_1">${res.sale_last_month.revenue}</td>
                        <td id="rate1">${res.sale.revenue - res.sale_last_month.revenue}</td>
                    </tr>

                    <!-- Dòng 1.1 -->
                    <tr>
                        <td class="ml-4"> 1. Tiền Hàng Thực Bán (1a-1b)</td>
                        <td id="pre_2">${res.sale.total_real_sale}</td>
                        <td id="now_2">${res.sale_last_month.total_real_sale}</td>
                        <td id="rate2"></td>
                    </tr>

                    <!-- Dòng 1.1.1 -->
                    <tr>
                        <td class="ml-5"> a. Tiền Hàng Bán Ra</td>
                        <td id="pre_3">${res.sale.total_sale}</td>
                        <td id="now_3">${res.sale_last_month.total_sale}</td>
                        <td id="rate3"></td>
                    </tr>

                    <!-- Dòng 1.1.2 -->
                    <tr>
                        <td class="ml-5"> b. Tiền Hàng Trả Lại</td>
                        <td id="pre_4">${res.sale.total_return_sale}</td>
                        <td id="now_4">${res.sale_last_month.total_return_sale}</td>
                        <td id="rate4"></td>
                    </tr>

<!--                    <tr>
                        <td> 2. Thuế VAT</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td> 3. Phí giao hàng thu của khách</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td> 4. Chiết khấu</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>                           -->

                    <!-- ...Thêm các dòng khác tương tự... -->

                    <!-- Dòng 2 -->
                    <tr class="table-info">
                        <td class="font-weight-bold">II. Chi Phí Bán Hàng (1+2+3)</td>
                        <td id="pre_5">${res.sale.total_cost_sale}</td>
                        <td id="now_5">${res.sale_last_month.total_cost_sale}</td>
                        <td id="rate5">${res.sale.total_cost_sale - res.sale_last_month.total_cost_sale}</td>
                    </tr>
                    <tr>
                        <td> 1. Chi phí giá vốn hàng hóa</td>
                        <td id="pre_6">${res.sale.total_entry_value}</td>
                        <td id="now_6">${res.sale_last_month.total_entry_value}</td>
                        <td id="rate6"></td>
                    </tr>
                    <tr>
                        <td> 2. Phí giao hàng trả đối tác</td>
                        <td id="pre_7">${res.sale.total_shipping_cost}</td>
                        <td id="now_7">${res.sale_last_month.total_shipping_cost}</td>
                        <td id="rate7"></td>
                    </tr>
                    <tr>
                        <td> 3. Thanh toán bằng điểm</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>

                    <!-- ...Thêm các dòng khác tương tự... -->

                    <!-- Dòng 3 -->
                    <tr class="table-info">
                        <td class="font-weight-bold">III. Thu Nhập Khác (1+2)</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td> 1. Phiếu thu</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td> 2. Phí khách trả hàng</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>

                    <!-- ...Thêm các dòng khác tương tự... -->

                    <!-- Dòng 4 -->
                    <tr class="table-info">
                        <td class="font-weight-bold">IV. Chi Phí Khác</td>
                        <td>${res.sale.other_cost}</td>
                        <td>${res.sale_last_month.other_cost}</td>
                        <td>${res.sale.other_cost - res.sale_last_month.other_cost}</td>
                    </tr>
                    <tr>
                        <td> 1. Phiếu chi</td>
                        <td>${res.sale.other_cost}</td>
                        <td>${res.sale_last_month.other_cost}</td>
                        <td>0</td>
                    </tr>

                    <!-- ...Thêm các dòng khác tương tự... -->

                    <!-- Dòng 5 -->
                    <tr class="table-warning font-weight-bold">
                        <td>Lợi Nhuận (I + III - II - IV)</td>
                        <td id="pre_9">${res.sale.profit}</td>
                        <td id="now_9">${res.sale_last_month.profit}</td>
                        <td id="rate_9">${res.sale.profit - res.sale_last_month.profit}</td>
                    </tr>
                </tbody>
            </table>
            `);
        });
    },
    export: () => {
        function downloadExcel(filename, data, startDate, endDate) {
            // Dữ liệu báo cáo tài chính đã lấy được từ API
            const transformedData = [
                // Thêm dòng tiêu đề báo cáo
                [`Báo cáo doanh thu từ ngày ${startDate} đến ${endDate}`],
                [''],
                // Định dạng các hàng từ dữ liệu nhận về
                ['Chỉ Tiêu Báo Cáo', 'Kỳ Hiện Tại', 'Kỳ Trước', 'Thay Đổi'],
                ['I. Doanh Thu Bán Hàng (1+2+3-4)', data.sale.revenue, data.sale_last_month.revenue, data.sale.revenue-data.sale_last_month.revenue], // Dòng 1
                [' 1. Tiền Hàng Thực Bán (1a-1b)', data.sale.total_real_sale, data.sale_last_month.total_real_sale, ''],
                ['   a. Tiền Hàng Bán Ra', data.sale.total_sale, data.sale_last_month.total_sale, ''],
                ['   b. Tiền Hàng Trả Lại', data.sale.total_return_sale, data.sale_last_month.total_return_sale, ''],
/*                 [' 2. Thuế VAT', 0, 0, 0],
                [' 3. Phí giao hàng thu của khách', 0, 0, 0],
                [' 4. Chiết khấu', 0, 0, 0], */
                ['II. Chi Phí Bán Hàng (1+2+3)', data.sale.total_cost_sale, data.sale_last_month.total_cost_sale, data.sale.total_cost_sale - data.sale_last_month.total_cost_sale],
                [' 1. Chi phí giá vốn hàng hóa', data.sale.total_entry_value, data.sale_last_month.total_entry_value, ''],
                [' 2. Phí giao hàng trả đối tác', data.sale.total_shipping_cost, data.sale_last_month.total_shipping_cost, ''],
                [' 3. Thanh toán bằng điểm', 0, 0, 0],
                ['III. Thu Nhập Khác (1+2)', 0, 0, 0],
                [' 1. Phiếu thu', 0, 0, 0],
                [' 2. Phí khách trả hàng', 0, 0, 0],
                ['IV. Chi Phí Khác', data.sale.other_cost, data.sale_last_month.other_cost, data.sale.other_cost - data.sale_last_month.other_cost],
                [' 1. Phiếu chi', data.sale.other_cost, data.sale_last_month.other_cost, 0],
                ['Lợi Nhuận (I + III - II - IV)', data.sale.profit, data.sale_last_month.profit, data.sale.profit - data.sale_last_month.profit],
            ];
    
            // Tạo sheet từ dữ liệu
            const ws = XLSX.utils.aoa_to_sheet(transformedData);
    
            // Tính toán chiều rộng tối ưu cho mỗi cột
            const colWidths = transformedData[2].map((header, index) => {
                let maxWidth = header.length; // Chiều rộng cột ban đầu là chiều dài tiêu đề
    
                transformedData.forEach(row => {
                    const cellValue = row[index] ? row[index].toString() : '';
                    if (cellValue.length > maxWidth) {
                        maxWidth = cellValue.length;
                    }
                });
    
                return { wch: maxWidth + 10 }; // Thêm 2 ký tự để cột không bị cắt
            });
    
            // Áp dụng chiều rộng cột cho sheet
            ws['!cols'] = colWidths;
    
            // Tạo workbook mới
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Báo Cáo Tài Chính");
    
            // Tạo file Excel và tải về
            XLSX.writeFile(wb, filename);
        }
    
        // Lấy dữ liệu báo cáo tài chính từ API
        $('#export-excel').off('click');
        $('#export-excel').on('click', function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
    
            // Kiểm tra ngày bắt đầu và ngày kết thúc có hợp lệ không
            if (!start_date || !end_date) {
                alert("Vui lòng chọn cả ngày bắt đầu và ngày kết thúc.");
                return;
            }
    
            // Chuyển đổi ngày tháng sang định dạng yyyy-mm-dd hh:mm:ss
            var formattedStartDate = formatDateToDatetime(start_date, true);
            var formattedEndDate = formatDateToDatetime(end_date, false);
    
            // Gọi API để lấy báo cáo tài chính
            FinReport.get(formattedStartDate, formattedEndDate);
            
            // Sau khi nhận được dữ liệu từ API (từ hàm FinReport.get()), tiến hành xuất ra Excel
            Api.Report.getReport(formattedStartDate, formattedEndDate).done((res) => {
                const timestamp = Date.now();
                const filename = 'bao_cao_tai_chinh_' + timestamp + '.xlsx';
    
                // Xuất ra file Excel với dữ liệu từ API và thông tin ngày tháng
                downloadExcel(filename, res, start_date, end_date); // Truyền thêm start_date và end_date vào hàm download
            }).fail((err) => {
                alert('Có lỗi xảy ra khi lấy dữ liệu báo cáo');
                console.log(err);
            });
        });
    
        // Hàm chuyển đổi định dạng ngày tháng từ mm/dd/yyyy sang yyyy-mm-dd hh:mm:ss
        function formatDateToDatetime(dateStr, isStartDate) {
            var dateParts = dateStr.split('/');
            var year = dateParts[2];
            var month = dateParts[0].padStart(2, '0');
            var day = dateParts[1].padStart(2, '0');
    
            var time = isStartDate ? '00:00:00' : '23:59:00';
    
            return year + '-' + month + '-' + day + ' ' + time;
        }
    }
    
    
}

FinReport.show();
FinReport.export();