<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        #banking-note {
            background-color: #e7f3fe;
            color: #31708f;
            padding: 15px;
            border: 1px solid #bce8f1;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .banking-details {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1; /* Allows this column to grow */
        }

        .banking-details p {
            margin: 15px 0;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: #f1f1f1;
            border-radius: 5px;
        }

        .copy-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .copy-button:hover {
            background-color: #0056b3;
        }

        .spinner-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100px;
        }

        .qr-container {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px; /* Rounded corners */
            overflow: hidden; /* Ensures child elements are clipped to rounded corners */
            background-color: #fff; /* Optional background color */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow effect */
            height: 100%; /* Ensures it matches the height of the banking details */
        }

        .qr-container img {
            width: 100%; /* Ensures the image covers the container */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <!-- http://127.0.0.1:5500/payment.html?content=0866888222OD56782&amount=500000 -->
    <div class="container">
        <div id="banking-note" style="text-align: center;">Quý khách vui lòng quét mã QR hoặc Chuyển khoản theo nội dung</div>
        <div class="row">
            <div class="col-md-6 d-flex mb-3">
                <div class="qr-container">
                    <img src="https://img.vietqr.io/image/MB-9870102038888-print.png" alt="QR Code">
                </div>
                
            </div>
            <div class="col-md-6 d-flex mb-3">
                <div class="banking-details">
                    <p>
                        <i class="fa fa-comment" aria-hidden="true"></i> <b><span class="content" id="content"></span></b>
                        <button class="copy-button" onclick="copyToClipboard(document.getElementById('content').innerText)"><i class="fa fa-clipboard" aria-hidden="true"></i></button>
                    </p>
                    <p>
                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i> <b>9870102038888</b>
                        <button class="copy-button" onclick="copyToClipboard('9870102038888')"><i class="fa fa-clipboard" aria-hidden="true"></i></button>
                    </p>
                    <p>
                        <i class="fa fa-money" aria-hidden="true"></i> <b><span id="amount">{{$order_value}}</span> VND</b>
                        <button class="copy-button" onclick="copyToClipboard('{{$order_value}}')"><i class="fa fa-clipboard" aria-hidden="true"></i></button>
                    </p>
                    <p>
                        <i class="fa fa-university" aria-hidden="true"></i> <b>TMCP Quân đội</b>
                    </p>
                    
                    <p>
                        <i class="fa fa-user" aria-hidden="true"></i> <b>NGUYEN CONG QUYEN</b>
                    </p>
                    <div id="payment-status">
                        <div class="spinner-container text-warning">
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                            <b class="mt-2">CHỜ THANH TOÁN</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatprice(price) {
            return price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Đã sao chép: ' + text);
            }).catch(err => {
                console.error('Error copying text: ', err);
            });
        }

        var url = new URL(window.location.href);
        var content = url.searchParams.get("order_code");
        document.querySelector('.content').innerText = content;

        var amount = document.querySelector('#amount').innerText;
        
         //var amount = url.searchParams.get("amount");
        //document.querySelector('#amount').innerText = formatprice(amount);

        var img = document.querySelector('img');
        img.src = `https://img.vietqr.io/image/MB-9870102038888-compact.png?&addInfo=${content}&amount=${amount}`;

        function checkPaymentStatus(content) {
        // Gửi request đến API mỗi 5 giây
            setInterval(() => {
                console.log('Checking payment status...');
                fetch(`/payment/check?order_code=${encodeURIComponent(content)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'successful') {
                        document.querySelector('#payment-status').innerHTML = `
                            <div class="spinner-container text-success">
                                <i class="fa fa-check-circle fa-3x fa-fw" aria-hidden="true"></i>
                                <b class="mt-2">ĐÃ THANH TOÁN</b>
                                <div id="countdown">Tự động chuyển hướng sau <span id="timer">3</span> giây...</div>
                            </div>
                        `;
                        clearInterval(this); // Dừng lại sau khi đã thanh toán

                        let countdown = 3;
                        const timerElement = document.getElementById('timer');

                        // Đếm ngược
                        const interval = setInterval(() => {
                            countdown--;
                            timerElement.innerText = countdown; // Cập nhật timer
                            if (countdown <= 0) {
                                clearInterval(interval); // Dừng đếm ngược

                                var order_code = url.searchParams.get("order_code");
                                localStorage.removeItem('cart');
                                window.location.href = '/order-success?id=' + order_code;
                            }
                        }, 1000); // Cập nhật mỗi giây


                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }, 5000); // Gửi yêu cầu mỗi 5000 ms (5 giây)
        }

        checkPaymentStatus(content);


    </script>
</body>
</html>
