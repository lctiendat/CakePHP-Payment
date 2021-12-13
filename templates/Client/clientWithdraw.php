<?= $this->element('Client/header') ?>
<style>
    label {
        font-size: 13px;
        color: gray;
    }

    input {
        border: 2px solid #8E13DD !important;
        height: 50px !important;
    }

    .otptransfer,
    .withdraw,
    .bill {
        display: none;
    }

    ::placeholder {
        font-size: 14px;
    }

    .withdraw i {
        font-size: 50px;
        margin-top: 50px;
        border: 2px solid green;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        line-height: 80px;
    }

    .withdraw {
        height: 450px;
        display: none;
    }
</style>
<div class="container mb-5" style="margin-top:50px;">
    <center>
        <h3 class="text-uppercase">rút tiền</h3>
        <div style="height: 2px; width:100px;background:purple">

        </div>
    </center>
    <div class="row mt-3">
        <div class="col-md-8 mx-auto">
            <div class="card p-3 formwithdraw" style="border-top: 50px solid purple; ">
                <?php if ($bankOfUser == null) { ?>
                    <p>Bạn chưa có ngân hàng, vui lòng <a href="/bank" class="text-danger">thêm </a>ngân hàng</p>
                <?php } else { ?>
                    <div class="result" style="height: 50px;"></div>
                    <div style="height:50px;background:#eee;border:0;border-radius:10px" class="w-100 mt-3">
                        <p style="line-height: 50px;" class="pl-3 text-secondary">Số dư ví : <span class="text-dark"><?= number_format($user->cash) ?> đ</span></p>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Số tiền cần rút : </label>
                        <input type="text" id="money" class="form-control" placeholder="0 đ">
                    </div>
                    <p class="text-uppercase">Phương thức nhận tiền</p>

                    <div class="card p-3" style="height: 100px;border: 2px solid #8E13DD !important">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="<?= $bankOfUser->bankLogo ?>" width="100%" alt="" style="width: 70px; height:70px; object-fit: fill;">
                            </div>
                            <div class="col-md-8">
                                <p><?= $bankOfUser->bankName ?></p>
                                <span style="font-size: 14px ; color:gray">**** **** **** <?= $cardHide ?></span>
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-check-circle text-success" style="line-height: 70px; font-size:25px;color:gray"></i>
                            </div>
                        </div>
                    </div>

                    <i class="fas fa-shield-alt text-success mt-3"><span class="text-secondary" style="font-size: 13px;font-family:Arial, Helvetica, sans-serif"> Mọi thông tin khách hàng đều được mã hoá để bảo mật.</span></i>
                    <div class="form-group text-center mt-5">
                        <button class="btn text-white btnwithdraw">Rút tiền</button>
                    </div>
                <?php } ?>
            </div>
            <div class="card p-4 bill">
                <center style="border-bottom: 1px solid gray">
                    <h3 class="title text-uppercase">xác minh giao dịch</h3>
                </center>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <p> Loại giao dịch</p>
                    </div>
                    <div class="col-md-6">
                        Rút tiền về ngân hàng
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p> Tài khoản nhận tiền</p>
                    </div>
                    <div class="col-md-6">
                        <span style="font-size: 14px ; color:gray">**** **** **** <?= $cardHide ?></span>
                    </div>
                </div>
                <div class="row" style="border-bottom:1px solid gray">
                    <div class="col-md-6">
                        <p> Số tiền rút</p>
                    </div>
                    <div class="col-md-6">
                        <p id="moneyWithdraw"></p>
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
                        <p id="total"></p>
                    </div>
                </div>
                <div class="form-group text-center mt-5">
                    <button class="btn mt-2 btn-primary mb-2 btnSubmit">Xác nhận</button> <br>
                    <button class="btn btnback mb-2 text-white">Quay lại</button>
                </div>
            </div>
            <div class="card p-4 otptransfer" style="height: 400px;">
                <div class="result" style="height: 50px;"></div>
                <div class="form-group otp mt-2">
                    <input type="text" id="otp" class="form-control" maxlength="10" placeholder="Mã OTP gồm 10 ký tự" />
                </div>
                <div class="form-group text-center mt-5 fixed-bottom position-absolute position-relative">
                    <button class="btn btn-primary mb-5 btn3"> Xác nhận giao dịch</button>
                </div>
            </div>
            <div class="card withdraw p-3">
                <center><i class="fa fa-check text-success"></i></center>
                <div class="row text-center mt-3">
                    <div class="col-md-8 mx-auto">
                        <p>Quý khách đã tạo đơn rút thành công số tiền <br>
                            <span id="moneywithdraw"></span> đ về số thẻ **** **** **** <?= $cardHide ?>
                            <br>
                            Đơn rút tiền của bạn sẽ được duyệt trong giây lát
                            <br> Cám ơn quá khách đã sử dụng dịch vụ.
                        </p>
                    </div>
                </div>
                <div class="form-group text-center mt-5 fixed-bottom position-absolute">
                    <a href="/withdraw"><button class="btn btnnew mt-2 btn-primary mb-2">Tạo giao dịch mới</button></a> <br>
                    <a href="/"><button class="btn mb-5 btnhome text-white">Quay về trang chủ</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Client/footer') ?>
<script>
    function validateMoney(money) {
        let reg = /^[0-9]/;
        return reg.test(money)
    }
    $('.btnwithdraw').click((e) => {
        e.preventDefault()
        let money = $('#money').val()
        if (validateMoney(money) == false || money < 50000) {
            $('.btnwithdraw').attr('disabled', 'disabled')
            $('.btnwithdraw').html('Đang xử lí ...')
            setTimeout(() => {
                $('.result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Số tiền tối thiểu để rút là 50000đ</strong></div>')
                $('.btnwithdraw').removeAttr('disabled')
                $('.btnwithdraw').html('Rút tiền')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajaxwithdraw',
                type: 'POST',
                data: {
                    money
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btnwithdraw').attr('disabled', 'disabled')
                        $('.btnwithdraw').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.formwithdraw').hide()
                            $('#moneyWithdraw').html(money + ' đ')
                            $('#total').html(money + ' đ')
                            $('.bill').show()
                            // $('.otptransfer').show()
                            // $('.btnwithdraw').removeAttr('disabled')
                            // $('.btnwithdraw').html('Xác nhận giao dịch')
                        }, 1000);
                    } else {
                        $('.btnwithdraw').attr('disabled', 'disabled')
                        $('.btnwithdraw').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.result').html(`<div class="alert alert-danger alert-dismissible fade show">
                                          <strong>${response.message}</strong></div>`)
                            $('.btnwithdraw').removeAttr('disabled')
                            $('.btnwithdraw').html('Rút tiền')
                        }, 1000);
                    }
                }
            })
        }
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
                url: '/client/requestajaxwithdraw',
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
                            //  window.location.href = '/client/register'
                            $('.otptransfer').remove();
                            $('.withdraw').show()
                            $('button').removeAttr('disabled')
                            $('#moneywithdraw').html($('#money').val())
                            $('.btnnew').html('Tạo giao dịch mới')
                            $('.btnhome').html('Quay về trang chủ')
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
    $('.btnback').click((e) => {
        e.preventDefault()
        $('.formwithdraw').show()
        $('.bill').hide()
        $('.btnwithdraw').removeAttr('disabled')
        $('.btnwithdraw').html('Rút tiền')
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
                    $('.btnback').attr('disabled', 'disabled')
                    $('.btnback').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('.bill').hide()
                        $('.otptransfer').show()
                        $('.result').html(`<div class="alert alert-warning alert-dismissible fade show">
                                                        <strong> Vui lòng nhập OTP ở email để xác minh giao dịch </strong></div>`)
                    }, 1000);
                }
            },
        })
    })
</script>