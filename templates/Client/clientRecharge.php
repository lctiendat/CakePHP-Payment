<?= $this->element('Client/header') ?>
<style>
    label {
        font-size: 14px;
        color: gray;
    }

    ::placeholder {
        font-size: 15px;
    }

    textarea {
        font-size: 15px;
    }

    .recharge {
        display: none;
        height: 450px;
    }

    .recharge i {
        font-size: 50px;
        margin-top: 20px;
        border: 2px solid green;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        line-height: 80px;
    }

    .bill {
        display: none;
    }
</style>
<div class="container mb-5" style="margin-top: 50px;">
    <center>
        <h3 class="text-uppercase">nạp tiền</h3>
        <div style="height: 2px; width:100px;background:purple">

        </div>
    </center>
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card p-5 formRecharge" style="border-top: 50px solid purple;">
                <div id="result" style="height: 50px;"></div>
                <div class="card p-3 mt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="https://thuvienvector.com/upload/images/items/vector-logo-ngan-hang-bidv-file-cdr-coreldraw-133.webp" width="100%" alt="">
                        </div>
                        <div class="col-md-9">
                            <p class="mt-1"> Chủ Tài khoản : LE CONG TIEN DAT</p>
                            <p>Số tài khoản : 5511000001162223</p>
                        </div>
                    </div>
                </div>
                <span class="mt-3" style="font-size: 14px;color:red">* Bạn vui lòng chuyển tiền vào số tài khoản ở trên và điền đúng thông tin</span>
                <div class="form-group mt-3">
                    <label for=""> Số tiền nạp <span style="font-size: 13px;color:red"> * Số tiền nạp ít nhất là 50,000 đ</span></label>
                    <input type="text" class="form-control" id="moneyrecharge">
                </div>
                <div class="form-group">
                    <label for=""> Nội dung </label>
                    <textarea name="" id="" rows="2" readonly class="form-control">Nap Tien Vao Tai Khoan <?= $user->email ?> - VioPay</textarea>
                </div>
                <div class="form-group text-center">
                    <button class="btn btnRecharge text-white">Tiếp tục</button>
                </div>
            </div>
            <div class="card recharge p-3">
                <center><i class="fa fa-check text-success"></i></center>
                <div class="row text-center mt-3">
                    <div class="col-md-8 mx-auto">
                        <p>Quý khách đã tạo đơn nạp <br> <span class="money"></span> vào tài khoản <?= $user->email ?> <br>
                            Đơn nạp tiền của bạn sẽ được duyệt trong giây lát
                            <br> Cám ơn quá khách đã sử dụng dịch vụ.
                        </p>
                    </div>
                </div>
                <div class="form-group text-center mt-5">
                    <a href="/recharge"><button class="btn mt-2 btn-primary mb-2 btnnew">Tạo giao dịch mới</button></a> <br>
                    <a href="/"><button class="btn  mb-5 btnhome text-white">Quay về trang chủ</button></a>
                </div>
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
                        Nạp tiền vào tài khoản
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p> Tài khoản nạp</p>
                    </div>
                    <div class="col-md-6">
                        <?= $user->email ?>
                    </div>
                </div>
                <div class="row" style="border-bottom:1px solid gray">
                    <div class="col-md-6">
                        <p> Số tiền nạp</p>
                    </div>
                    <div class="col-md-6">
                        <p class="money"></p>
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
        </div>
    </div>
</div>
<?= $this->element('Client/footer') ?>
<script>
    function validateMoney(money) {
        let reg = /^[0-9]/;
        return reg.test(money)
    }
    $('.btnRecharge').click((e) => {
        e.preventDefault()
        let moneyrecharge = $('#moneyrecharge').val().trim()
        if (validateMoney(moneyrecharge) == false || moneyrecharge < 50000) {
            $('.btnRecharge').attr('disabled', 'disabled')
            $('.btnRecharge').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Số tiền tối thiểu để rút là 50000đ</strong></div>')
                $('.btnRecharge').removeAttr('disabled')
                $('.btnRecharge').html('Tiếp tục')
            }, 1000);
        } else {
            $('.btnRecharge').attr('disabled', 'disabled')
            $('.btnRecharge').html('Đang xử lí ...')
            setTimeout(() => {
                $('.btnRecharge').removeAttr('disabled')
                $('.btnRecharge').html('Tiếp tục')
                $('.money').html(moneyrecharge + ' đ')
                $('#total').html(moneyrecharge + ' đ')
                $('.bill').show()
                $('.formRecharge').hide()
            }, 1000)
        }
    })
    $('.btnSubmit').click((e) => {
        let moneyrecharge = $('#moneyrecharge').val().trim()
        $.ajax({
            url: '/client/requestajaxrecharge',
            type: 'POST',
            data: {
                moneyrecharge
            },
            dataType: 'json',
            success(response) {
                if (response.status == true) {
                    $('.btnSubmit').attr('disabled', 'disabled')
                    $('.btnback').attr('disabled', 'disabled')
                    $('.btnSubmit').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('.bill').remove()
                        $('#money').html(moneyrecharge + ' đ')
                        $('.recharge').show()
                    }, 1000);
                }
            }
        })
    })
    $('.btnback').click((e) => {
        $('.bill').hide()
        $('.formRecharge').show()
    })
</script>