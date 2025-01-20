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
    
/*                             const trendingStatus = `
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-${product.id}" ${product.trending ? 'checked' : ''}>
                                        <label for="switch-${product.id}"></label>
                                    </div>
                                </div>
                            `; */
                            const trendingStatus = `
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                    ${product.view}
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
                                `<a href="/nuoc-hoa/${product.slug}" target="_blank">${product.name}</a>`,
                                product.category_name,
                                `<div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="${product.images}" style="border: dotted 1px #f0069d; max-width: 60px" alt="">
                                </div>`,
                                productRows,
                                trendingStatus,
                                `<div class="text-right">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded edit-btn" data-id="${product.id}" data-toggle="modal" data-target=".bd-example-modal-xl">
                                        <i class="anticon anticon-eye"></i>
                                    </button>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded delete-btn" data-id="${product.id}" data-toggle="modal" data-target="#deleteModal">
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
    productDetail: {
        addProduct: () => {
            $(document).on('click', '#btn-add-product', function () {
                    // Xóa các trường nhập liệu
                    $('.modal-title').text('Thêm sản phẩm');
                    $('#modal-add-edit').attr('data-action', 'add');
                    const fileInput = document.getElementById('customFile');
                    const label = document.querySelector('.custom-file-label');
                    const previewContainer = document.getElementById('previewContainer');
                    const itemContainer = document.getElementById('itemContainer');

                    // Reset file input
                    fileInput.value = '';
                    label.textContent = 'Choose files';

                    // Xóa preview hình ảnh
                    previewContainer.innerHTML = '';

                    // Xóa các thuộc tính đã thêm
                    itemContainer.innerHTML = '';

                    //Xóa dữ liệu thẻ input
                    document.getElementsByName('product_name')[0].value = '';
                    document.getElementsByName('short_description')[0].value = '';
                    $('#summernote').summernote('code', '');
            });
            
            // Xử lý gắn dữ liệu cho category select
            function populateCategorySelect(selectId, categories) {
                const selectElement = document.getElementById(selectId);
                
                // Không xóa các option cảnh báo hiện có
                // Giữ lại các option có sẵn như "Chọn danh mục" hoặc "Chọn thương hiệu"
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    selectElement.appendChild(option);
                });
            }
        
            // Lấy danh sách category từ API và gắn vào select
            Api.Product.GetAllCategories()
                .then((response) => {
                    populateCategorySelect('inputState', response);
                })
                .catch((error) => {
                    console.error("Error fetching categories:", error);
                });
        
            // Xử lý gắn dữ liệu cho các select của thuộc tính
            function populateAttributeSelect(selectId, data) {
                const selectElement = document.getElementById(selectId);
                
                // Không xóa các option cảnh báo hiện có
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.value;
                    selectElement.appendChild(option);
                });
        
                // Thêm option "Khác"
/*                 const otherOption = document.createElement('option');
                otherOption.value = 'other';
                otherOption.textContent = 'Khác (Thêm mới)';
                selectElement.appendChild(otherOption); */
            }
        
            // Lấy tất cả thuộc tính sản phẩm từ API và gắn vào các select tương ứng
            Api.Product.GetAllAttributesValue()
                .then((response) => {
                    populateAttributeSelect('brandSelect', response.brand);
                    populateAttributeSelect('concentrationSelect', response.concentration);
                    populateAttributeSelect('styleSelect', response.style);
                    populateAttributeSelect('fragranceGroupSelect', response.frag_group);
                    populateAttributeSelect('fragranceTimeSelect', response.frag_time);
                    populateAttributeSelect('fragranceDistanceSelect', response.frag_distance);
                    populateAttributeSelect('ageGroupSelect', response.age_group);
                    populateAttributeSelect('ingredientSelect', response.ingredients);
                    populateAttributeSelect('countrySelect', response.country);
                })
                .catch((error) => {
                    console.error("Error fetching attributes:", error);
                });
        
            // Xử lý khi người dùng chọn "Khác"
            function handleSelectChange(selectId, inputId) {
                const selectElement = document.getElementById(selectId);
                const inputElement = document.getElementById(inputId);
        
                selectElement.addEventListener('change', () => {
                    if (selectElement.value === 'other') {
                        inputElement.style.display = 'block'; // Hiển thị input cho "Khác"
                    } else {
                        inputElement.style.display = 'none'; // Ẩn input
                        inputElement.value = ''; // Xóa giá trị input
                    }
                });
            }
        
            // Gọi hàm xử lý cho từng thuộc tính
            handleSelectChange('brandSelect', 'newBrandInput');
            handleSelectChange('concentrationSelect', 'newConcentrationInput');
            handleSelectChange('styleSelect', 'newStyleInput');
            handleSelectChange('fragranceGroupSelect', 'newFragranceGroupInput');
            handleSelectChange('fragranceTimeSelect', 'newFragranceTimeInput');
            handleSelectChange('fragranceDistanceSelect', 'newFragranceDistanceInput');
            handleSelectChange('ageGroupSelect', 'newAgeGroupInput');
            handleSelectChange('ingredientSelect', 'newIngredientInput');
            handleSelectChange('countrySelect', 'newCountryInput');
        
            // Xử lý summernote cho mô tả sản phẩm
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
                        /* ['insert', ['link', 'picture', 'video']], */
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }
            handleSummerNote();
        
/*             // Xử lý ảnh tải lên
            function handleImageUpload() {
                const uploadButton = document.getElementById('uploadButton');
                const fileInput = document.getElementById('customFile');
                const previewContainer = document.getElementById('previewContainer');
                const label = document.querySelector('.custom-file-label');
        
                uploadButton.addEventListener('click', () => {
                    fileInput.click();
                });
        
                fileInput.addEventListener('change', function() {
                    const files = this.files;
                    label.textContent = files.length > 0 ? `${files.length} file(s) selected` : 'Choose files';
        
                    // Xóa các ảnh preview cũ
                    previewContainer.innerHTML = '';
        
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.style.position = 'relative';
                            imgContainer.style.margin = '5px';
        
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '100px';
                            img.style.padding = '1rem';
                            img.style.border = 'solid 2px #1391c3';
                            img.style.borderRadius = '5px';
        
                            const removeIcon = document.createElement('span');
                            removeIcon.innerHTML = '<i class="anticon anticon-close-circle" style="font-size: 18px; color: #3f87f5; cursor: pointer; position: absolute; top: 10px; right: 1px;"></i>';
                            removeIcon.addEventListener('click', () => {
                                imgContainer.remove();
                            });
        
                            imgContainer.appendChild(img);
                            imgContainer.appendChild(removeIcon);
                            previewContainer.appendChild(imgContainer);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }
            handleImageUpload();
        
            // Xử lý thêm phân loại sản phẩm
            function handleAddSize() {
                const addItemButton = document.getElementById('addItemButton');
                const itemContainer = document.getElementById('itemContainer');
        
                addItemButton.addEventListener('click', () => {
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
        
                    itemContainer.insertAdjacentHTML('beforeend', newItem);
                });
        
                itemContainer.addEventListener('click', function(e) {
                    if (e.target.closest('.metadata-remove')) {
                        const itemToRemove = e.target.closest('.col-md-6');
                        if (itemToRemove) {
                            itemToRemove.remove();
                        }
                    }
                });
            }
            handleAddSize(); */

            //Xử lý ảnh tải lên và thêm phân loại sản phẩm
            Product.productDetail.handleImageUpload([]);
            Product.productDetail.handleAddSize([]);
        },
        
        editProduct: () => {
            $(document).on('click', '.edit-btn', function () {
                const productId = $(this).data('id');
                console.log('Editing product with ID:', productId);
                currentProductId = productId; // Lưu ID sản phẩm cần chỉnh sửa
                isEdit = true; // Đặt trạng thái đang chỉnh sửa
        
                // Đổi tên modal
                $('.modal-title').text('Chỉnh sửa sản phẩm');
                $('#modal-add-edit').attr('data-action', 'edit');
                $('#modal-add-edit').attr('data-product-id', productId);
        
                // Lấy dữ liệu chi tiết sản phẩm và điền vào form
                Api.Product.GetProductDetail(productId).then((response) => {
                    console.log('Product details:', response);
                    document.getElementsByName('product_name')[0].value = response.name;

                    //status 1:active,0:inactive, 2:out of stock
                    const statusValue = response.status;
                    const statusInputs = document.getElementsByName('status');
                    for (let i = 0; i < statusInputs.length; i++) {
                        if (statusInputs[i].value == statusValue) {
                            statusInputs[i].checked = true;
                        }
                    }

                    //gender 1:m, 0:fm, 2:unisex
                    const genderValue = response.gender;
                    const genderInputs = document.getElementsByName('gender');
                    for (let i = 0; i < genderInputs.length; i++) {
                        if (genderInputs[i].value == genderValue) {
                            genderInputs[i].checked = true;
                        }
                    }

                    //lấy ra thẻ có name="short_description" và gán giá trị cho nó là response.short_description
                    //document.getElementsByName('short_description')[0].value = response.short_description;

                    //category
                    document.getElementsByName('catergory')[0].value = response.category_id;

                    //short_description
                    document.getElementsByName('short_description')[0].value = response.short_description;

                    //brand product_attributes[0]
                    document.getElementById('brandSelect').value = response.product_attributes[0].attribute_value.id;
                    $('#brandSelect').select2().trigger('change');
                    //concentration product_attributes[1]
                    document.getElementById('concentrationSelect').value = response.product_attributes[1].attribute_value.id;
                    $('#concentrationSelect').select2().trigger('change');
                    //style product_attributes[2]
                    document.getElementById('styleSelect').value = response.product_attributes[2].attribute_value.id;
                    $('#styleSelect').select2().trigger('change');
                    //fragrance_group product_attributes[3]
                    document.getElementById('fragranceGroupSelect').value = response.product_attributes[3].attribute_value.id;
                    $('#fragranceGroupSelect').select2().trigger('change');
                    //fragrance_time product_attributes[4]
                    document.getElementById('fragranceTimeSelect').value = response.product_attributes[4].attribute_value.id;
                    $('#fragranceTimeSelect').select2().trigger('change');
                    //fragrance_distance product_attributes[5]
                    document.getElementById('fragranceDistanceSelect').value = response.product_attributes[5].attribute_value.id;
                    $('#fragranceDistanceSelect').select2().trigger('change');
                    //age_group product_attributes[6]
                    document.getElementById('ageGroupSelect').value = response.product_attributes[6].attribute_value.id;
                    $('#ageGroupSelect').select2().trigger('change');
                    //ingredient product_attributes[7]
                    document.getElementById('ingredientSelect').value = response.product_attributes[7].attribute_value.id;
                    $('#ingredientSelect').select2().trigger('change');
                    //country product_attributes[8]
                    document.getElementById('countrySelect').value = response.product_attributes[8].attribute_value.id;
                    $('#countrySelect').select2().trigger('change');

                    //description
                    $('#summernote').summernote('code', response.description);

                    //handleImageUpload, convert string to array
                    const existingImages = response.images.split(',');
                    Product.productDetail.handleImageUpload(existingImages);

                    //handleAddSize
                    const existingSizes = response.product_sizes;
                    Product.productDetail.handleAddSize(existingSizes);



                }).catch((error) => {
                    console.error("Error fetching product details:", error);
                });
            });
        },

        handleImageUpload: (existingImages = []) => {
            const clearEvents = (element) => {
                const newElement = element.cloneNode(true);
                element.parentNode.replaceChild(newElement, element);
                return newElement;
            };

            const uploadButton = clearEvents(document.getElementById('uploadButton'));
            const fileInput = clearEvents(document.getElementById('customFile'));
            const previewContainer = clearEvents(document.getElementById('previewContainer'));
            const label = clearEvents(document.querySelector('.custom-file-label'));

            previewContainer.innerHTML = '';
            
        
            uploadButton.addEventListener('click', () => {
                fileInput.click();
            });
        
            fileInput.addEventListener('change', function() {
                const files = this.files;
                label.textContent = files.length > 0 ? `${files.length} file(s) selected` : 'Choose files';
        
                // Xóa các ảnh preview cũ
                previewContainer.innerHTML = '';
        
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.style.position = 'relative';
                        imgContainer.style.margin = '5px';
        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px';
                        img.style.padding = '1rem';
                        img.style.border = 'solid 2px #1391c3';
                        img.style.borderRadius = '5px';
        
                        const removeIcon = document.createElement('span');
                        removeIcon.innerHTML = '<i class="anticon anticon-close-circle" style="font-size: 18px; color: #3f87f5; cursor: pointer; position: absolute; top: 10px; right: 1px;"></i>';
                        removeIcon.addEventListener('click', () => {
                            imgContainer.remove();
                        });
        
                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeIcon);
                        previewContainer.appendChild(imgContainer);
                    };
                    reader.readAsDataURL(file);
                });
            });
        
            // Hiển thị ảnh đã tải lên trước đó (nếu có)
            existingImages.forEach(imageUrl => {
                const imgContainer = document.createElement('div');
                imgContainer.style.position = 'relative';
                imgContainer.style.margin = '5px';
        
                const img = document.createElement('img');
                img.src = imageUrl; // URL của ảnh đã tải lên trước đó
                img.style.maxWidth = '100px';
                img.style.padding = '1rem';
                img.style.border = 'solid 2px #1391c3';
                img.style.borderRadius = '5px';
        
                const removeIcon = document.createElement('span');
                removeIcon.innerHTML = '<i class="anticon anticon-close-circle" style="font-size: 18px; color: #3f87f5; cursor: pointer; position: absolute; top: 10px; right: 1px;"></i>';
                removeIcon.addEventListener('click', () => {
                    imgContainer.remove(); // Xóa ảnh đã tải lên trước đó
                });
        
                imgContainer.appendChild(img);
                imgContainer.appendChild(removeIcon);
                previewContainer.appendChild(imgContainer);
            });
        },
        handleAddSize: (existingSizes = []) => {
            const clearEvents = (element) => {
                const newElement = element.cloneNode(true);
                element.parentNode.replaceChild(newElement, element);
                return newElement;
            };
            const addItemButton = clearEvents(document.getElementById('addItemButton'));
            const itemContainer = clearEvents(document.getElementById('itemContainer'));
            itemContainer.innerHTML = '';
        
            // Hiển thị các thuộc tính đã tồn tại (nếu có)
            existingSizes.forEach(size => {
                const newItem = `
                    <div class="col-md-6 col-sm-12 m-b-15">
                        <div class="metadata-item p-3 border border-dotted" style="border-color: #1391c3;">
                            <div class="form-group">
                                <label>Dung lượng *</label>
                                <input type="text" class="form-control data-size number-type" placeholder="ml" value="${size.size}">
                            </div>
                            <div class="form-group" style="display:none">
                                <label>Dung lượng cũ *</label>
                                <input type="text" class="form-control data-old-size number-type" placeholder="ml" value="${size.size}">
                            </div>
                            <div class="form-group">
                                <label>Đơn giá *</label>
                                <input type="number" class="form-control data-prices number-type" placeholder="" value="${size.price}">
                            </div>
                            <div class="form-group">
                                <label>Giá nhập *</label>
                                <input type="number" class="form-control data-entry-prices number-type" placeholder="" value="${size.entry_price}">
                            </div>
                            <div class="form-group">
                                <label>Giảm giá *</label>
                                <input type="text" class="form-control data-discount number-type" placeholder="%" value="${size.discount}">
                            </div>
                            <div class="form-group">
                                <label>Số lượng * (Mặc định 0)</label>
                                <input type="number" class="form-control data-quantity number-type" placeholder="" value="${size.quantity}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger metadata-remove" atr="Delete">Xóa thuộc tính</button>
                            </div>
                        </div>
                    </div>
                `;
        
                itemContainer.insertAdjacentHTML('beforeend', newItem);
            });
        
            addItemButton.addEventListener('click', () => {
                const newItem = `
                    <div class="col-md-6 col-sm-12 m-b-15">
                        <div class="metadata-item p-3 border border-dotted" style="border-color: #1391c3;">
                            <div class="form-group">
                                <label>Dung lượng *</label>
                                <input type="text" class="form-control data-size number-type" placeholder="ml">
                            </div>
                            <div class="form-group">
                                <label>Giá bán *</label>
                                <input type="number" class="form-control data-prices number-type" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Giá nhập *</label>
                                <input type="number" class="form-control data-entry-prices number-type" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Giảm giá *</label>
                                <input type="text" class="form-control data-discount number-type" placeholder="%">
                            </div>
                            <div class="form-group">
                                <label>Số lượng * (Tạo mới: SL có thể bán = SL kho)</label>
                                <input type="number" class="form-control data-quantity number-type" placeholder="">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger metadata-remove" atr="Delete">Xóa thuộc tính</button>
                            </div>
                        </div>
                    </div>
                `;
        
                itemContainer.insertAdjacentHTML('beforeend', newItem);
            });
        
            itemContainer.addEventListener('click', function(e) {
                if (e.target.closest('.metadata-remove')) {
                    const itemToRemove = e.target.closest('.col-md-6');
                    if (itemToRemove) {
                        itemToRemove.remove();
                    }
                }
            });
        },

        deleteProduct: () => {
            //Soft delete
            $(document).on('click', '.delete-btn', function () {
                const productId = $(this).data('id');
                console.log('Deleting product with ID:', productId);
                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
                    Api.Product.SoftDeleteProduct(productId).then((response) => {
                        alert('Sản phẩm đã được xóa thành công!');
                        Product.productsList.show(); // Refresh danh sách sản phẩm
                    }).catch((error) => {
                        alert('Có lỗi xảy ra khi xóa sản phẩm!');
                        
                        console.error("Error deleting product:", error);
                    });
                }
            });
        }
    },
    formSubmit: {
        handleInput: (isEdit) => {
            const productName = document.getElementById('formGroupExampleInput').value.trim();
            const shortDescription = document.querySelector('textarea[name="short_description"]').value.trim();
            const genderValue = document.querySelector('input[name="gender"]:checked')?.value;
            const statusValue = document.querySelector('input[name="status"]:checked')?.value;
            const categoryValue = document.getElementById('inputState').value;
    
            // Kiểm tra các trường bắt buộc
            if (!productName || !shortDescription || !genderValue || !categoryValue || !statusValue) {
                alert("Vui lòng điền đầy đủ thông tin sản phẩm!");
                return null; // Trả về null nếu không hợp lệ
            }
    
            // Lấy dữ liệu từ các select thuộc tính
            const attributes = Product.formSubmit.getAttributes();
    
            // Kiểm tra thuộc tính
            for (const attribute of attributes) {
                if (!attribute.value) {
                    alert(`Vui lòng chọn hoặc nhập ${attribute.name}!`);
                    return null; // Trả về null nếu thuộc tính không hợp lệ
                }

                //Kiểm tra nếu attribute.value không phải là số và <0
/*                 let value = Number(attribute.value);  // Chuyển giá trị sang số

                if (isNaN(value) || value < 0) {
                    alert(`Vui lòng nhập giá trị hợp lệ cho ${attribute.name}!`);
                    return null;  // Trả về null nếu thuộc tính không hợp lệ
                } */
            }
    
            // Lấy dữ liệu từ Summernote và các input
            const summernoteContent = $('#summernote').summernote('code');
            const files = document.getElementById('customFile').files;
    
            // Lấy dữ liệu phân loại sản phẩm
            const itemSizes = Array.from(document.querySelectorAll('#itemContainer .metadata-item')).map(item => ({
                size: item.querySelector('.data-size')?.value || null,
                oldSize: item.querySelector('.data-old-size')?.value || 999,
                price: item.querySelector('.data-prices')?.value || null,
                entry_price: item.querySelector('.data-entry-prices')?.value || null,
                discount: item.querySelector('.data-discount')?.value || 0,
                quantity: item.querySelector('.data-quantity')?.value || 0,
                entry_price: item.querySelector('.data-entry-prices')?.value || 0
            })).filter(item => item.size && item.price); // filter out incomplete items
            

            // Kiểm tra nếu có giá trị price và entry_price hợp lệ
            for (const item of itemSizes) {
                const price = parseFloat(item.price);
                const entry_price = parseFloat(item.entry_price);
                const quantity = parseFloat(item.quantity);

                if (isNaN(price) || price <= 0) {
                    alert("Vui lòng nhập giá trị hợp lệ cho giá sản phẩm!");
                    return null; // Trả về null nếu price không hợp lệ
                }

                if (isNaN(entry_price) || entry_price <= 0) {
                    alert("Vui lòng nhập giá trị hợp lệ cho giá nhập khẩu!");
                    return null; // Trả về null nếu entry_price không hợp lệ
                }

                if (isNaN(quantity) || quantity < 0) {
                    alert("Vui lòng nhập giá trị hợp lệ cho số lượng sản phẩm!");
                    return null; // Trả về null nếu quantity không hợp lệ
                }

            }

            
            // Kiểm tra itemSizes
            if (itemSizes.length === 0) {
                alert("Vui lòng thêm ít nhất một phân loại sản phẩm!");
                return null; // Trả về null nếu không có phân loại
            }

            //Thông báo nếu có phân loại có size trùng nhau
            const sizeSet = new Set();
            for (const item of itemSizes) {
                if (sizeSet.has(item.size)) {
                    alert("Không thể thêm nhiều phân loại cùng kích thước!");
                    return null; // Trả về null nếu có phân loại trùng kích thước
                }
                sizeSet.add(item.size);
            }

            //Kiểm tra xem có file ảnh nào được chọn không
            if (files.length === 0 && isEdit === false) {
                alert("Không được để trống hình ảnh sản phẩm !");
                return null; // Trả về null nếu không có ảnh
            }            

            return {
                productName,
                shortDescription,
                genderValue,
                statusValue,
                categoryValue,
                summernoteContent,
                files,
                attributes,
                itemSizes
            };
        },
    
        addProduct: () => {
            function handleSubmit(isEdit = false) {
                const inputData = Product.formSubmit.handleInput(isEdit);
                if (!inputData) return; // Kiểm tra xem dữ liệu có hợp lệ không
    
                const formData = new FormData();
                formData.append('product_name', inputData.productName);
                formData.append('short_description', inputData.shortDescription);
                formData.append('status', inputData.statusValue);
                formData.append('gender', inputData.genderValue);
                formData.append('category_id', inputData.categoryValue);
                formData.append('description', inputData.summernoteContent);
    
                // Thêm attribute
                inputData.attributes.forEach((attribute, index) => {
                    formData.append(`attributes[${index}][name]`, attribute.name);
                    formData.append(`attributes[${index}][value_id]`, attribute.value);
                });

                // Nếu là chỉnh sửa, thêm ảnh đã có vào formData
                if (isEdit) {
                    const existingImages = document.querySelectorAll('#imageContainer img');
                    existingImages.forEach(img => {
                        formData.append('existing_images[]', img.src); // Gửi đường dẫn hình ảnh hiện có
                    });
                }
    
                // Thêm các file ảnh vào formData
                for (let i = 0; i < inputData.files.length; i++) {
                    formData.append('images[]', inputData.files[i]);
                }
    
                // Thêm dữ liệu phân loại sản phẩm vào formData
                inputData.itemSizes.forEach((variant, index) => {

                    formData.append(`product_variants[${index}][size]`, variant.size);
                    formData.append(`product_variants[${index}][oldSize]`, variant.oldSize) || 0;
                    formData.append(`product_variants[${index}][price]`, variant.price);
                    formData.append(`product_variants[${index}][entry_price]`, variant.entry_price);
                    formData.append(`product_variants[${index}][discount]`, variant.discount || 0);
                    formData.append(`product_variants[${index}][quantity]`, variant.quantity || 0);

                });
    
                const apiMethod = isEdit ? Api.Product.EditProduct : Api.Product.AddNewProduct;
                if (isEdit) {
                    let currentProductId = $('#modal-add-edit').data('product-id'); // Lấy giá trị từ data-product-id
                    formData.append('product_id', currentProductId); // Thêm product_id vào formData
                }
                apiMethod(formData)
                    .then(response => {
                        alert(`Sản phẩm đã được ${isEdit ? 'cập nhật' : 'thêm'} thành công!`);
                        $('.bd-example-modal-xl').modal('hide');
                        Product.productsList.show(); // Refresh danh sách sản phẩm
                        //reload lại trang
                        //location.reload();
                    })
                    .catch(error => {
                        console.error("Error processing product:", error);
                        // Xử lý lỗi như trước
                    });
            }
    
            // Gắn sự kiện cho nút lưu
            document.getElementById('save-btn').addEventListener('click', function () {

                //lấy ra data-action ở id="modal-add-edit" => kiểm tra xem trạng thái của save là add hay edit
                const isEdit2 = document.getElementById('modal-add-edit').getAttribute('data-action') === 'edit'; // Kiểm tra action
                console.log(isEdit2);

                const isEdit = this.getAttribute('data-action') === 'edit'; // Kiểm tra action
                handleSubmit(isEdit2); // Gọi handleSubmit với isEdit
            });
        },
    
        editProduct: () => {
            function handleSubmit(isEdit) {
                const formData = new FormData();
            
                // Lấy dữ liệu từ form
                formData.append('product_name', document.getElementById('formGroupExampleInput').value);
                formData.append('short_description', document.querySelector('textarea[name="short_description"]').value);
                formData.append('gender', document.querySelector('input[name="gender"]:checked').value);
                formData.append('status', document.querySelector('input[name="status"]:checked').value);
                formData.append('category_id', document.getElementById('inputState').value);
                formData.append('description', $('#summernote').summernote('code'));
            
                // Lấy các thuộc tính
                const attributes = document.querySelectorAll('.metadata-item');
                attributes.forEach(attr => {
                    const size = attr.querySelector('.data-size').value;
                    const price = attr.querySelector('.data-prices').value;
                    const entry_price = attr.querySelector('.data-entry_prices').value;
                    const discount = attr.querySelector('.data-discount').value;
                    const quantity = attr.querySelector('.data-quantity').value;

                    const oldSize = attr.querySelector('.data-old-size').value;
            
                    // Thêm thuộc tính vào formData
                    formData.append('product_variants[]', JSON.stringify({ size, price,entry_price, discount, quantity, oldSize }));
                });
            
                // Nếu là chỉnh sửa, thêm ảnh đã có vào formData
                if (isEdit) {
                    const existingImages = document.querySelectorAll('#imageContainer img');
                    existingImages.forEach(img => {
                        formData.append('existing_images[]', img.src); // Gửi đường dẫn hình ảnh hiện có
                    });
                }
            
                // Thêm các file ảnh mới vào formData
                const files = document.getElementById('customFile').files;
                for (let i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }
            
                // Gọi API để lưu sản phẩm
                Api.Product.SaveProduct(formData, isEdit)
                    .then(response => {
                        alert("Sản phẩm đã được lưu thành công.");
                        // Xử lý sau khi lưu thành công
                    })
                    .catch(error => {
                        console.error("Error saving product:", error);
                        alert("Có lỗi xảy ra khi lưu sản phẩm.");
                    });
            }
            
            function handleEdit() {
                const productId = $('#modal-add-edit').data('product-id');
        
                Api.Product.GetProductById(productId)
                    .then(response => {
                        const product = response.data;
                        // Cập nhật các trường trong form với thông tin sản phẩm hiện tại
                        document.getElementById('formGroupExampleInput').value = product.product_name;
                        document.querySelector('textarea[name="short_description"]').value = product.short_description;
                        document.querySelector(`input[name="gender"][value="${product.gender}"]`).checked = true;
                        document.querySelector(`input[name="status"][value="${product.status}"]`).checked = true;
                        document.getElementById('inputState').value = product.category_id;
        
                        $('#summernote').summernote('code', product.description);
        
                        // Cập nhật thuộc tính sản phẩm
                        const attributes = product.attributes || [];
                        attributes.forEach(attr => {
                            const selectElement = document.getElementById(attr.name + 'Select');
                            const inputElement = document.getElementById('new' + attr.name.charAt(0).toUpperCase() + attr.name.slice(1) + 'Input');
        
                            if (selectElement) {
                                selectElement.value = attr.value_id;
                            } else if (inputElement) {
                                inputElement.value = attr.value;
                            }
                        });
        
                        // Cập nhật thông tin phân loại sản phẩm
                        const itemContainer = document.getElementById('itemContainer');
                        itemContainer.innerHTML = '';
        
                        product.product_variants.forEach(variant => {
                            const variantHTML = `
                                <div class="metadata-item">
                                    <input type="text" class="data-size" value="${variant.size}" placeholder="Size" required />
                                    <input type="number" class="data-prices" value="${variant.price}" placeholder="Price" required />
                                    <input type="number" class="data-discount" value="${variant.discount}" placeholder="Discount" />
                                    <input type="number" class="data-quantity" value="${variant.quantity}" placeholder="Quantity" />
                                </div>
                            `;
                            itemContainer.insertAdjacentHTML('beforeend', variantHTML);
                        });
        
                        // Cập nhật hình ảnh hiện có
                        const imageContainer = document.getElementById('imageContainer');
                        imageContainer.innerHTML = ''; // Xóa hình ảnh cũ nếu có
                        product.images.forEach(imageUrl => {
                            const imgElement = document.createElement('img');
                            imgElement.src = imageUrl; // Đường dẫn hình ảnh hiện có
                            imgElement.alt = "Product Image";
                            imgElement.style.width = '100px'; // Kích thước tùy chỉnh
                            imgElement.style.marginRight = '10px';
                            imageContainer.appendChild(imgElement);
                        });
        
                        // Gắn lại sự kiện cho nút lưu để sửa sản phẩm
                        const saveBtn = document.getElementById('save-btn');
                        saveBtn.setAttribute('data-action', 'edit');
                        saveBtn.onclick = function () {
                            handleSubmit(true); // Gọi hàm handleSubmit với isEdit = true
                        };
        
                        $('.bd-example-modal-xl').modal('show');
                    })
                    .catch(error => {
                        console.error("Error fetching product:", error);
                        alert("Có lỗi xảy ra khi lấy thông tin sản phẩm.");
                    });
            }
        
            // Gọi hàm handleEdit để thực hiện chỉnh sửa sản phẩm
            handleEdit();
        },
        
        
        
        getAttributes: () => {
            return [
                { name: 'brand', value: Product.formSubmit.getSelectedOrNewValue('brandSelect', 'newBrandInput') },
                { name: 'concentration', value: Product.formSubmit.getSelectedOrNewValue('concentrationSelect', 'newConcentrationInput') },
                { name: 'style', value: Product.formSubmit.getSelectedOrNewValue('styleSelect', 'newStyleInput') },
                { name: 'fragrance_group', value: Product.formSubmit.getSelectedOrNewValue('fragranceGroupSelect', 'newFragranceGroupInput') },
                { name: 'fragrance_time', value: Product.formSubmit.getSelectedOrNewValue('fragranceTimeSelect', 'newFragranceTimeInput') },
                { name: 'fragrance_distance', value: Product.formSubmit.getSelectedOrNewValue('fragranceDistanceSelect', 'newFragranceDistanceInput') },
                { name: 'age_group', value: Product.formSubmit.getSelectedOrNewValue('ageGroupSelect', 'newAgeGroupInput') },
                { name: 'ingredients', value: Product.formSubmit.getSelectedOrNewValue('ingredientSelect', 'newIngredientInput') },
                { name: 'country', value: Product.formSubmit.getSelectedOrNewValue('countrySelect', 'newCountryInput') },
            ];
        },
    
        getSelectedOrNewValue: (selectId, inputId) => {
            const selectElement = document.getElementById(selectId);
            const inputElement = document.getElementById(inputId);
            return (selectElement.value === 'other') ? inputElement.value : selectElement.value;
        },
    },
    attribute : {
        addAttribute: () => {
            $('.add-new-att').on('click', function() {
                var attribute_id = $(this).data('att-id'); // Chuyển `this` thành đối tượng jQuery
                var title_index = [
                    'Thêm nồng độ',
                    'Thêm phong cách',
                    'Thêm nhóm hương',
                    'Thêm độ lưu hương',
                    'Thêm độ tỏa hương',
                    'Thêm xuất xứ',
                    'Thêm thương hiệu',
                    'Thêm độ tuổi',
                    'Thêm thành phần'
                ]
                $('#exampleModalCenterTitle2').text(title_index[attribute_id-1]);

                console.log(attribute_id); // In ra giá trị thực của biến `attribute`
                $('#save-att-value').off('click').on('click', function() {
                    var data = {
                        'attribute_id': attribute_id,
                        'value': $('#value-of-att').val()
                    };
                    //Kiểm tra trống
                    if(data.value == ''){
                        alert('Vui lòng nhập giá trị');
                        //return;
                    }
                    Api.Product.AddNewValue(data).then((response) => {
                        $('#exampleModalCenter').modal('hide');
                        console.log(data);
                        Product.productDetail.addProduct();
                        
                    }).fail((error) => {
                        alert('Thêm thất bại!');
                        console.log(error);
                    });
                    
                    
                });

            });
        }
    }
    
    
}

// Call the function to display the products
Product.productsList.show();

// Show modal add
Product.productDetail.addProduct();

// Initialize form submission handler once
Product.formSubmit.addProduct();

// Edit product
Product.productDetail.editProduct();

// Add attribute
//Xóa dữ liệu trước khi thêm??
Product.attribute.addAttribute();

// Delete product
Product.productDetail.deleteProduct();