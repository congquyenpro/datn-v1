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
            var commentStatus = $('input[name="comment_status"]:checked').val();  // Trạng thái bình luận
            var image = $('#post-image').attr('src');  // Hình ảnh (src của thẻ <img>)

            //check fields are empty
            if (title == '' || summary == '' || content == '' || tags == '' || image == '') {
                alert('Vui lòng điền đầy đủ thông tin');
                return;
            }
        
            // Tạo một object chứa các dữ liệu cần gửi lên
            var formData = {
                title: title,
                summary: summary,
                content: content,
                status: status,
                tags: tags,
                comment_status: commentStatus,
                /* image: image */
            };
        
            // In ra dữ liệu đã lấy từ form
            console.log("Dữ liệu gửi lên server: ", formData);
            
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
        
    }

}




Post.show(1); // showing post with id: 1
Post.addPost(); // Add new post

Post.submit();

Post.keywordSearch(); // Search trending keyword