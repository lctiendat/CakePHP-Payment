<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
    <style>
        label {
            font-size: 13px;
            text-indent: 20px;
            line-height: 40px;
        }

        input {
            height: 50px !important;
        }

        button {
            height: 50px !important;
            width: 60% !important;
        }

        .alert strong {
            font-size: 13px;
        }

        /* .alert {
            background:violet !important;
        } */

        .otp,
        .fullname,
        .password,
        .check,
        .btnOtp,
        .btnFinish {
            display: none;
        }

        .btn {
            background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;
            width: 200px !important;
        }

        .card {
            height: 550px;
        }

        .form-control {
            border: 2px solid #8E13DD !important;
        }

        input,
        ::placeholder {
            color: #2C0790 !important;
            font-size: 13px;
        }

        .row:first-child {
            margin-top: 100px;
        }

        textarea:focus,
        textarea.form-control:focus,
        input.form-control:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=number]:focus,
        [type=text].form-control:focus,
        [type=password].form-control:focus,
        [type=email].form-control:focus,
        [type=tel].form-control:focus,
        [contenteditable].form-control:focus {
            box-shadow: inset 0 -1px 0 #ddd;
        }

        .title {
            color: #8E13DD;
            text-transform: uppercase;
        }

        #step {
            display: flex;
            text-align: center;
            margin-top: 20px;
        }

        .line-step {
            width: 100px;
            border-bottom: 1px solid #ccc;
            font-size: 13px;
            margin: 0 5px;

        }

        #step2,
        #step3,
        #step4 {
            border: 1px solid #2C0790;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: #2C0790;
            font-size: 14px;
        }

        #step1 {
            background: #2C0790;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: white;
            font-size: 14px;
        }

        #result {
            margin-top: 20px;
        }

        body {
            background: #eee;
        }

        [type="checkbox"] {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="margin-top: 50px;">
        <center>
            <h3 class="text-uppercase">tạo tài khoản</h3>
            <div style="height: 2px; width:100px;background:purple">

            </div>
        </center>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mt-3 p-4" style="border-top: 50px solid purple; ">
                    <center>
                        <div id="step" class="mx-auto">
                            <div id="step1">
                                1
                            </div>
                            <div class="line-step">
                                Điền email
                            </div>
                            <div id="step2">
                                2
                            </div>
                            <div class="line-step">
                                Điền OTP
                            </div>
                            <div id="step3">
                                3
                            </div>
                            <div class="line-step">
                                Tạo mật khẩu
                            </div>
                            <div id="step4">
                                4
                            </div>
                            <div class="line-step">
                                Hoàn thành
                            </div>
                        </div>
                    </center>

                    <div id="result" style="height: 50px;"></div>
                    <form action="" class="mt-3">
                        <div class="form-group email">
                            <input type="text" id="email" class="form-control" placeholder="Email của bạn " />
                        </div>
                        <div class="form-group otp">
                            <input type="text" id="otp" class="form-control" maxlength="10" placeholder="Mã OTP gồm 10 ký tự" />
                        </div>
                        <div class="form-group fullname">
                            <input type="text" id="fullname" class="form-control" placeholder="Tên của bạn ví dụ : LE CONG TIEN DAT" />
                        </div>
                        <div class="form-group password position-relative">
                            <input type="password" id="password" class="form-control " max="8" min="7" placeholder="Mật khẩu của bạn" />
                            <span id="iconpassword" class="fa fa-eye float-right position-absolute" style="top: 17px; right:10px"></span>
                        </div>
                        <div class="form-group check">
                            <label style="word-wrap:break-word">
                                <input type="checkbox" class="mr-2" checked /> Tôi đồng ý chính sách và điều khoản sử dụng của hệ thống
                            </label>
                        </div>
                        <a href="/client/login" style="font-size: 13px;color:purple">Bạn đã có tài khoản ? Đăng nhập ngay</a>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-primary mb-5 btnEmail">Tiếp tục</button>
                            <button class="btn btn-primary mb-5 btnOtp">Tiếp</button>
                            <button class="btn btn-primary mb-5 btnFinish">Hoàn thành</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(() => {
        function validateEmail(email) {
            const reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return reg.test(email);
        }

        function validatePassword(password) {
            const reg = /^[0-9]{8}$/;
            return reg.test(password);
        }
        $('.btnEmail').click((e) => {
            e.preventDefault()
            const email = $('#email').val();
            if (email == '') {
                $('button').attr('disabled', 'disabled')
                $('button').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Email không được để trống</strong></div>')
                    $('button').removeAttr('disabled')
                    $('button').html('Tiếp tục')
                }, 1000);

            } else if (validateEmail(email) == false) {
                $('button').attr('disabled', 'disabled')
                $('button').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Email không đúng định dạng</strong></div>')
                    $('button').removeAttr('disabled')
                    $('button').html('Tiếp')
                }, 1000);
            } else {
                $.ajax({
                    url: '/client/requestajaxregister',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        email
                    },
                    success(response) {
                        if (response == true) {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Email đã tồn tại trong hệ thống</strong></div>')
                                $('button').removeAttr('disabled')
                                $('button').html('Tiếp')
                            }, 1000);

                        } else {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('.email,[for="email"]').hide();
                                $('.otp,[for="otp"]').show();
                                $('.btnEmail').hide()
                                $('.btnOtp').show()
                                $('#step2').css({
                                    'background': '#2C0790',
                                    'border': '',
                                    'color': 'white'
                                })
                                $('#result').html('<div class="alert alert-warning alert-dismissible fade show">\
                                          <strong>Vui lòng nhập OTP đã được gửi ở email</strong></div>')
                                $('button').removeAttr('disabled')
                                $('button').html('Tiếp')
                                //countDown()
                            }, 1000);
                        }
                    },
                    error(error) {}
                })
            }

        })
        $('.btnOtp').click((e) => {
            e.preventDefault()
            const otp = $('#otp').val();
            if (otp == '') {
                $('button').attr('disabled', 'disabled')
                $('button').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>OTP không được để trống</strong></div>')
                    $('button').removeAttr('disabled')
                    $('button').html('Tiếp')
                }, 1000);

            } else {
                $.ajax({
                    url: '/client/requestajaxregister',
                    type: 'post',
                    data: {
                        otp
                    },
                    dataType: 'json',
                    success(response) {
                        if (response == true) {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('.otp').hide();
                                $('.password').show();
                                $('.btnOtp').hide()
                                $('.btnFinish').show()
                                $('.check').show()
                                $('.fullname').show()
                                $('#step3').css({
                                    'background': '#2C0790',
                                    'border': '',
                                    'color': 'white'
                                })
                                $('#result').html('<div class="alert alert-warning alert-dismissible fade show">\
                                          <strong>Mật khẩu bao gồm 8 chữ số</strong></div>')
                                $('button').removeAttr('disabled')
                                $('button').html('Hoàn thành')
                            }, 1000);

                        } else {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> OTP không chính xác </strong></div>')
                                $('button').removeAttr('disabled')
                                $('button').html('Tiếp')

                            }, 1000);
                        }
                    },
                    error(response) {}
                })
            }
        })

        function validateName(holder) {
            let reg = /^[A-Z a-z \s]{1,}$/;
            return reg.test(holder)
        }
        $('.btnFinish').click((e) => {
            e.preventDefault()
            const password = $('#password').val().trim();
            const fullname = $('#fullname').val().trim()
            if (validateName(fullname) == false) {
                $('button').attr('disabled', 'disabled')
                $('button').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tên không hợp lệ</strong></div>')
                    $('button').removeAttr('disabled')
                    $('button').html('Hoàn thành')
                }, 1000);
            } else if (validatePassword(password) == false) {
                $('button').attr('disabled', 'disabled')
                $('button').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Mật khẩu phải đủ 8 chữ số</strong></div>')
                    $('button').removeAttr('disabled')
                    $('button').html('Hoàn thành')
                }, 1000);
            } else if ($('input[type="checkbox"]:checked').length == 0) {
                $('button').attr('disabled', 'disabled')
                $('button').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng xác nhận đồng ý chính sách và điều khoản</strong></div>')
                    $('button').removeAttr('disabled')
                    $('button').html('Hoàn thành')
                }, 1000);
            } else {
                $.ajax({
                    url: '/client/requestajaxregister',
                    type: 'post',
                    data: {
                        password,
                        fullname
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == 'success') {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            $('#password input').attr('readonly', true)
                            $('#step4').css({
                                'background': '#2C0790',
                                'border': '',
                                'color': 'white'
                            })
                            setTimeout(() => {
                                $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>' + response.message + '</strong></div>')
                                $('button').html('Hoàn thành')
                                setTimeout(() => {
                                    window.location.href = '/client/login'
                                }, 3000);
                            }, 1000);

                        }
                    },
                    error(response) {}
                })
            }
        })

        function countDown() {
            let s = 5;
            let countDown = setInterval(() => {
                $('.btnOtp').html('Tiếp (' + s + ' giây)')
                s--
                if (s < 0) {
                    clearInterval(countDown);
                    $('.btnOtp').html('Gửi lại OTP')
                }
            }, 1000)
        }
        $('#iconpassword').click((e) => {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text')
                $('#iconpassword').attr('class', 'fa fa-eye-slash float-right position-absolute')
            } else {
                $('#password').attr('type', 'password')
                $('#iconpassword').attr('class', 'fa fa-eye float-right position-absolute')
            }
        })
    })
</script>

</html>