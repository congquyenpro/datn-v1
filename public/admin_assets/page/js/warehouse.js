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
                                    <button type="button" class="btn btn-danger m-r-5">Xóa</button>
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

                // Duyệt qua tất cả các mục trong container
                document.querySelectorAll('.item-entry').forEach(entry => {
                    const productSelect = entry.querySelector('select[id^="products-select-"]');
                    const sizeSelect = entry.querySelector('select[id^="product-sizes-select-"]');
                    const quantityInput = entry.querySelector('input[placeholder="Số lượng"]');
                    const priceInput = entry.querySelector('input[placeholder="Giá nhập"]');
                    const expiryDateInput = entry.querySelector('input[placeholder="HSD: ngày-tháng-năm"]');

                    // Lấy giá trị từ các trường nhập liệu
                    const productId = productSelect ? productSelect.value : null;
                    const sizeId = sizeSelect ? sizeSelect.value : null;
                    const quantity = quantityInput ? quantityInput.value : null;
                    const entryPrice = priceInput ? priceInput.value : null;
                    const expiryDate = expiryDateInput && expiryDateInput.value ? expiryDateInput.value : "22-2-2222"; // Gán giá trị mặc định

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
                        expiryDate
                    });
                });

                // In thông tin các sản phẩm nhập vào ra console (hoặc xử lý tiếp tùy ý)
                console.log(entries);

                // Nếu bạn muốn gửi thông tin này đến server, bạn có thể sử dụng Ajax ở đây
                // Ví dụ:
                // Api.Warehouse.saveEntries(entries).done(response => {
                //     console.log('Lưu thành công:', response);
                // }).fail(error => {
                //     console.error('Lỗi khi lưu:', error);
                // });
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
                //ẩn #add-product
                $('#entry-history').hide();
            }
        }
    }
}

Warehouse.home.show();
Warehouse.home.add();
Warehouse.home.submit();
