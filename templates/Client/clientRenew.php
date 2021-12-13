<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mới mật khẩu</title>
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
            font-size: 14px;
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
            height: 400px;
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
            <h3 class="text-uppercase">Thay đổi mật khẩu</h3>
            <div style="height: 2px; width:100px;background:purple">

            </div>
        </center>
        <div class="row mt-5">
            <div class="col-md-5 mx-auto position-relative">
                <div class="card p-4" style="border-top: 50px solid purple; ">
                    <div id="result" style="height: 50px;"></div>
                    <form action="" class="mt-3">
                        <div class="form-group position-relative">
                            <input type="password" id="newPass" class="form-control" placeholder="Mật khẩu mới" />
                            <span id="iconpassword" class="fa fa-eye float-right position-absolute" style="top: 19px; right:10px"></span>
                        </div>
                        <div class="form-group position-relative">
                            <input type="password" id="rePass" class="form-control" placeholder="Nhập lại mật khẩu" />
                            <span id="iconpassword1" class="fa fa-eye float-right position-absolute" style="top: 19px; right:10px"></span>
                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-primary btnChange">Đổi mật khẩu</button>
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
    let geturl = window.location.href
    let url = new URL(geturl)
    let token = url.searchParams.get('token')

    function validatePassword(password) {
        const reg = /^[0-9]{8}$/;
        return reg.test(password);
    }
    $('.btnChange').click((e) => {
        e.preventDefault()
        let newPass = $('#newPass').val().trim()
        let rePass = $('#rePass').val().trim()

        if (validatePassword(newPass) == false) {
            $('.btnChange').attr('disabled', 'disabled')
            $('.btnChange').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mật khẩu mới phải đủ 8 chữ số</strong></div>')
                $('.btnChange').removeAttr('disabled')
                $('.btnChange').html('Đổi mật khẩu')
            }, 1000);
        } else if (validatePassword(rePass) == false) {
            $('.btnChange').attr('disabled', 'disabled')
            $('.btnChange').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mật khẩu nhập lại phải đủ 8 chữ số</strong></div>')
                $('.btnChange').removeAttr('disabled')
                $('.btnChange').html('Đổi mật khẩu')
            }, 1000);
        }
        else if (newPass != rePass) {
            $('.btnChange').attr('disabled', 'disabled')
            $('.btnChange').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mật khẩu mới và nhập lại phải giống nhau</strong></div>')
                $('.btnChange').removeAttr('disabled')
                $('.btnChange').html('Đổi mật khẩu')
            }, 1000);
        }
        else {
            $.ajax({
                url: '/client/requestajaxrenewpass',
                type: 'POST',
                data: {
                    token,
                    newPass
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btnChange').attr('disabled', 'disabled')
                        $('.btnChange').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html(`<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Đổi mật khẩu thành công.Chuyển hướng sau 3s</strong></div>`)
                            $('.btnChange').html('Chuyển hướng')
                            setTimeout(() => {
                                window.location.href = '/'
                            }, 3000);
                        }, 1000);
                    } else {
                        $('.btnChange').attr('disabled', 'disabled')
                        $('.btnChange').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                            $('.btnChange').removeAttr('disabled')
                            $('.btnChange').html('Đổi mật khẩu')
                        }, 1000);
                    }

                }
            })
        }

    })
    $('#iconpassword').click((e) => {
        if ($('#newPass').attr('type') == 'password') {
            $('#newPass').attr('type', 'text')
            $('#iconpassword').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#newPass').attr('type', 'password')
            $('#iconpassword').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })
    $('#iconpassword1').click((e) => {
        if ($('#rePass').attr('type') == 'password') {
            $('#rePass').attr('type', 'text')
            $('#iconpassword1').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#rePass').attr('type', 'password')
            $('#iconpassword1').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })
</script>