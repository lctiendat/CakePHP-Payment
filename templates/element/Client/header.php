<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VioPay - Website Thanh Toán Điện Tử</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background: GhostWhite;
        }

        textarea:focus,
        textarea.form-control:focus,
        input.form-control:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=number]:focus,
        button,
        [type=text].form-control:focus,
        [type=password].form-control:focus,
        [type=email].form-control:focus,
        [type=tel].form-control:focus,
        [contenteditable].form-control:focus {
            /* box-shadow: inset 0 -1px 0 #ddd; */
            outline: none;
            box-shadow: none;
        }

        button[type="button"]:focus {
            outline: none;
            box-shadow: none;
        }

        .btn {
            background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;
            width: 200px !important;
            font-size: 13px;
            height: 50px;
            border: 0;
        }

        nav {
            background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;

        }

        nav ul li {
            padding-right: 30px;
        }

        nav ul li a {
            color: white !important;
        }

        .alert {
            font-size: 14px;
            font-weight: normal !important;
        }

        .footer li {
            font-style: normal !important;
            font-size: 14px;
            list-style-type: none;

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark p-4">
        <a class="navbar-brand" href="/"><img src="https://i0.wp.com/s1.uphinh.org/2021/12/10/Screen-Shot-2021-12-10-at-16.04.25.png" width="20%" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end d-flex" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Trang chủ <i class="bi bi-house"></i> </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Thông báo <i class="bi bi-bell"></i> <span id="countnoti" style="font-size: 11px;"><?= count($noti) ?></span>
                    </a>
                    <div class="dropdown-menu p-3 mt-4" style="width:300px;height:200px;overflow-y:scroll;">
                        <?php if (count($noti) == 0) { ?>
                            <span style="font-size:13px"> Hiện tại bạn chưa có thông báo </span>
                        <?php } else { ?>
                            <span class="mb-2 readall" style="font-size: 13px;"> <u> Đánh dấu đã đọc tất cả <i class="bi bi-check"></i></u></span>
                            <?php foreach ($noti as $item) { ?>
                                <div style="border-bottom:1px solid #ccc">
                                    <span style="font-size: 12px;"><?= $item->thread ?></span> <br>
                                    <span style="font-size: 11px;color:gray;"><?= $item->created ?></span>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/transactionhistory">Lịch sử giao dịch <i class="fa fa-history"></i> </a>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        $('.readall').click((e) => {
            e.preventDefault()
            $.ajax({
                url: '/client/requestajaxreadallnoti',
                type: 'POST',
                data: {

                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.dropdown-menu').html(`<span style="font-size:13px"> Hiện tại bạn chưa có thông báo </span>`)
                        $('#countnoti').html('0')
                    }
                }
            })
        })
        $(".dropdown-menu").click((e) => {
            e.stopPropagation();
        })
    </script>