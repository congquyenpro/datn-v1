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
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: ${size.price.toLocaleString()} VNĐ</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: ${size.discount} %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: ${size.quantity}</span>
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
                                `<div class="checkbox">
                                    <input id="check-item-${product.id}" type="checkbox">
                                    <label for="check-item-${product.id}" class="m-b-0"></label>
                                </div>`,
                                `#${product.id}`,
                                product.name,
                                product.category_name,
                                `<div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="${product.images}" style="border: dotted 1px #f0069d; max-width: 60px" alt="">
                                </div>`,
                                productRows,
                                trendingStatus,
                                `<div class="text-right">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                        <i class="anticon anticon-eye"></i>
                                    </button>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                </div>`
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
    productDetails: {
        show: (productId) => {
            Api.Product.GetProductDetails(productId).then((response) => {
                // Display the product details
                console.log(response);
            });
        },
        showModalAdd: () => {
            // Xử lý gắn dữ liệu cho category select
            function populateCategorySelect(selectId, categories) {
                const selectElement = document.getElementById(selectId);
                
                // Xóa các option hiện có (nếu cần)
                selectElement.innerHTML = '<option value="" disabled selected>Chọn danh mục</option>';
                
                categories.forEach(category => {
                  const option = document.createElement('option');
                  option.value = category.id;
                  option.textContent = category.name;
                  selectElement.appendChild(option);
                });
            }
            Api.Product.GetAllCategories().then((response) => {
                // Gắn dữ liệu từ response vào thẻ select
                populateCategorySelect('inputState', response);
              }).catch((error) => {
                console.error("Error fetching categories:", error);
            });

            // Xử lý gắn dữ liệu cho các select của thuộc tính
            function populateAttributeSelect(selectId, data) {
                const selectElement = document.getElementById(selectId);
                data.forEach(item => {
                  const option = document.createElement('option');
                  option.value = item.id;
                  option.textContent = item.value;
                  selectElement.appendChild(option);
                });
                const otherOption = document.createElement('option');
                otherOption.value = 'other';
                otherOption.textContent = 'Khác (Thêm mới)';
                selectElement.appendChild(otherOption);
            }
            Api.Product.GetAllAttributesValue().then((response) => {
                // Hiển thị dữ liệu chi tiết sản phẩm từ response
                console.log(response);
        
                // Sử dụng dữ liệu từ response để gắn vào các thẻ select
                populateAttributeSelect('brandSelect', response.brand);
                populateAttributeSelect('concentrationSelect', response.concentration);
                populateAttributeSelect('styleSelect', response.style);
                populateAttributeSelect('fragranceGroupSelect', response.frag_group);
                populateAttributeSelect('fragranceTimeSelect', response.frag_time);
                populateAttributeSelect('fragranceDistanceSelect', response.frag_distance);
                populateAttributeSelect('ageGroupSelect', response.age_group);
                populateAttributeSelect('ingredientSelect', response.ingredients);
                populateAttributeSelect('countrySelect', response.country);
            }).catch((error) => {
                console.error("Error fetching attributes:", error);
            });
            // Xử lý nếu chọn option khác
            function handleSelectChange(selectId, inputId) {
                const selectElement = document.getElementById(selectId);
                const inputElement = document.getElementById(inputId);
                selectElement.addEventListener('change', () => {
                  if (selectElement.value === 'other') {
                    inputElement.style.display = 'block';
                  } else {
                    inputElement.style.display = 'none';
                    inputElement.value = ''; // Xóa nội dung trường nhập
                  }
                });
            }
            handleSelectChange('brandSelect', 'newBrandInput');
            handleSelectChange('concentrationSelect', 'newConcentrationInput');
            handleSelectChange('styleSelect', 'newStyleInput');
            handleSelectChange('fragranceGroupSelect', 'newFragranceGroupInput');
            handleSelectChange('fragranceTimeSelect', 'newFragranceTimeInput');
            handleSelectChange('fragranceDistanceSelect', 'newFragranceDistanceInput');
            handleSelectChange('ageGroupSelect', 'newAgeGroupInput');
            handleSelectChange('ingredientSelect', 'newIngredientInput');
            handleSelectChange('countrySelect', 'newCountryInput');

            // Xử lý summer note
            function handleSummerNote() {
                $('#summernote').summernote({
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                      ]
                });
            }
            handleSummerNote();

            // Xử lý ảnh tải lên
            function handleImageUpload() {
                document.getElementById('uploadButton').addEventListener('click', function() {
                    document.getElementById('customFile').click();
                });
        
                document.getElementById('customFile').addEventListener('change', function() {
                    var label = document.querySelector('.custom-file-label');
                    var files = this.files;
                    label.textContent = files.length > 0 ? files.length + ' file(s) selected' : 'Choose files';
        
                    // Xóa các ảnh preview cũ
                    var previewContainer = document.getElementById('previewContainer');
                    previewContainer.innerHTML = '';
        
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var reader = new FileReader();
        
                        reader.onload = (function(file) {
                            return function(e) {
                                // Tạo thẻ div để chứa ảnh và nút xóa
                                var imgContainer = document.createElement('div');
                                imgContainer.style.position = 'relative'; // Để định vị biểu tượng
                                imgContainer.style.margin = '5px';
        
                                // Tạo thẻ img cho từng ảnh
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '100px'; // Kích thước tối đa cho ảnh preview
                                img.style.padding = '1rem';
                                img.style.border = 'solid 2px #1391c3';
                                img.style.borderRadius = '5px'; // Bo tròn góc cho ảnh
        
                                // Tạo biểu tượng để xóa
                                var removeIcon = document.createElement('span');
                                removeIcon.innerHTML = '<i class="anticon anticon-close-circle" style="font-size: 18px; color: #3f87f5; cursor: pointer; position: absolute; top: 10px; right: 1px;"></i>';
        
                                removeIcon.onclick = function() {
                                    imgContainer.remove(); // Xóa ảnh và biểu tượng khỏi container
                                };
        
                                // Thêm ảnh và biểu tượng vào container
                                imgContainer.appendChild(img);
                                imgContainer.appendChild(removeIcon);
                                previewContainer.appendChild(imgContainer); // Thêm ảnh vào container
                            };
                        })(file);
        
                        reader.readAsDataURL(file);
                    }
                });
            }
            handleImageUpload();

            // Xử lý thêm phân loại sản phẩm
            function handleAddSize() {
                document.getElementById('addItemButton').addEventListener('click', function() {
                    const newItem = `
                        <div class="col-md-6 col-sm-12 m-b-15">
                            <div class="metadata-item p-3 border border-dotted" style="border-color: #1391c3;">
                                <div class="form-group">
                                    <label>Dung lượng *</label>
                                    <input type="text" class="form-control data-size number-type" placeholder="ml">
                                </div>
                                <div class="form-group">
                                    <label>Đơn giá *</label>
                                    <input type="text" class="form-control data-prices number-type" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Giảm giá *</label>
                                    <input type="text" class="form-control data-discount number-type" placeholder="%">
                                </div>
                                <div class="form-group">
                                    <label>Số lượng * (Mặc định 0)</label>
                                    <input type="text" class="form-control data-quantity number-type" placeholder="">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger metadata-remove" atr="Delete">Xóa thuộc tính</button>
                                </div>
                            </div>
                        </div>
                    `;
        
                    // Thêm item mới vào container đã có sẵn
                    const itemContainer = document.getElementById('itemContainer');
                    itemContainer.insertAdjacentHTML('beforeend', newItem); // Thêm HTML mới vào cuối
                });
        
                // Lắng nghe sự kiện click cho nút xóa
                document.getElementById('itemContainer').addEventListener('click', function(e) {
                    // Nếu click vào button hoặc i bên trong button
                    if (e.target.closest('.metadata-remove')) {
                        const button = e.target.closest('.metadata-remove');
                        const itemToRemove = button.closest('.col-md-6'); // Tìm phần tử cha tương ứng
                        if (itemToRemove) {
                            itemToRemove.remove(); // Xóa phần tử
                        }
                    }
                });
            }
            handleAddSize();
        }
    },
    formSubmit: {
        addProduct: () => {
            function handleSubmit() {
                // Lấy tên + mô tả ngắn + giới tính + trạng thái sản phẩm
                const productName = document.getElementById('formGroupExampleInput').value.trim();
                const shortDescription = document.querySelector('textarea[name="short_description"]').value.trim();
                const genderValue = document.querySelector('input[name="gender"]:checked')?.value;
                const statusValue = document.querySelector('input[name="status"]:checked')?.value;
        
                // Lấy giá trị từ select 'inputState' (Category)
                const categorySelect = document.getElementById('inputState');
                const categoryValue = categorySelect.value;
        
                // Kiểm tra các trường bắt buộc
                if (!productName || !shortDescription || !genderValue || !categoryValue || !statusValue) {
                    alert("Vui lòng điền đầy đủ thông tin sản phẩm!");
                    return; // Trả về nếu không hợp lệ
                }
        
                // Lấy dữ liệu từ các select thuộc tính
                const brandValue = getSelectedOrNewValue('brandSelect', 'newBrandInput');
                const concentrationValue = getSelectedOrNewValue('concentrationSelect', 'newConcentrationInput');
                const styleValue = getSelectedOrNewValue('styleSelect', 'newStyleInput');
                const fragranceGroupValue = getSelectedOrNewValue('fragranceGroupSelect', 'newFragranceGroupInput');
                const fragranceTimeValue = getSelectedOrNewValue('fragranceTimeSelect', 'newFragranceTimeInput');
                const fragranceDistanceValue = getSelectedOrNewValue('fragranceDistanceSelect', 'newFragranceDistanceInput');
                const ageGroupValue = getSelectedOrNewValue('ageGroupSelect', 'newAgeGroupInput');
                const ingredientValue = getSelectedOrNewValue('ingredientSelect', 'newIngredientInput');
                const countryValue = getSelectedOrNewValue('countrySelect', 'newCountryInput');
        
                // Kiểm tra thuộc tính
                const attributes = [
                    { name: 'brand', value: brandValue },
                    { name: 'concentration', value: concentrationValue },
                    { name: 'style', value: styleValue },
                    { name: 'fragrance_group', value: fragranceGroupValue },
                    { name: 'fragrance_time', value: fragranceTimeValue },
                    { name: 'fragrance_distance', value: fragranceDistanceValue },
                    { name: 'age_group', value: ageGroupValue },
                    { name: 'ingredients', value: ingredientValue },
                    { name: 'country', value: countryValue },
                ];
        
                for (const attribute of attributes) {
                    if (!attribute.value) {
                        alert(`Vui lòng chọn hoặc nhập ${attribute.name}!`);
                        return; // Trả về nếu thuộc tính không hợp lệ
                    }
                }
        
                // Lấy dữ liệu từ các thẻ input khác
                const summernoteContent = $('#summernote').summernote('code'); // Nội dung từ Summernote
        
                // Lấy dữ liệu từ các thẻ ảnh đã chọn (previewContainer)
                const files = document.getElementById('customFile').files;
        
                // Lấy dữ liệu phân loại sản phẩm (size, price, discount, quantity)
                const itemSizes = Array.from(document.querySelectorAll('#itemContainer .metadata-item')).map(item => ({
                    size: item.querySelector('.data-size')?.value || null,
                    price: item.querySelector('.data-prices')?.value || null,
                    discount: item.querySelector('.data-discount')?.value || 0,
                    quantity: item.querySelector('.data-quantity')?.value || 0 // Mặc định là 0 nếu không nhập
                })).filter(item => item.size && item.price); // filter out incomplete items
        
                // Kiểm tra itemSizes
                if (itemSizes.length === 0) {
                    alert("Vui lòng thêm ít nhất một phân loại sản phẩm!");
                    return; // Trả về nếu không có phân loại
                }
        
                // Chuẩn bị dữ liệu để gửi lên server
                const formData = new FormData();
        
                formData.append('product_name', productName);
                formData.append('short_description', shortDescription);
                formData.append('status', statusValue);
                formData.append('gender', genderValue);
                formData.append('category_id', categoryValue);
                formData.append('description', summernoteContent);
        
                // Thêm attribute
                attributes.forEach((attribute, index) => {
                    formData.append(`attributes[${index}][name]`, attribute.name);
                    formData.append(`attributes[${index}][value_id]`, attribute.value);
                });
        
                // Thêm các file ảnh vào formData
                for (let i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }
        
                // Thêm dữ liệu phân loại sản phẩm vào formData
                itemSizes.forEach((variant, index) => {
                    formData.append(`product_variants[${index}][size]`, variant.size);
                    formData.append(`product_variants[${index}][price]`, variant.price);
                    formData.append(`product_variants[${index}][discount]`, variant.discount || 0);
                    formData.append(`product_variants[${index}][quantity]`, variant.quantity || 0);
                });
        
                console.log("Form data to be sent:", formData);
        
                // Gửi dữ liệu lên server bằng fetch hoặc axios
                Api.Product.AddNewProduct(formData)
                    .then(response => {
                        // Xử lý thành công
                        console.log("Product added successfully:", response);
                        alert("Sản phẩm đã được thêm thành công!");
                        // Có thể đóng modal và cập nhật danh sách sản phẩm
                        $('.bd-example-modal-xl').modal('hide');
                        Product.productsList.show(); // Refresh danh sách sản phẩm
                    })
                    .catch(error => {
                        // Xử lý lỗi
                        console.error("Error adding product:", error);
                        if (error.response && error.response.data && error.response.data.errors) {
                            const errorMessages = [];
                            
                            // Duyệt qua các lỗi và tạo thông báo
                            for (const [field, messages] of Object.entries(error.response.data.errors)) {
                                errorMessages.push(`${field}: ${messages.join(', ')}`);
                            }
                    
                            // Hiển thị tất cả thông báo lỗi trong một alert
                            alert("Có lỗi xảy ra khi thêm sản phẩm:\n" + errorMessages.join('\n'));
                        } else {
                            alert("Có lỗi xảy ra khi thêm sản phẩm.");
                        }
                    });
            }
        
            // Hàm để lấy giá trị đã chọn hoặc nhập mới
            function getSelectedOrNewValue(selectId, inputId) {
                const selectElement = document.getElementById(selectId);
                const inputElement = document.getElementById(inputId);
                return (selectElement.value === 'other') ? inputElement.value : selectElement.value;
            }
        
            // Attach handleSubmit to the save button
            document.getElementById('save-btn').addEventListener('click', function () {
                handleSubmit();
            });
        },
        
        editProduct: () => {

        },
        deleteProduct: () => {

        }
    }
}

// Call the function to display the products
Product.productsList.show();

// Show modal add
Product.productDetails.showModalAdd();


// Initialize form submission handler once
Product.formSubmit.addProduct();
