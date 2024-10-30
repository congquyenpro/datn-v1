// /products?age=20&fragrance_group=floral&fragrance_note=rose&_page=2&_limit=10&_sort=price&_order=asc&
//https://example.com/search?category_id=1&min_price=200&max_price=600&style[]=3&style[]=4&concentration[]=5&longevity[]=6&longevity[]=7


//Chú ý Danh mục có thể # thương hiệu
//VD: Danh mục (Sản phẩm lẻ, Hàng mới về: auto khi thêm sp, Hàng hot, Combo, Set quà tặng, Dịp lễ, Hàng chính hãng, xách tay, Rep 1....) => khác biệt: phân danh mục rõ ràng

//Dự kiến: CHo danh mục thì dùng slug: /category-slug?brand=$gender=&
//ex : /all?brand=?  /for-you?gender=&min_price=&max_price=&

//Định dạng chuẩn /category-slug?criteria1=value1&criteria2=value2&criteria3=value3&criteria4=value4&criteria5=value5&criteria6=value6&criteria7=value7&criteria8=value8&criteria9=value9&criteria10=value10

//Thứ tự chuẩn: /category-slug?brand=v1&gender=v2&volume=v3&price=v6&age=v7&concentration=v8&frag_group=v9&frag_time=v10&frag_distance=v11&style=v12   v:dạng id
//Mặc định: /all
const PageProduct = {
    Attributes1: {},
    default : {
        /* Default khi truy cập */
        setDefault : function () {
            return Api.Atrributes.getAll()
                .done((data) => {
                    PageProduct.Attributes1 = data.data; 

                    /* start sidebar */
                    const Attributes = data.data; //Fakde data: 0-brand, 1-gender, 2-volume, 3-price, 4-country, 5-age, 6-concentration, 7-style, 8-frag_group, 9-frag_time, 10-frag_distance
                    
                    // Hàm để đánh dấu các checkbox dựa trên tham số URL
                    const markCheckboxes = (idName) => {
                        const urlParams = new URLSearchParams(window.location.search);
                        const attName = idName.split('-')[1];
                        const selectedValue = urlParams.get(attName);

                        if (selectedValue) {
                            const checkboxes = document.querySelectorAll(`#${idName} input[type="checkbox"]`);
                            checkboxes.forEach(checkbox => {
                                if (checkbox.id === selectedValue) {
                                    checkbox.checked = true;
                                }
                            });
                        }
                    };                      

                    /* start brand */
                    const brand = Attributes.brand; //lấy ra các values của attribute brand
                    const brand_values = $('#filter-brand');
                    brand.forEach(element => {
                        brand_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-brand');

                    /* start gender */
                    const gender = Attributes.brand; //lấy ra các values của attribute gender
                    const gender_values = $('#filter-gender');
                    gender.forEach(element => {
                        gender_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}a</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-gender');
                
                    /* start country */
                    const country = Attributes.country; //lấy ra các values của attribute country
                    const country_values = $('#filter-country');
                    country.forEach(element => {
                        country_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-country');

                    /* start age-group */
                    const age = Attributes.age_group; //lấy ra các values của attribute age
                    const age_values = $('#filter-age_group');
                    age.forEach(element => {
                        age_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-age_group');

                    /* start concentration */
                    const concentration = Attributes.concentration; //lấy ra các values của attribute concentration
                    const concentration_values = $('#filter-concentration');
                    concentration.forEach(element => {
                        concentration_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-concentration');

                    /* start style */
                    const style = Attributes.style; //lấy ra các values của attribute style
                    const style_values = $('#filter-style');
                    style.forEach(element => {
                        style_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-style');

                    /* start frag-group */
                    const frag_group = Attributes.frag_group; //lấy ra các values của attribute frag_group
                    const frag_group_values = $('#filter-frag_group');
                    frag_group.forEach(element => {
                        frag_group_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-frag_group');

                    /* start frag-time */
                    const frag_time = Attributes.frag_time; //lấy ra các values của attribute frag_time
                    const frag_time_values = $('#filter-frag_time');
                    frag_time.forEach(element => {
                        frag_time_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-frag_time');

                    /* start frag-distance */
                    const frag_distance = Attributes.frag_distance; //lấy ra các values của attribute frag_distance
                    const frag_distance_values = $('#filter-frag_distance');
                    frag_distance.forEach(element => {
                        frag_distance_values.append(`
                            <li>
                                <input type="checkbox" id="${element.id}">
                                <label for="${element.id}" class="label-text">${element.value}</label>
                            </li>
                        `);
                    });
                    markCheckboxes('filter-frag_distance');



                    // Thiết lập tìm kiếm cho các thuộc tính
                    PageProduct.default.search('#brand-search', '#filter-brand li');
                    PageProduct.default.search('#country-search', '#filter-country li');
                    PageProduct.default.search('#age-group-search', '#filter-age_group li');
                    PageProduct.default.search('#concentration-search', '#filter-concentration li');
                    PageProduct.default.search('#style-search', '#filter-style li');
                    PageProduct.default.search('#frag-group-search', '#filter-frag_group li');
                    PageProduct.default.search('#frag-time-search', '#filter-frag_time li');
                    PageProduct.default.search('#frag-distance-search', '#filter-frag_distance li');


                    //get selected value
                    PageProduct.default.getSelectedValue('filter-brand');
                    PageProduct.default.getSelectedValue('filter-gender');
                    PageProduct.default.getSelectedValue('filter-country');
                    PageProduct.default.getSelectedValue('filter-age_group');
                    PageProduct.default.getSelectedValue('filter-concentration');
                    PageProduct.default.getSelectedValue('filter-style');
                    PageProduct.default.getSelectedValue('filter-frag_group');
                    PageProduct.default.getSelectedValue('filter-frag_time');
                    PageProduct.default.getSelectedValue('filter-frag_distance');

                    
                    

                })
                .fail((error) => {
                    console.error('Error fetching attributes:', error);
                });
        },

        /* Lấy giá trị được chọn từ các thuộc tính */
        getSelectedValue: function (idName) {
            const widgetContainer = document.getElementById(idName);
            
            if (!widgetContainer) {
                console.error(`Element with id "${idName}" not found.`);
                return;
            }
            
            const oneChoiceWidgets = widgetContainer.querySelectorAll('.list-categories input[type="checkbox"]');
        
            oneChoiceWidgets.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const attName = idName.split('-')[1]; // filter-brand => brand
                    
                    // Lấy tất cả tham số hiện tại từ URL
                    const urlParams = new URLSearchParams(window.location.search);
        
                    if (checkbox.checked) {
                        // Nếu checkbox được chọn, cập nhật tham số
                        urlParams.set(attName, checkbox.id);
                        //xóa các checkbox khác
                        oneChoiceWidgets.forEach(otherCheckbox => {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.checked = false;
                            }
                        });
                    } else {
                        // Nếu checkbox không được chọn, xóa tham số
                        urlParams.delete(attName);
                    }
        
                    //tạo link
                    const link = `/shop?${urlParams.toString()}`;
                    history.pushState(null, '', link);
        
                });
            });
        },

        /* Thiết lập cho box tìm kiếm ở đầu các thuộc tính */
        search: function (searchInputId, listItemSelector) {
            $(searchInputId).on('input', function() {
                const searchValue = $(this).val().toLowerCase(); // Lấy giá trị tìm kiếm và chuyển sang chữ thường
                
                // Lọc các mục trong danh sách
                $(listItemSelector).each(function() {
                    const labelText = $(this).find('label').text().toLowerCase(); // Lấy text của nhãn
                    
                    // Kiểm tra nếu labelText chứa searchValue
                    if (labelText.includes(searchValue)) {
                        $(this).show(); // Hiện mục nếu tìm thấy
                    } else {
                        $(this).hide(); // Ẩn mục nếu không tìm thấy
                    }
                });
            });
        },
        

        
    },

    products : {
        getDefaultProducts : function (page, page_size, field, order) {

            const urlParams = new URLSearchParams(window.location.search);
            const paramsArray = [];
            // Lặp qua từng tham số và thêm vào mảng
            urlParams.forEach((value, key) => {
                paramsArray.push(`${key}=${value}`);
            });
            // Thêm tham số page
            const page_into = page; // hoặc giá trị bạn muốn truyền
            paramsArray.push(`page=${page_into}`);
            // Tạo chuỗi filter
            const filter = `field=price&order=asc&${paramsArray.join('&')}`;

            console.log(filter);



            Api.Product.GetProducts(filter).done(response => {
                // Xử lý dữ liệu sản phẩm trả về (data, pagination)
                console.log(response.data); 
                console.log(response.pagination);
                
                product_list = response.data;
                const productContainer = $('#product-list');
                productContainer.empty();
                product_list.forEach(product => {
                    productContainer.append(`
                    <li class="product-item  col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-1" data-id-size="${product.product_size_id}" data-id="${product.id}" data-size="${product.size}">
                    <div class="product-inner equal-element">
                        <div class="product-top">
                            <div class="flash">
                                    <span class="onnew">
                                        <span class="text">
                                            new
                                        </span>
                                    </span>
                            </div>
                        </div>
                        <div class="product-thumb">
                            <div class="thumb-inner">
                                <a href="productdetails-rightsidebar.html">
                                    <img src="${product.images}" alt="img">
                                </a>
                                <div class="thumb-group">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button">
                                            <a href="#">Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <a href="productdetails-rightsidebar.html" class="button quick-wiew-button">Quick View</a>
                                    <div class="loop-form-add-to-cart">
                                        <button class="single_add_to_cart_button button">Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-name product_title">
                                <a href="#">${product.name}</a>
                            </h5>
                            <div class="group-info">
                                <div class="stars-rating">
                                    <div class="star-rating">
                                        <span class="star-3"></span>
                                    </div>
                                    <div class="count-star">
                                        (3)
                                    </div>
                                </div>
                                <div class="price">
                                    <del>
                                    ${product.price}
                                    </del>
                                    <ins>
                                    ${product.price + product.price * product.discount/100}
                                    </ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    `);
                });
                
                // Cập nhật phân trang
                PageProduct.pagination.renderPagination(response.pagination);
            }).fail(error => {
                console.error('Error fetching products:', error);
            });

        },
        getFilteredProducts : function (page, page_size, field, order) {
            //page:1 , page_size: 20, field: price, order: asc
        },

        
    },

    pagination: {
        renderPagination: function (pagination) {
            const { current_page, total_pages } = pagination;
            const paginationContainer = $('.pagination .nav-link');
    
            // Xóa các liên kết phân trang hiện có
            paginationContainer.empty();
    
            // Thêm liên kết "Previous"
            if (current_page > 1) {
                paginationContainer.append(`<a href="#" class="page-numbers" data-page="${current_page - 1}"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>`);
            }
    
            // Thêm các liên kết trang
            const maxPagesToShow = 3; // Số lượng trang tối đa hiển thị
            let startPage = Math.max(1, current_page - Math.floor(maxPagesToShow / 2));
            let endPage = Math.min(total_pages, startPage + maxPagesToShow - 1);
    
            if (endPage - startPage < maxPagesToShow - 1) {
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }
    
            for (let i = startPage; i <= endPage; i++) {
                if (i === current_page) {
                    paginationContainer.append(`<a href="#" class="page-numbers current">${i}</a>`);
                } else {
                    paginationContainer.append(`<a href="#" class="page-numbers" data-page="${i}">${i}</a>`);
                }
            }
    
            // Thêm dấu "..." nếu cần
            if (startPage > 1) {
                paginationContainer.prepend(`<span>...</span>`);
                paginationContainer.prepend(`<a href="#" class="page-numbers" data-page="1">1</a>`);
            }
    
            if (endPage < total_pages) {
                paginationContainer.append(`<span>...</span>`);
                paginationContainer.append(`<a href="#" class="page-numbers" data-page="${total_pages}">${total_pages}</a>`);
            }
    
            // Thêm liên kết "Next"
            if (current_page < total_pages) {
                paginationContainer.append(`<a href="#" class="page-numbers" data-page="${current_page + 1}"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>`);
            }
    
            // Thiết lập sự kiện click cho các liên kết phân trang
            $('.page-numbers').on('click', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page) {
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('page', page);
                    const link = `/shop?${urlParams.toString()}`;
                    history.pushState(null, '', link);
                    PageProduct.products.getDefaultProducts(page);
                }
            });
        }
    },
    

    criteria : {
        /* Basic Filter / Category=Tag*/ 
        getByCategory: function (value) {   
        },
        getByBrand: function (value) {   
        },
        getByGender: function (value) {
        },
        getByVolume: function (value) {
        },
        getByPrice: function (value) {
        },
        /* Advanced Filter */
        getByCountry: function (value) {
        },
        getByAge: function (value) {
        },
        getByConcentration : function (value) {
            //Nồng độ
        },
        getByStyle : function (value) {
        },
        getByFragGroup: function (value) {
            //Nhóm hương
        },
        getByFragTime: function (value) {
            //Thời gian lưu hương
        },
        getByFragDistance: function (value) {
            //Độ tỏa hương
        },



    },

    Cart: {
        init: function () {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            this.cartCount = cart.length;
            $('#cart-count').text(this.cartCount);
            $('#cart-count-2').text(this.cartCount);
    
            $(document).on('click', '.single_add_to_cart_button', (event) => {
                event.preventDefault();
                const button = $(event.target);
                const productCard = button.closest('.product-item');
                const productId = productCard.data('id');
                const productSizeId = productCard.data('id-size');
    
                this.updateCart(productId, productSizeId,productSizeId);
                alert('Product added to cart!');
            });
        },
        updateCart: function (productId, productImage, productPrice) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
            let existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                const product = {
                    id: productId,
                    image: productImage,
                    price: productPrice,
                    quantity: 1
                };
                cart.push(product);
                this.cartCount++;
            }
    
            $('#cart-count').text(this.cartCount);
            $('#cart-count-2').text(this.cartCount);
            localStorage.setItem('cart', JSON.stringify(cart));
        }
    }, 



    sortFunction : {
        sort: function (value) {
        },
        generateLink: function (value) {
        }
    },
}



//Sử dụng promise
PageProduct.default.setDefault().then(() => {
    
});

PageProduct.products.getDefaultProducts(1, 9, 'price', 'asc');



//return axios.get('/products?category=' + category + '&_limit=10&_sort=price&_order=asc')