Post = {
    show: function(id) {
        console.log("showing post with id: " + id);
    },
    addPost: function() {
        
        //Bật tắt form đăng bài
        
        //$('#main-template').hide()
        $('#post-template').hide()
        $('#create-post').on('click', function() {       
            
            $('#post-template').show();
            $('#main-template').hide();
        });

         //Hủy bỏ form đăng bài
        $('#btn-cancel').on('click', function() {
            $('#main-template').show();
            $('#post-template').hide();
        });

        //Nút xem hướng dẫn đăng bài: Hướng dẫn được update từ server chính
        $('#post-guild').hide();
        $('#view-post-guild').on('click', function() {
            $('#post-guild').toggle();
            if ($('#post-guild').is(':visible')) {
                this.innerHTML = 'Ẩn hướng dẫn';
            } else {
                this.innerHTML = 'Xem hướng dẫn';
            }
        });

    },
    update: function(id) {
        console.log("updating post with id: " + id);
    },
    submit: function() {
        $('#btn-save').on('click', function() {
        // Lấy dữ liệu từ các trường trong form
        var title = $('#post-title').val();  // Tiêu đề
        var summary = $('#post-summary').val();  // Tóm tắt
        var content = $('textarea[name="content"]').val();  // Nội dung (editor)
        var status = $('#post-status').val();  // Trạng thái
        var tags = $('#post-tags').val();  // Từ khóa
        // Nếu tags là chuỗi, bạn sẽ tách nó thành mảng (nếu người dùng nhập thủ công vào một input)
        console.log(typeof tags);  // Kiểm tra kiểu dữ liệu của tags
        //chuyển tags thành mảng từ khóa
        //tags = tags.split(',');  // Chuyển chuỗi thành mảng từ khóa
        var commentStatus = $('input[name="comment_status"]:checked').val();  // Trạng thái bình luận
        var imageFile = $('#customFile')[0].files[0];  // Lấy file ảnh từ input file
        if (imageFile && imageFile.size > 5 * 1024 * 1024) {
            alert("Ảnh quá lớn, vui lòng chọn ảnh có kích thước nhỏ hơn 5MB.");
            return;
        }
        // Kiểm tra các trường có rỗng không
        if (title == '' || summary == '' || content == '' || tags == '' || !imageFile) {
            alert('Vui lòng điền đầy đủ thông tin');
            return;
        }

        // Tạo một FormData object để gửi cả file và các trường dữ liệu khác
        var formData = new FormData();
        formData.append('title', title);
        formData.append('summary', summary);
        formData.append('content', content);
        formData.append('status', status);
        formData.append('tags', tags);
        formData.append('comment_status', commentStatus);
        formData.append('image', imageFile);  // Thêm file ảnh vào FormData
    
        // In ra dữ liệu đã lấy từ form
        console.log("Dữ liệu gửi lên server: ", formData);
        //in chi tiết dữ liệu gửi lên
        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
            
            //Nếu cần, bạn có thể gửi dữ liệu lên server bằng AJAX
            Api.Blog.store(formData).done(function(res) {
                if (res.status == 201) {
                    // Hiển thị thông báo đăng bài thành công
                    $('#staus-notice').html(`
                        <div class="alert alert-primary alert-dismissible fade show">
                            Đăng bài thành công!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                
                    setTimeout(function() {
                        $('#staus-notice').html('');
                        location.reload();
                    }, 3000); // delay 3s
                }
                else{
                    $('#staus-notice').html(`
                    <div class="alert alert-danger alert-dismissible fade show">
                        Có lỗi xảy ra: ${res.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    `)
                }

                //Gọi lại show để cập nhật
                Post.show(1);

            });
        });
    },
    keywordSearch: () => {
        
        $('#trending-search').on('click', function() {
            var keyword = $('#trending-keyword').val();
            
            //console.log('Keyword:', keyword);  // In ra giá trị keyword

            //Chuyển đến trang search với keyword, target='_blank' để mở tab mới
            window.open('https://trends.google.com/trends/explore?geo=VN&q=' + keyword, '_blank');
        });
        
    },
    uploadImage: function() {
        $('#customFile').on('change', function(event) {
            // Lấy file được chọn từ input
            var file = event.target.files[0];
            
            // Kiểm tra xem file có hợp lệ không (kiểu ảnh)
            if (file && file.type.startsWith('image/')) {
                // Tạo URL đối tượng cho file hình ảnh
                var reader = new FileReader();
                
                // Khi file đã được đọc xong, hiển thị hình ảnh
                reader.onload = function(e) {
                    // Cập nhật nguồn hình ảnh cho thẻ img
                    $('#post-image').attr('src', e.target.result);
                };
                
                // Đọc file dưới dạng URL
                reader.readAsDataURL(file);
                
                // Cập nhật label của input file
                var fileName = file.name;
                $('.custom-file-label').text(fileName);
            } else {
                alert('Vui lòng chọn một tệp hình ảnh');
            }
        });
    },
    delete: function() {
        $('.btn-delete-post').on('click', function() {
            console.log("deleting post with id: ", $(this).data('post-id'));
            id = $(this).data('post-id');
            title = $(this).data('title');
            $('.modal-body').html(`Xác nhận xóa bài viết: `+ title + `?`);
            $('.submit-delete-post').on('click', function() {
                Api.Blog.delete(id).done(function(res) {
                    // Kiểm tra status trong response
                    if (res.status === 'success') {
                        // Nếu xóa thành công, thực hiện hành động khác
                        //ẩn modal
                        $('#deleteModal').modal('hide');
                        // reload lại trang
                        location.reload();
                        //alert(res.message); // Ví dụ: thông báo thành công
                    } else {
                        // Nếu có lỗi, thực hiện xử lý lỗi
                        alert(res.message);  // Hiển thị thông báo lỗi
                        console.error(res.message);  // Hiển thị thông báo lỗi
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Nếu không thể kết nối API hoặc có lỗi mạng, xử lý ở đây
                    alert('Có lỗi xảy ra, vui lòng thử lại sau');
                    console.error('Request failed: ' + textStatus, errorThrown);
                });     
            });
        });
    }

}




Post.show(1); // showing post with id: 1
Post.addPost(); // Add new post

Post.submit();

Post.keywordSearch(); // Search trending keyword

Post.uploadImage(); // Upload image

Post.delete(); // Delete post