const Customer = {
    template: {
        show: () => {
            Customer.template.getList('system');
            $('#customer-type-select').on('change', function() {
                const customer_type = $(this).val();
                $('#customer-list').DataTable().destroy();
                Customer.template.getList(customer_type);
            });
        },
        getList : (customer_type) => {
            Api.Customer.getAll(customer_type).done((res) => {
                console.log(res);
                const data = res.map ((item) => {
                    if (customer_type === 'other') {
                        item.action = `
                        <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                            <i class="anticon anticon-lock"></i>
                        </button>
                        `;
                    }else{
                        item.action = `
                        <button class="btn btn-icon btn-hover btn-sm btn-rounded btn-view-user" data-user-id=${item.customer_id} data-toggle="modal" data-target=".bd-example-modal-xl">
                            <i class="anticon anticon-eye"></i>
                        </button>
                        <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                            <i class="anticon anticon-lock"></i>
                        </button>
                        `;
                    }

                    let status = [
                        `<div class="d-flex align-items-center">
                            <div class="badge badge-danger badge-dot m-r-10"></div>
                            <div>Vô hiệu hóa</div>
                        </div>`,
                        `<div class="d-flex align-items-center">
                            <div class="badge badge-success badge-dot m-r-10"></div>
                            <div>Hoạt động</div>
                        </div>`,
                    ];
                    return {
                        id: item.customer_id,
                        name: item.name,
                        tong_chi_tieu: item.tong_chi_tieu,
                        status: status[item.status],
                        action: item.action
                    };
                });
                $('#customer-list').DataTable({
                    data: data,
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'tong_chi_tieu' },
                        { data: 'status' },
                        { data: 'action' }
                    ],
                    autoWidth: false ,
                    responsive: true
                });
            });
        },
    },
    user: {
        view : () => {
            $(document).on('click', '.btn-view-user', function() {
                let user_id = $(this).data('user-id');
                let status = [
                    'Chờ xử lý',
                    'Đã xác nhận',
                    'Đã hoàn thiện',
                    'Chờ lấy hàng',
                    'Đang giao hàng',
                    'Đã giao hàng',
                    'Đã hủy',
                    'Đã trả hàng',
                ]
                let status_account = [
                    'Vô hiệu hóa',
                    'Hoạt động',
                ]
                Api.Customer.viewDetail(user_id).done((res) => {
                    console.log(res);
                    data = '';
                    res.forEach((item) => {
                        data += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.shipping_code == null ? '' : item.shipping_code}</td>
                            <td>${item.name}</td>
                            <td>${item.phone}</td>
                            <td>${item.address ? JSON.parse(item.address).address : ''}</td>
                            <td>${item.order_date}</td>
                            <td>${status[item.status]}</td>
                            <td>${item.value}</td>
                        </tr>
                        `
                    });
                    $('.data-list-2').html(data);
                });

                Api.Customer.viewInfor(user_id).done((res) => {
                    console.log(res);
                    $('.data-list').html(`
                    <tr>
                        <td>${res[0].customer_id}</td>
                        <td>${res[0].name}</td>
                        <td>${res[0].email}</td>
                        <td>${status_account[res[0].status]}</td>
                        <td>${res[0].tong_chi_tieu}</td>
                    </tr>
                    `);
                });

                //Thêm data-user-id vào button save
                $('.save-user-status').attr('data-user-id', user_id);
            });

        },
        setStatus : () => {
            $(document).on('click', '.save-user-status', function() {
                let user_id = $(this).data('user-id');
                let status = $('#status-select').val();
                Api.Customer.setStatus(user_id, status).done((res) => {
                    console.log(res);
                    alert('Cập nhật trạng thái thành công');
                    //reload lại trang
                    location.reload();
                });
            });
        }
    }
};

Customer.template.show();
Customer.user.view();
Customer.user.setStatus();