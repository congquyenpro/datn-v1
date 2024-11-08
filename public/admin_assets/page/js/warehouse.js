Warehouse = {
    home: {
        show: () => {
            console.log("Warehouse home");
            var template_id = 0;
            Warehouse.home.selectTemplate(template_id);
            $('.template-item').click(function() {
                template_id = $(this).data('id-template');
                Warehouse.home.selectTemplate(template_id);
            });
        },

        add: () => {
            let itemCount = 0; // Biến đếm để phân biệt các mục

            function initSelect2() {
                const selectElements = document.querySelectorAll('.select2');
                selectElements.forEach(select => {
                    $(select).select2(); // Khởi tạo Select2
                });
            }

            $('#add-entry-item').click(function () {
                itemCount++; // Tăng số đếm khi thêm mục mới
                console.log('Add new item');

                const newItem = `
                    <div class="item-entry m-t-20 border p-5 m-b-15" style="border: dotted 1px #1391c3;">
                        <form>
                            <div class="form-row">
                                <div class="m-b-5 col-sm-6 col-md-2 col-lg-2">
                                    <select class="select2 form-control" name="states" id="products-select-${itemCount}"></select>
                                </div>
                                <div class="m-b-5 col-sm-6 col-md-2 col-lg-2">
                                    <select class="select2 form-control" name="states" id="product-sizes-select-${itemCount}"></select>
                                </div>
                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                    <input type="text" class="form-control" placeholder="Số lượng">
                                </div>
                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                    <input type="text" class="form-control" placeholder="Giá nhập">
                                </div>
                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                    <input type="text" class="form-control" placeholder="HSD: ngày-tháng-năm">
                                </div>
                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                    <input type="text" class="form-control" placeholder="Trường hợp hàng hỏng">
                                </div>
                                <div class="m-b-5 col-sm-12 col-md-12 col-lg-12">
                                    <button type="button" class="btn btn-danger m-r-5 float-right">Xóa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                `;
                
                const itemContainer = document.getElementById('items-container');
                itemContainer.insertAdjacentHTML('beforeend', newItem);

                // Hủy khởi tạo Select2 cho tất cả các select trong container
                const allSelects = itemContainer.querySelectorAll('.select2');
                allSelects.forEach(select => {
                    $(select).select2('destroy'); // Hủy khởi tạo
                });

                Warehouse.home.getProductSize(itemCount); // Gọi hàm để lấy sản phẩm với số thứ tự mới

                // Khởi tạo Select2 cho tất cả các select mới
                initSelect2(); // Khởi tạo lại Select2 cho tất cả các select trong container
            });

            document.getElementById('items-container').addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-danger')) {
                    const itemToRemove = e.target.closest('.item-entry'); // Tìm phần tử cha tương ứng
                    if (itemToRemove) {
                        itemToRemove.remove(); // Xóa phần tử
                    }
                }
            });
        },

        getProductSize: (itemCount) => {
            Api.Warehouse.getAllProducts().done(res => {
                console.log(res);
                const productsSelect = $(`#products-select-${itemCount}`);
                productsSelect.empty(); // Xóa tất cả các option trước đó
                res.forEach(product => {
                    productsSelect.append(`
                        <option value="${product.id}">${product.id} - ${product.name}</option>
                    `);
                });

                // Thiết lập sự kiện cho select sản phẩm mới
                productsSelect.change(function () {
                    const product_id = $(this).val();
                    const productSizesSelect = $(`#product-sizes-select-${itemCount}`);

                    Api.Warehouse.getProductSizes(product_id).done(res => {
                        console.log(res);
                        productSizesSelect.empty(); // Xóa tất cả các option trước đó
                        res.forEach(size => {
                            productSizesSelect.append(`
                                <option value="${size.id}">${size.volume} ml</option>
                            `);
                        });
                        productSizesSelect.select2().trigger('change'); // Cập nhật Select2
                    });
                });
            });
        },
        submit : () => {
            // Thêm vào trong object Warehouse.home.add()
            $('#save-import-btn').click(function () {
                const entries = []; // Mảng để lưu thông tin các sản phẩm nhập vào

                const inputType = document.getElementById('inputType').value;

                // Duyệt qua tất cả các mục trong container
                document.querySelectorAll('.item-entry').forEach(entry => {
                    const productSelect = entry.querySelector('select[id^="products-select-"]');
                    const sizeSelect = entry.querySelector('select[id^="product-sizes-select-"]');
                    const quantityInput = entry.querySelector('input[placeholder="Số lượng"]');
                    const priceInput = entry.querySelector('input[placeholder="Giá nhập"]');
                    const expiryDateInput = entry.querySelector('input[placeholder="HSD: ngày-tháng-năm"]');
                    const damagedInput = entry.querySelector('input[placeholder="Trường hợp hàng hỏng"]');

                    // Lấy giá trị từ các trường nhập liệu
                    const productId = productSelect ? productSelect.value : null;
                    const sizeId = sizeSelect ? sizeSelect.value : null;
                    const quantity = quantityInput ? quantityInput.value : null;
                    const entryPrice = priceInput ? priceInput.value : null;
                    const expiryDate = expiryDateInput && expiryDateInput.value ? expiryDateInput.value : "22-2-2222"; // Gán giá trị mặc định
                    const damaged = damagedInput && damagedInput.value ? damagedInput.value : null;

                    // Kiểm tra các trường không được để trống
                    if (!productId || !sizeId || !quantity || !entryPrice) {
                        hasError = true; // Đánh dấu là có lỗi
                        console.error('Vui lòng điền đầy đủ thông tin cho tất cả các trường.');
                        // Có thể hiển thị thông báo lỗi cho người dùng ở đây
                        alert('Vui lòng điền đầy đủ thông tin cho tất cả các trường.');
                        return; // Dừng việc lưu lại
                    }

                    // Thêm thông tin vào mảng entries
                    entries.push({
                        productId,
                        sizeId,
                        quantity,
                        entryPrice,
                        expiryDate,
                        damaged,
                    });
                });


                const data = {
                    
                    type: inputType,
                    entries: entries
                };
                console.log(data);

                Api.Warehouse.store(data).done(res => {
                    if (res.status == 200) {
                        alert('Nhập thành công !');
                        $('.bd-example-modal-xl-2').modal('hide');
                        Warehouse.history.show();
                    }
                    else {
                        alert('Có lỗi xảy ra, vui lòng kiểm tra lại !');
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Xử lý lỗi nếu request thất bại
                    alert('Có lỗi xảy ra, vui lòng thử lại! Lỗi: ' + textStatus + ' - ' + errorThrown);
                });
            });

        },
        selectTemplate: (template_id) => {
            console.log('Select template:', template_id);
            $('.template-item').removeClass('is-select');
            $(`.template-item[data-id-template="${template_id}"]`).addClass('is-select');
            
            if (template_id == 0) {
                //ẩn #warehouse 
                $('#warehouse').hide();
                //hiện #add-product
                $('#entry-history').show();
            } else {
                //hiện #warehouse 
                $('#warehouse').show();
                Product.productsList.show();
                //ẩn #add-product
                $('#entry-history').hide();
            }
        }
    },
    history: {
        show: () => {
            Api.Warehouse.getHistory().done(res => {
                $('#warehouse-history-table').DataTable({
                    data: res,
                    columns: [
                        { 
                            title: 'ID', // Đặt tên tiêu đề cho cột ID
                            data: 'id'
                        },
                        { 
                            title: 'Giá trị', // Đặt tên tiêu đề cho cột Loại
                             //formatCurrency
                            data: 'value'
                        },
                        { 
                            title: 'Ngày tạo', // Đặt tên tiêu đề cho cột Ngày tạo
                            data: 'created_at'
                        },
                        { 
                            title: 'UID', // Đặt tên tiêu đề cho cột Nhân viên
                            data: 'admin_id'
                        },
                        { 
                            title: 'Loại',
                            /* data: 'type' */
                            //kiểm tra loại nhập kho
                            render: function (data, type, row) {
                                console.log(row.type);
                                if (row.type == "IN") {
                                    return `<span class="badge badge-pill badge-success">Nhập kho</span>`;
                                } else {
                                    return `<span class="badge badge-pill badge-danger">Hàng hỏng</span>`;
                                }
                            }
                        },
                        { 
                            title: 'Hành động', // Đặt tên tiêu đề cho cột Hành động
                            data: 'id',
                            render: function (data, type, row) {
                                return `
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded view-ticket-btn" data-id="${data}" data-toggle="modal" data-target=".bd-example-modal-xl">
                                        <i class="anticon anticon-eye"></i>
                                    </button>
                                `;
                            }
                        }
                    ],
                    responsive: true,
                    autoWidth: true,
                    destroy: true,
                });

                //Lấy sự kiện click view-ticket-btn
                $('.view-ticket-btn').click(function() {
                    const ticketId = $(this).data('id');
                    Warehouse.history.showDetail(ticketId);
                });


            });
            
        },
        showDetail : (ticketId) => {
            Warehouse.function.export(ticketId);
            Api.Warehouse.getHistoryDetail(ticketId).done(res => {
                Api.Warehouse.getOneHistory(ticketId).done(data => {
                    console.log(res);
                    $('#ticket-detail').html(`
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th>ID</th>
                                                        <th>Ngày nhập</th>
                                                        <th>Tổng giá trị</th>
                                                        <th>UID</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list"> 
                                                    <tr>
                                                        <td>${data[0].id}</td>
                                                        <td>${data[0].created_at}</td>
                                                        <td>${data[0].value}</td>
                                                        <td>${data[0].admin_id}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th>Mã SP</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Dung tích</th>
                                                        <th>Hạn sử dụng</th>
                                                        <th>Số lượng</th>
                                                        <th>Giá nhập</th>
                                                        <th>Thành tiền</th>
                                                        <th>Ghi chú</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list" id="list-items-ticket"> 

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    $('#list-items-ticket').empty();
                    res.forEach(item => {
                        $('#list-items-ticket').append(`
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.product_name}</td>
                                <td>${item.product_size_id}</td>
                                <td>${item.expiry_date}</td>
                                <td>${item.quantity}</td>
                                <td>${item.entry_price}</td>
                                <td>${item.quantity * item.entry_price}</td>
                                <td>${item.damaged_reason}</td>
                            </tr>
                        `);
                    });
                    
                });

            });
        }
    },
    function : {
        formatCurrency: (number) => {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);

        },
        export: (ticketId2) => {
            function downloadExcel(filename, data, products) {
                // Chuyển đổi dữ liệu bảng chi tiết phiếu sang mảng 2 chiều cho Excel
                const transformedData = [
                    ["ID", "Ngày nhập", "Tổng giá trị", "UID"],
                    [data[0].id, data[0].created_at, data[0].value, data[0].admin_id]
                ];
            
                const productHeaders = [
                    "Mã SP", "Tên sản phẩm", "Dung tích", "Hạn sử dụng", "Số lượng", 
                    "Giá nhập", "Thành tiền", "Ghi chú"
                ];
            
                const transformedProducts = products.map(item => [
                    item.id, item.product_name, item.product_size_id, item.expiry_date,
                    item.quantity, item.entry_price, item.quantity * item.entry_price, item.damaged_reason || ''
                ]);
            
                // Tạo sheet từ dữ liệu
                const ws = XLSX.utils.aoa_to_sheet([...transformedData, [], productHeaders, ...transformedProducts]);
            
                // Tính toán chiều rộng tối ưu cho mỗi cột
                const colWidths = [...productHeaders].map((header, index) => {
                    let maxWidth = header.length;
            
                    transformedProducts.forEach(row => {
                        const cellValue = row[index] ? row[index].toString() : '';
                        if (cellValue.length > maxWidth) {
                            maxWidth = cellValue.length;
                        }
                    });
            
                    return { wch: maxWidth + 2 }; // Thêm 2 ký tự để tránh bị cắt chữ
                });
            
                // Áp dụng chiều rộng cột cho sheet
                ws['!cols'] = colWidths;
            
                // Tạo workbook mới và thêm sheet
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Chi tiết phiếu");
            
                // Tạo file Excel và tải về
                XLSX.writeFile(wb, filename);
            }
            
            //Xóa sụ kiện click trước đó
            $('#export-ticket').off('click');
            $('#export-ticket').on('click', function() {
                console.log('Export ticket', ticketId2);
                
                if (ticketId2) {
                    Api.Warehouse.getHistoryDetail(ticketId2).done((res) => {
                        Api.Warehouse.getOneHistory(ticketId2).done(data => {
                            const timestamp = Date.now();
                            const filename = `chi-tiet-phieu-${timestamp}.xlsx`;
                            
                            downloadExcel(filename, data, res);
                        }).fail(err => {
                            alert('Lỗi khi lấy dữ liệu chi tiết phiếu.');
                            console.log(err);
                        });
                    }).fail(err => {
                        alert('Lỗi khi lấy dữ liệu sản phẩm.');
                        console.log(err);
                    });
                } else {
                    alert('Vui lòng chọn một phiếu!');
                }
            });
            
            
        }
    },
}

Warehouse.home.show();
Warehouse.home.add();
Warehouse.home.submit();

Warehouse.history.show();

