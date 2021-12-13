<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
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

        .otp,
        .btnOtp,
        .btnFinish {
            display: none;
        }

        body {
            background: #eee;
        }

        .btn {
            background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;
            width: 200px !important;
        }

        .card {
            height: 500px;
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
    </style>
</head>

<body>
    <div class="container-fluid" style="margin-top: 50px;">
        <center>
            <h3 class="text-uppercase">đăng nhập hệ thống</h3>
            <div style="height: 2px; width:100px;background:purple">

            </div>
        </center>
        <div class="row mt-5">
            <div class="col-md-5 mx-auto position-relative">
                <div class="card p-4" style="border-top: 50px solid purple; ">
                    <div id="result" style="height: 50px;"></div>
                    <form action="" class="mt-3">
                        <div class="form-group email">
                            <input type="text" id="email" class="form-control" placeholder="Email của bạn" />
                        </div>
                        <div class="form-group otp">
                            <input type="text" id="otp" class="form-control" maxlength="10" placeholder="Mã OTP gồm 10 ký tự" />
                        </div>
                        <div class="form-group password mt-2 position-relative">
                            <input type="password" id="password" class="form-control" max="8" min="7" placeholder="Mật khẩu của bạn" />
                            <span id="iconpassword" class="fa fa-eye float-right position-absolute" style="top: 17px; right:10px"></span>
                        </div>
                        <a href="/client/register" style="font-size: 13px;color:purple">Bạn chưa có tài khoản ? Đăng ký ngay</a> <br>
                        <a href="/client/forget" style="font-size: 13px;color:purple">Quên mật khẩu</a>
                        <div class="form-group text-center mt-5 fixed-bottom position-absolute">
                            <button class="btn btn-primary mb-5 btnStart">Đăng nhập</button>
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
    function validateEmail(email) {
        const reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return reg.test(email);
    }

    function validatePassword(password) {
        const reg = /^[0-9]{8}$/;
        return reg.test(password);
    }
    $('.btnStart').click((e) => {
        e.preventDefault()
        const email = $('#email').val()
        const password = $('#password').val()
        if (email == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Email không được để trống</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Đăng nhập')
            }, 1000);

        } else if (password == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mật khẩu không được để trống</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Đăng nhập')
            }, 1000);
        } else if (validateEmail(email) == false) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Email không đúng định dạng</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Đăng nhập')
            }, 1000);
        } else if (validatePassword(password) == false) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Mật khẩu phải đủ 8 chữ số </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Đăng nhập')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajaxlogin',
                type: 'post',
                data: {
                    email,
                    password
                },
                dataType: 'json',
                success(response) {
                    console.log(response)
                    if (response == true) {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        $('#password input').attr('readonly', true)
                        setTimeout(() => {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Đăng nhập thành công. Chuyển hướng sau 3 giây</strong></div>')
                            setTimeout(() => {
                                window.location.href = '/'
                            }, 3000);
                            $('button').html('Chuyển hướng')
                        }, 1000);
                    } else {
                        if (response.status == 'strange_ip') {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('.email').hide()
                                $('.password').hide()
                                $('.otp').show()
                                $('.btnStart').hide()
                                $('.btnOtp').show()
                                $('#result').html(`<div class="alert alert-warning alert-dismissible fade show">
                                                        <strong>  ${response.message} </strong></div>`)
                                $('button').removeAttr('disabled')
                                $('button').html('Đăng nhập')
                            }, 1000);
                        } else {
                            $('button').attr('disabled', 'disabled')
                            $('button').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('#result').html(`<div class="alert alert-danger alert-dismissible fade show">
                                                        <strong>  ${response.message} </strong></div>`)
                                $('button').removeAttr('disabled')
                                $('button').html('Đăng nhập')
                            }, 1000);

                        }
                    }
                },
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
                                          <strong>OTP không được để trống </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Đăng nhập')
            }, 1000);

        } else {
            $.ajax({
                url: '/client/requestajaxlogin',
                type: 'post',
                data: {
                    otp
                },
                dataType: 'json',
                success(response) {
                    if (response == true) {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        $('#otp').attr('readonly', true)
                        setTimeout(() => {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Đăng nhập thành công. Chuyển hướng sau 3 giây</strong></div>')
                            setTimeout(() => {
                                window.location.href = '/'
                            }, 3000);
                            $('button').html('Chuyển hướng')
                        }, 1000);
                    } else {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> OTP không chính xác </strong></div>')
                            $('button').removeAttr('disabled')
                            $('button').html('Đăng nhập')
                        }, 1000);
                    }
                },
            })
        }
    })
    $('#iconpassword').click((e) => {
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text')
            $('#iconpassword').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#password').attr('type', 'password')
            $('#iconpassword').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })
</script>