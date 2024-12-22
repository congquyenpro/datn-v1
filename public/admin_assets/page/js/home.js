

Report = {
    //Dạng line
    saleReport: {
      init: function() {
        const theme = {
            cyan: '#00bcd4',
            purple: '#9c27b0',
            gold: '#ffc107',
            blue: '#2196f3',
            blueLight: '#64b5f6',
            white: '#ffffff',
            grayLight: '#9e9e9e',
            transparent: 'transparent'
        };
    
        const year = new Date().getFullYear();  // Lấy năm hiện tại
        const month = new Date().getMonth() + 1; // Lấy tháng hiện tại (tháng từ 0 - 11, nên cộng 1)
    
        // Gọi API để lấy doanh thu theo ngày trong tháng
        Api.Report.getReportByDay(year, month).done((res) => {
          console.log(res); // Kiểm tra dữ liệu trả về
    
          // Mảng chứa doanh thu từng ngày trong tháng
          const dailyRevenue = res.map(item => item.revenue); // Giả sử mỗi item trong response có field 'revenue'
    
          // Tính trung bình doanh thu trong tháng
          const averageRevenue = dailyRevenue.reduce((sum, current) => sum + current, 0) / dailyRevenue.length;
    
          // Cập nhật giá trị trung bình vào console hoặc UI
          console.log("Trung bình doanh thu trong tháng: ", averageRevenue);

          //Tính tổng doanh thu trong tháng
          const totalRevenue = dailyRevenue.reduce((sum, current) => sum + current, 0);
          console.log("Tổng doanh thu trong tháng: ", totalRevenue);
          $('#total-month-revenue').text(Report.inventory.formatCurrency(totalRevenue));

          // Cấu hình biểu đồ
          const revenueChartConfig = new Chart(
            document.getElementById("revenue-chart-2").getContext('2d'),
            {
              type: 'line', // Loại biểu đồ: đường
              data: {
                labels: Array.from({ length: 31 }, (_, i) => i + 1), // Tạo nhãn cho 31 ngày (hoặc tối đa 30/31 tùy tháng)
                datasets: [{
                  label: 'Doanh thu',
                  backgroundColor: theme.transparent, // Màu nền trong suốt
                  borderColor: theme.blue, // Màu đường viền
                  pointBackgroundColor: theme.blue, // Màu nền của các điểm
                  pointBorderColor: theme.white, // Màu viền của các điểm
                  pointHoverBackgroundColor: theme.blueLight, // Màu nền khi hover
                  pointHoverBorderColor: theme.blueLight, // Màu viền khi hover
                  data: dailyRevenue // Dữ liệu doanh thu theo ngày lấy từ API
                }]
              },
              options: {
                legend: {
                  display: false // Ẩn legend
                },
                maintainAspectRatio: false, // Không duy trì tỷ lệ khung hình
                responsive: true, // Biểu đồ sẽ tự điều chỉnh kích thước khi màn hình thay đổi
                hover: {
                  mode: 'nearest', // Hover đến điểm gần nhất
                  intersect: true // Hover chỉ khi con trỏ nằm trên đường
                },
                tooltips: {
                  mode: 'index' // Hiển thị tooltip cho tất cả các điểm tại cùng một chỉ số (index)
                },
                scales: {
                  xAxes: [{
                    gridLines: [{ display: false }], // Ẩn các đường lưới trục X
                    ticks: {
                      display: true, // Hiển thị các dấu tick trên trục X
                      fontColor: theme.grayLight, // Màu chữ cho các dấu tick
                      fontSize: 13, // Kích thước font chữ
                      padding: 10 // Khoảng cách giữa dấu tick và trục X
                    }
                  }],
                  yAxes: [{
                    gridLines: {
                      drawBorder: false, // Không vẽ đường biên trên trục Y
                      drawTicks: false, // Không vẽ các dấu tick trên trục Y
                      borderDash: [3, 4], // Kiểu đường chấm chấm
                      zeroLineWidth: 1, // Độ rộng đường chấm tại giá trị 0
                      zeroLineBorderDash: [3, 4] // Kiểu đường chấm tại giá trị 0
                    },
                    ticks: {
                      display: true, // Hiển thị các dấu tick trên trục Y
                      max: Math.max(...dailyRevenue) * 1.2, // Giá trị tối đa trên trục Y (tăng thêm 20% so với doanh thu cao nhất)
                      stepSize: Math.max(...dailyRevenue) / 5, // Bước nhảy của trục Y
                      fontColor: theme.grayLight, // Màu chữ cho các dấu tick
                      fontSize: 13, // Kích thước font chữ
                      padding: 10 // Khoảng cách giữa dấu tick và trục Y
                    }
                  }]
                }
              }
            }
          );
        });
      }
    },
    

    //Dạng cột
    saleReport2: {
      init: function() {
        const theme = {
            cyan: '#00bcd4',
            purple: '#9c27b0',
            gold: '#ffc107',
            blue: '#2196f3',
            blueLight: '#64b5f6',
            white: '#ffffff',
            grayLight: '#9e9e9e',
            transparent: 'transparent'
        };
    
        // Lấy năm hiện tại
        var year = new Date().getFullYear();
    
        // Gọi API để lấy doanh thu theo tháng
        Api.Report.getReportByMonth(year).done((res) => {
          console.log(res); // Kiểm tra dữ liệu trả về
    
          // Mảng chứa doanh thu từng tháng từ dữ liệu API
          const monthlyRevenue = res.map(item => item.revenue);
          
          var averageRevenue = monthlyRevenue.reduce((sum, current) => sum + current, 0) / monthlyRevenue.length;
          //Làm tròn 2 chữ số thập phân
          averageRevenue = Math.round(averageRevenue * 100) / 100;
          //$('#revenue-average').text(averageRevenue+' ₫');

          //Tính tổng doanh thu trong năm
          const totalRevenue = monthlyRevenue.reduce((sum, current) => sum + current, 0);
          $('#revenue-average').text(Report.inventory.formatCurrency(totalRevenue));
    
          // Cấu hình biểu đồ
          const revenueChartConfig = new Chart(
            document.getElementById("month-revenue-chart").getContext('2d'),
            {
                type: 'bar', // Chuyển từ 'line' thành 'bar' để vẽ biểu đồ dạng cột
                data: {
                    labels: [
                        "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", 
                        "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                    ], // Nhãn cho trục X
                    datasets: [{
                        label: 'Doanh thu',
                        backgroundColor: theme.blue, // Màu nền của các cột
                        borderColor: theme.blue, // Màu viền của các cột
                        borderWidth: 1, // Độ dày viền của cột
                        data: monthlyRevenue // Dữ liệu doanh thu lấy từ API
                    }]
                },
                options: {
                    legend: {
                        display: false // Ẩn legend
                    },
                    maintainAspectRatio: false, // Không duy trì tỷ lệ khung hình
                    responsive: true, // Biểu đồ sẽ tự điều chỉnh kích thước khi màn hình thay đổi
                    hover: {
                        mode: 'nearest', // Hover đến điểm gần nhất
                        intersect: true // Hover chỉ khi con trỏ nằm trên cột
                    },
                    tooltips: {
                        mode: 'index' // Hiển thị tooltip cho tất cả các cột tại cùng một chỉ số (index)
                    },
                    scales: {
                        xAxes: [{
                            gridLines: [{ display: false }], // Ẩn các đường lưới trục X
                            ticks: {
                                display: true, // Hiển thị các dấu tick trên trục X
                                fontColor: theme.grayLight, // Màu chữ cho các dấu tick
                                fontSize: 13, // Kích thước font chữ
                                padding: 10 // Khoảng cách giữa dấu tick và trục X
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false, // Không vẽ đường biên trên trục Y
                                drawTicks: false, // Không vẽ các dấu tick trên trục Y
                                borderDash: [3, 4], // Kiểu đường chấm chấm
                                zeroLineWidth: 1, // Độ rộng đường chấm tại giá trị 0
                                zeroLineBorderDash: [3, 4] // Kiểu đường chấm tại giá trị 0
                            },
                            ticks: {
                                display: true, // Hiển thị các dấu tick trên trục Y
                                max: Math.max(...monthlyRevenue) * 1.2, // Giá trị tối đa trên trục Y (tăng thêm 20% so với doanh thu cao nhất)
                                stepSize: Math.max(...monthlyRevenue) / 5, // Bước nhảy của trục Y
                                fontColor: theme.grayLight, // Màu chữ cho các dấu tick
                                fontSize: 13, // Kích thước font chữ
                                padding: 10 // Khoảng cách giữa dấu tick và trục Y
                            }
                        }]
                    }
                }
            }
          );
        });
      },
    },
    


    customerChart : {
      init : () => {
        const theme = {
          cyan: '#00bcd4',
          purple: '#9c27b0',
          gold: '#ffc107',
          blue: '#2196f3',
          blueLight: '#64b5f6',
          white: '#ffffff',
          grayLight: '#9e9e9e',
          transparent: 'transparent'
      };
      
      const customersChartConfig = new Chart(
          document.getElementById("customers-chart").getContext('2d'),
          {
              type: 'doughnut', // Loại biểu đồ là donut
              data: {
                  labels: ['New', 'Returning', 'Others'], // Nhãn cho các phần trong biểu đồ
                  datasets: [{
                      label: 'Series A', // Tên của bộ dữ liệu
                      backgroundColor: [
                          theme.cyan, 
                          theme.purple, 
                          theme.gold
                      ], // Màu nền cho các phần của biểu đồ
                      pointBackgroundColor: [
                          theme.cyan, 
                          theme.purple, 
                          theme.gold
                      ], // Màu điểm nền cho các phần
                      data: [350, 450, 100] // Dữ liệu cho các phần: New, Returning, Others
                  }]
              },
              options: {
                  legend: {
                      display: false // Ẩn phần hiển thị chú giải (legend)
                  },
                  cutoutPercentage: 75, // Tỉ lệ cắt bỏ (độ rộng của phần trống giữa vòng tròn)
                  maintainAspectRatio: false // Không duy trì tỷ lệ khung hình ban đầu
              }
          }
      );
      
      }
    },

    product: {
      getBestSeller : () => {
        Api.Product.GetBestSeller().done((res) => {
          $('#best-selling-body').empty();
          res.forEach(element => {
            $('#best-selling-body').append(`
              <tr>
                  <td>${element.product_id}</td>
                  <td>
                      <div class="media align-items-center">
                          <div class="avatar avatar-image rounded">
                              <img src="/${element.image}" alt="">
                          </div>
                          <div class="m-l-10">
                              <span>${element.product_name}</span>
                          </div>
                      </div>
                  </td>
                  <td>${element.total_sales}</td>
                  <td></td>
              </tr>
            `)
          });
        });
      },
      getTopViewed : () => {
        Api.Product.GetTopViewed ().done((res) => {
          $('#top-view-body').empty();
          res.forEach(element => {
            $('#top-view-body').append(`
              <tr>
                  <td>${element.product_id}</td>
                  <td>
                      <div class="media align-items-center">
                          <div class="avatar avatar-image rounded">
                              <img src="/${element.image}" alt="">
                          </div>
                          <div class="m-l-10">
                              <span>${element.product_name}</span>
                          </div>
                      </div>
                  </td>
                  <td>${element.view}</td>
                  <td></td>
              </tr>
            `)
          });
        });
      },
    },

    inventory: {
      getInventory : () => {
        Api.Report.getInventory().done((res) => {
          console.log(res);
          $('#inventory-quantity').text(res[0].inventory_quantity);
          $('#inventory-value').text(Report.inventory.formatCurrency(res[0].inventory_value));
        });
      },
      formatCurrency : (number) => {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
      }
    },

    today: {
      show : () => {
        Api.Report.getReportRevenue().done((res) => {
          $('#today-revenue').text(res.revenue + ' ₫');
          $('#today-order').text(res.total_order);
          $('#today-customer').text(res.total_new_customer);
        });
      }
    }
  
}

Report.saleReport.init();
//Report.saleReport2.init();
//Report.customerChart.init();

Report.product.getBestSeller();
Report.product.getTopViewed();
Report.inventory.getInventory();

Report.today.show();