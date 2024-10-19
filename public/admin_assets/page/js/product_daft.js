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
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded view-btn" data-id="${product.id}">
                                        <i class="anticon anticon-eye"></i>
                                    </button>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded edit-btn" data-id="${product.id}" data-toggle="modal" data-target=".bd-example-modal-xl">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded delete-btn" data-id="${product.id}">
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
                const otherOption = document.createElement('option');
                otherOption.value = 'other';
                otherOption.textContent = 'Khác (Thêm mới)';
                selectElement.appendChild(otherOption);
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

                    //category
                    document.getElementsByName('catergory')[0].value = response.category_id;

                    //short_description
                    document.getElementsByName('short_description')[0].value = response.short_description;

                    //brand product_attributes[0]
                    document.getElementById('brandSelect').value = response.product_attributes[0].attribute_value.id;
                    //concentration product_attributes[1]
                    document.getElementById('concentrationSelect').value = response.product_attributes[1].attribute_value.id;
                    //style product_attributes[2]
                    document.getElementById('styleSelect').value = response.product_attributes[2].attribute_value.id;
                    //fragrance_group product_attributes[3]
                    document.getElementById('fragranceGroupSelect').value = response.product_attributes[3].attribute_value.id;
                    //fragrance_time product_attributes[4]
                    document.getElementById('fragranceTimeSelect').value = response.product_attributes[4].attribute_value.id;
                    //fragrance_distance product_attributes[5]
                    document.getElementById('fragranceDistanceSelect').value = response.product_attributes[5].attribute_value.id;
                    //age_group product_attributes[6]
                    document.getElementById('ageGroupSelect').value = response.product_attributes[6].attribute_value.id;
                    //ingredient product_attributes[7]
                    document.getElementById('ingredientSelect').value = response.product_attributes[7].attribute_value.id;
                    //country product_attributes[8]
                    document.getElementById('countrySelect').value = response.product_attributes[8].attribute_value.id;

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
                            <div class="form-group">
                                <label>Đơn giá *</label>
                                <input type="text" class="form-control data-prices number-type" placeholder="" value="${size.price}">
                            </div>
                            <div class="form-group">
                                <label>Giảm giá *</label>
                                <input type="text" class="form-control data-discount number-type" placeholder="%" value="${size.discount}">
                            </div>
                            <div class="form-group">
                                <label>Số lượng * (Mặc định 0)</label>
                                <input type="text" class="form-control data-quantity number-type" placeholder="" value="${size.quantity}">
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
        },

        deleteProduct: () => {}
    },
    formSubmit: {
        addProduct: () => {
            function handleSubmit(isEdit = false) {
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
                const attributes = getAttributes();
    
                // Kiểm tra thuộc tính
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
                const apiMethod = isEdit ? Api.Product.EditProduct : Api.Product.AddNewProduct;
                apiMethod(formData)
                    .then(response => {
                        // Xử lý thành công
                        console.log("Product processed successfully:", response);
                        alert(`Sản phẩm đã được ${isEdit ? 'cập nhật' : 'thêm'} thành công!`);
                        // Có thể đóng modal và cập nhật danh sách sản phẩm
                        $('.bd-example-modal-xl').modal('hide');
                        Product.productsList.show(); // Refresh danh sách sản phẩm
                    })
                    .catch(error => {
                        // Xử lý lỗi
                        console.error("Error processing product:", error);
                        if (error.response && error.response.data && error.response.data.errors) {
                            const errorMessages = [];
                            
                            // Duyệt qua các lỗi và tạo thông báo
                            for (const [field, messages] of Object.entries(error.response.data.errors)) {
                                errorMessages.push(`${field}: ${messages.join(', ')}`);
                            }
    
                            // Hiển thị tất cả thông báo lỗi trong một alert
                            alert("Có lỗi xảy ra khi xử lý sản phẩm:\n" + errorMessages.join('\n'));
                        } else {
                            alert("Có lỗi xảy ra khi xử lý sản phẩm.");
                        }
                    });
            }
    
            // Hàm để lấy giá trị đã chọn hoặc nhập mới
            function getSelectedOrNewValue(selectId, inputId) {
                const selectElement = document.getElementById(selectId);
                const inputElement = document.getElementById(inputId);
                return (selectElement.value === 'other') ? inputElement.value : selectElement.value;
            }
    
            // Hàm lấy thuộc tính sản phẩm
            function getAttributes() {
                return [
                    { name: 'brand', value: getSelectedOrNewValue('brandSelect', 'newBrandInput') },
                    { name: 'concentration', value: getSelectedOrNewValue('concentrationSelect', 'newConcentrationInput') },
                    { name: 'style', value: getSelectedOrNewValue('styleSelect', 'newStyleInput') },
                    { name: 'fragrance_group', value: getSelectedOrNewValue('fragranceGroupSelect', 'newFragranceGroupInput') },
                    { name: 'fragrance_time', value: getSelectedOrNewValue('fragranceTimeSelect', 'newFragranceTimeInput') },
                    { name: 'fragrance_distance', value: getSelectedOrNewValue('fragranceDistanceSelect', 'newFragranceDistanceInput') },
                    { name: 'age_group', value: getSelectedOrNewValue('ageGroupSelect', 'newAgeGroupInput') },
                    { name: 'ingredients', value: getSelectedOrNewValue('ingredientSelect', 'newIngredientInput') },
                    { name: 'country', value: getSelectedOrNewValue('countrySelect', 'newCountryInput') },
                ];
            }
    
            // Attach handleSubmit to the save button
            document.getElementById('save-btn').addEventListener('click', function () {
                handleSubmit();
            });
        },
    
        editProduct: () => {
            function handleEdit(productId) {
                // Tương tự như handleSubmit trong addProduct nhưng cần thêm productId để chỉnh sửa
                // Thêm logic để lấy thông tin sản phẩm hiện tại và điền vào form trước khi gửi
    
                // Sau khi đã lấy được thông tin sản phẩm hiện tại, bạn có thể gọi handleSubmit với isEdit = true
                handleSubmit(true);
                
            }
    
            // Ví dụ sử dụng: Gọi handleEdit với ID sản phẩm cụ thể
            const productId = 123; // Thay thế bằng ID sản phẩm thực tế
            handleEdit(productId);
        },

        handleInput: () => {

        },
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