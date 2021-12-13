<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
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
            height: 350px;
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
            <h3 class="text-uppercase">quên mật khẩu</h3>
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
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-primary btnForget">Lấy lại mật khẩu</button>
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

    $('.btnForget').click((e) => {
        e.preventDefault()
        let email = $('#email').val().trim()

        if (validateEmail(email) == false) {
            $('.btnForget').attr('disabled', 'disabled')
            $('.btnForget').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Email không hợp lệ</strong></div>')
                $('.btnForget').removeAttr('disabled')
                $('.btnForget').html('Lấy lại mật khẩu')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajaxforget',
                type: 'POST',
                data: {
                    email
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btnForget').attr('disabled', 'disabled')
                        $('.btnForget').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html(`<div class="alert alert-warning alert-dismissible fade show">
                                          <strong>Vui lòng kiểm tra email và làm theo để đổi mật khẩu mới </strong></div>`)
                            $('.btnForget').html('Chuyển hướng')
                            setTimeout(() => {
                                window.location.href = '/'
                            }, 3000);
                        }, 1000);
                    } else {
                        $('.btnForget').attr('disabled', 'disabled')
                        $('.btnForget').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                            $('.btnForget').removeAttr('disabled')
                            $('.btnForget').html('Lấy lại mật khẩu')
                        }, 1000);
                    }
                }
            })
        }

    })
</script>