<?= $this->element('Client/header') ?>

<style>
    label {
        font-size: 13px;
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

    .btn {
        background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;
        width: 200px !important;
    }

    .card:nth-child(2) {
        display: none;
    }

    .form-control {
        border: 2px solid #8E13DD !important;
    }

    input,
    textarea,
    ::placeholder {
        color: #2C0790 !important;
        font-size: 13px;
    }

    .row:first-child {
        margin-top: 100px;
    }


    .title {
        color: #8E13DD;
        text-transform: uppercase;
    }

    .bill p {
        color: #8E13DD;
        font-weight: bold;
    }

    .bill {
        height: 600px;
    }

    .otptransfer {
        display: none;
    }

    .btnback {
        border: 2px solid #8E13DD !important;
        color: #8E13DD;
        background: white !important;
    }

    .transfersuccess i {
        font-size: 50px;
        margin-top: 50px;
        border: 2px solid green;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        line-height: 80px;
    }

    .transfersuccess {
        height: 450px;
        display: none;
    }
</style>
</head>

<body>
    <div class="container" style="margin-top: 50px;">
        <center>
            <h3 class="text-uppercase">chuyển tiền</h3>
            <div style="height: 2px; width:100px;background:purple">

            </div>
        </center>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card p-4 transfer" style="border-top:50px solid purple">
                    <div class="result" style="height: 50px;"></div>
                    <p class="text-secondary">Số dư : <span style="text-dark"><?= number_format($user->cash) ?></span></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email người nhận :</label>
                                <input type="text" id="receiver" class="form-control" placeholder="Nhập đúng email người nhận" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên người nhận :</label>
                                <input type="text" class="form-control" id="namereceiver" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Số tiền chuyển :</label>
                        <input type="text" id="transferamount" class="form-control" placeholder="Nhập số tiền muốn chuyển" />
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung chuyển tiền :</label>
                        <textarea class="form-control" id="content" rows="3" placeholder="Nhập nội dung">Chuyển tiền</textarea>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button class="btn btn-primary mb-3 btn1">Tiếp tục</button>
                    </div>
                </div>
                <div class="card p-4 bill">
                    <center style="border-bottom: 1px solid gray">
                        <h3 class="title">xác minh giao dịch</h3>
                    </center>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <p> Loại giao dịch</p>
                        </div>
                        <div class="col-md-6">
                            Chuyển tiền
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> Tên người chuyển</p>
                        </div>
                        <div class="col-md-6">
                            <?= $user->fullname  ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> Email người nhận</p>
                        </div>
                        <div class="col-md-6">
                            Chuyển tiền
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> Tên người nhận</p>
                        </div>
                        <div class="col-md-6">
                            Chuyển tiền
                        </div>
                    </div>
                    <div class="row" style="border-bottom:1px solid gray">
                        <div class="col-md-6">
                            <p> Số tiền chuyển</p>
                        </div>
                        <div class="col-md-6">
                            Chuyển tiền
                        </div>
                    </div>
                    <div class="row mt-3" style="border-bottom:1px solid gray">
                        <div class="col-md-6">
                            <p> Phí giao dịch</p>
                        </div>
                        <div class="col-md-6">
                            Miễn phí
                        </div>
                    </div>
                    <div class="row m-2 total">
                        <div class="col-md-6">
                            <h5> Tổng tiền</h5>
                        </div>
                        <div class="col-md-6">
                            Chuyển tiền
                        </div>
                    </div>
                    <div class="form-group text-center mt-5">
                        <button class="btn mt-2 btn-primary mb-2 btnSubmit">Xác nhận</button> <br>
                        <button class="btn btnback mb-2">Quay lại</button>
                    </div>
                </div>
                <div class="card p-4 otptransfer">
                    <div class="result" style="height: 50px;"></div>
                    <div class="form-group otp mt-3">
                        <input type="text" id="otp" class="form-control" maxlength="10" placeholder="Mã OTP gồm 10 ký tự" />
                    </div>
                    <div class="form-group text-center mt-3">
                        <button class="btn btn-primary mb-3 btn3"> Xác nhận giao dịch</button>
                    </div>
                </div>
                <div class="card transfersuccess p-3">
                    <center><i class="fa fa-check text-success"></i></center>
                    <div class="row text-center mt-3">
                        <div class="col-md-8 mx-auto">
                            <p>Quý khách đã chuyển thành công đến tài khoản <br> <span id="resulttransferreceiver"></span> với số tiền <span id="resulttransferamount"></span> đ <br> Cám ơn quá khách đã sử dụng dịch vụ.</p>
                        </div>
                    </div>
                    <div class="form-group text-center mt-5 fixed-bottom position-absolute">
                        <a href="/transfer"><button class="btn mt-2 btn-primary mb-2 btnnew">Tạo giao dịch mới</button></a> <br>
                        <a href="/"><button class="btn mb-5 btnhome text-white">Quay về trang chủ</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?= $this->element('Client/footer') ?>
<script>
    $('#receiver').blur((e) => {
        let email = $(e.target).val().trim()
        if (email != '') {
            $.ajax({
                url: '/client/requestajaxfinduser',
                type: 'post',
                data: {
                    email
                },
                dataType: 'json',
                success(response) {
                    if (response == null) {
                        $('#namereceiver').attr('value', 'Không tồn tại người nhận')
                    } else {
                        $('#namereceiver').attr('value', `${response.fullname}`)
                    }
                }
            })
        }
    })
    $('.btn1').click((e) => {
        e.preventDefault()
        let receiver = $('#receiver').val().trim()
        let transferamount = $('#transferamount').val().trim()
        let content = $('#content').val().trim()
        let namereceiver = $('#namereceiver').val().trim()
        if (receiver == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Vui lòng điền người nhận </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Tiếp tục')
            }, 1000);
        } else if (transferamount == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Vui lòng điền số tiền cần chuyển </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Tiếp tục')
            }, 1000);
        } else if (transferamount < 1000) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Số tiền chuyển phải lớn hơn 1000 VNĐ </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Tiếp tục')
            }, 1000);
        } else if (content == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Vui lòng điền nội dung </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Chuyển tiền')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajaxtransfer',
                type: 'post',
                data: {
                    receiver,
                    transferamount,
                    content
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.transfer').hide()
                            $('.bill').show()
                            $('.bill .row:nth-child(4) .col-md-6:last-child').html(receiver)
                            $('.bill .row:nth-child(5) .col-md-6:last-child').html(namereceiver)
                            $('.bill .row:nth-child(6) .col-md-6:last-child').html(transferamount)
                            $('.bill .total .col-md-6:last-child').html(transferamount)
                            $('button').removeAttr('disabled')
                            $('button').html('Tiếp tục')
                            $('.btnback').html('Quay lại')
                        }, 1000);
                    } else {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.result').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> ${response.message} </strong></div>`)
                            $('button').removeAttr('disabled')
                            $('button').html('Tiếp tục')
                        }, 1000);
                    }
                }
            })

        }
    })
    $('.btnback').click((e) => {
        e.preventDefault()
        $('.transfer').show()
        $('.bill').hide()
    })
    $('.btnSubmit').click((e) => {
        e.preventDefault()
        let sendOtp = 1
        $.ajax({
            url: '/client/requestajaxwithdraw',
            type: 'post',
            data: {
                sendOtp
            },
            dataType: 'json',
            success(response) {
                if (response.status == true) {
                    $('.btnSubmit').attr('disabled', 'disabled')
                    $('.btnSubmit').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('.bill').hide()
                        $('.otptransfer').show()
                        $('button').removeAttr('disabled')
                        $('button').html('Xác nhận giao dịch')
                        $('.result').html(`<div class="alert alert-warning alert-dismissible fade show">
                                                        <strong> Vui lòng nhập OTP ở email để xác minh giao dịch </strong></div>`)
                    }, 1000);
                }
            },
        })
       
    })
    $('.btn3').click((e) => {
        e.preventDefault()
        const otp = $('#otp').val().trim();
        if (otp == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>OTP không được để trống </strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Xác nhận giao dịch')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajaxtransfer',
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
                            $('.otptransfer').remove();
                            $('.transfersuccess').show()
                            $('button').removeAttr('disabled')
                            $('.btnnew').html('Tạo giao dịch mới')
                            $('.btnhome').html('Quay về trang chủ')
                            $('#resulttransferreceiver').html($('#receiver').val().trim())
                            $('#resulttransferamount').html($('#transferamount').val().trim())

                        }, 1000);
                    } else {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> OTP không chính xác </strong></div>')
                            $('button').removeAttr('disabled')
                            $('button').html('Xác nhận giao dịch')
                        }, 1000);
                    }
                },
            })
        }
    })
</script>