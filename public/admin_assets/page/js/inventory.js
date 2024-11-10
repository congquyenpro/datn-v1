const Product = {
    productsList: {
        show: function () {
            $(document).ready(function () {
                // Kiểm tra xem DataTable đã được khởi tạo chưa
                let table;
                if ($.fn.dataTable.isDataTable('#productsTable')) {
                    table = $('#productsTable').DataTable();
                } else {
                    // Nếu chưa, khởi tạo DataTable
                    table = $('#productsTable').DataTable({
                        searching: true,
                        paging: true,
                        // Các tùy chọn khác nếu cần
                    });
                }
    
                // Lấy dữ liệu từ API
                Api.Product.GetProductsList().then((response) => {
                    // Làm sạch bảng trước khi thêm dữ liệu mới
                    table.clear();
    
                    // Kiểm tra dữ liệu
                    if (Array.isArray(response) && response.length > 0) {
                        response.forEach(product => {
                            // Chuẩn bị chi tiết kích thước sản phẩm
                            const productRows = product.product_size_list.map(size => `
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: ${size.size} ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Giá bán: ${size.price.toLocaleString()} ₫</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giá nhập: ${size.entry_price.toLocaleString()} ₫</span>
                                </div>
                            `).join('');
                            const productRows2 = product.product_size_list.map(size => `
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-red m-r-10">S-${size.quantity}</span>
                                </div>
                            `).join('');
                            const productRows3 = product.product_size_list.map(size => `
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-red m-r-10">I-${size.inventory_quantity}</span>
                                </div>
                            `).join('');
    
                            const trendingStatus = `
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-${product.id}" ${product.trending ? 'checked' : ''}>
                                        <label for="switch-${product.id}"></label>
                                    </div>
                                </div>
                            `;
    
                            // Tạo hàng mới
                            const newRow = [
                                `#${product.id}`,
                                product.name,
                                /* product.category_name, */
                                `<div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="/${product.images}" style="border: dotted 1px #f0069d; max-width: 60px" alt="">
                                </div>`,
                                productRows,
                                productRows2,
                                productRows3,
                            ];
    
                            // Thêm hàng mới vào DataTable
                            table.row.add(newRow);
                        });
    
                        // Cập nhật bảng với dữ liệu mới
                        table.draw();
                    } else {
                        console.error('No products found');
                    }
                }).catch((error) => {
                    console.error('Error fetching products:', error);
                });
            });
        }
    },
    
}

// Call the function to display the products
//Product.productsList.show();
