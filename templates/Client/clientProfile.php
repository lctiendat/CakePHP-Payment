<?= $this->element('Client/header') ?>
<style>
    ::placeholder {
        font-size: 13px !important;
    }

    label {
        font-size: 13px !important;
        color: gray;
    }

    input {
        height: 35px;
        font-size: 14px;
    }

    .btn {
        height: 40px !important;
    }

    .otp,
    .newPass,
    .rePass,
    .btnOtp,
    .btnNewpass {
        display: none;
    }
</style>
<div class="container" style="margin-top: 50px;">
    <center>
        <h3 class="text-uppercase">thông tin cá nhân</h3>
        <div style="height: 2px; width:100px;background:purple">

        </div>
    </center>
    <div class="row">
        <div class="col-md-9 mx-auto p-5">
            <div class="card p-5" style="border-top: 50px solid purple;">
                <center>
                    <img src="https://pdp.edu.vn/wp-content/uploads/2021/05/hinh-anh-avatar-de-thuong.jpg" class="rounded-circle" height="150px" width="150px" alt="">
                    <center class="mt-3">
                        <h4><?= $user->fullname ?></h4>
                    </center>
                </center>
                <center>
                    <p class="text-secondary" style="font-size: 14px;"><?= $user->email ?></p>
                </center>
                <div class="card pl-3 pr-3" style="height: 70px;">
                    <div class="row" style="line-height: 70px;">
                        <div class="col-md-8">
                            <p style="font-size: 15px;color:gray">Số dư ví : <span style="font-size: 16px;font-weight:bold;color:black"><?= number_format($user->cash) ?> đ</span> </hp>
                        </div>
                        <div class="col-md-4 text-right">
                            <a style="text-decoration:none;color:black" href="/transactionhistory">Lịch sử giao dịch <i class="fa fa-history"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card mt-2 pl-3 pr-3" style="height: 70px;">
                    <div class="row" style="line-height: 70px;">
                        <div class="col-md-8">
                            <p style="font-size: 15px;color:gray">Số dư coin : <span style="font-size: 16px;font-weight:bold;color:black"><?= number_format($user->coin) ?> VioCoin</span></span> </hp>
                        </div>
                        <div class="col-md-4 text-right">
                            <a style="text-decoration:none;color:black" href="/voucher">Đổi mã giảm giá ngay <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- <div class="card mt-2 pl-3 pr-3" style="height: 70px;">
                    <div class="row" style="line-height: 70px;">
                        <div class="col-md-8">
                            <input type="hidden" id="autologin" value="http://localhost/client/autologin?token=<?= $user->token_login ?>">
                            <p style="font-size: 15px;color:gray">Tự động đăng nhập</span> </hp>
                        </div>
                        <div class="col-md-4 text-right">
                            <button class="btn-copy" data-clipboard-target="#autologin">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div> -->
                <?php if ($api == null) { ?>
                    <div class="card mt-2 pl-3" style="height: 70px;">
                        <div class="row" style="line-height: 70px;">
                            <div class="col-md-8">
                                <p style="font-size: 15px;color:gray">Tạo kết nối API</span> </hp>
                            </div>
                            <div class="col-md-4 text-right">
                                <a style="text-decoration:none;color:black" href="/voucher" class="addApi">Tạo <i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card mt-2 p-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Public key</label>
                                        <input type="text" class="form-control" readonly value="<?= $api->public_key ?>">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="">Security key</label>
                                        <input type="text" class="form-control" readonly value="<?= $api->security_key ?>">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
            </div>
        <?php } ?>
        <div class="card mt-2 pl-3 pr-3" style="height: 70px;">
            <div class="row" style="line-height: 70px;">
                <div class="col-md-8">
                    <p style="font-size: 15px;color:gray">Thay đổi mật khẩu</span> </hp>
                </div>
                <div class="col-md-4 text-right">
                    <a style="text-decoration:none;color:black" id="changePass" href="">Thay đổi <i class="fa fa-pen"></i></a>
                </div>
            </div>
        </div>
        <div class="card mt-2 pl-3 pr-3" style="height: 70px;">
            <div class="row" style="line-height: 70px;">
                <div class="col-md-8">
                    <p style="font-size: 15px;color:gray">Đăng xuất tài khoản</span> </hp>
                </div>
                <div class="col-md-4 text-right">
                    <a style="text-decoration:none;color:black" href="/client/logout">Đăng xuất <i class="fa fa-power-off"></i></a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
<button type="button" class="btn btn-primary d-none modalChangepass" data-toggle="modal" data-target="#myModal">
    Open modal
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thay đổi mật khẩu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="result" style="height: 50px;"></div>

                <div class="form-group oldPass position-relative">
                    <label for=""> Mật khẩu hiện tại</label>
                    <input type="password" class="form-control" id="oldPass" placeholder="Vui lòng nhập mật khẩu">
                    <span id="iconpassword" class="fa fa-eye float-right position-absolute" style="top: 43px; right:10px"></span>
                </div>
                <div class="form-group otp">
                    <label for=""> OTP</label>
                    <input type="text" class="form-control" id="otp" placeholder="Vui lòng nhập OTP ở email">
                </div>
                <div class="form-group newPass position-relative">
                    <label for=""> Mật khẩu mới</label>
                    <input type="password" class="form-control" id="newpass" placeholder="Vui lòng nhập mật khẩu">
                    <span id="iconpassword1" class="fa fa-eye float-right position-absolute" style="top: 43px; right:10px"></span>
                </div>
                <div class="form-group rePass position-relative">
                    <label for=""> Mật khẩu nhập lại</label>
                    <input type="password" class="form-control" id="repass" placeholder="Vui lòng nhập lại mật khẩu">
                    <span id="iconpassword2" class="fa fa-eye float-right position-absolute" style="top: 43px; right:10px"></span>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btnOldpass">Tiếp tục</button>
                    <button class="btn btn-primary btnOtp">Tiếp tục</button>
                    <button class="btn btn-primary btnNewpass">Đổi mật khẩu</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->element('Client/footer') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.btn-copy');
    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    function validatePassword(password) {
        const reg = /^[0-9]{8}$/;
        return reg.test(password);
    }

    function validateDomain(domain) {
        const reg = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/;
        return reg.test(domain);
    }
    $('#changePass').click((e) => {
        e.preventDefault()
        $('.modalChangepass').click()
    })
    $('.btnOldpass').click((e) => {
        let oldPass = $('#oldPass').val().trim()
        if (validatePassword(oldPass) == false) {
            $('.btnOldpass').attr('disabled', 'disabled')
            $('.btnOldpass').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Mật khẩu phải đủ 8 chữ số</strong></div>')
                $('.btnOldpass').removeAttr('disabled')
                $('.btnOldpass').html('Tiếp tục')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajax/changepass',
                type: 'POST',
                data: {
                    oldPass
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btnOldpass').attr('disabled', 'disabled')
                        $('.btnOldpass').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.otp').show()
                            $('.oldPass').remove()
                            $('.btnOldpass').remove()
                            $('.btnOtp').show()
                            $('#result').html(`<div class="alert alert-warning alert-dismissible fade show">\
                                          <strong> Vui lòng nhập OTP được gửi về mail</strong></div>`)

                        }, 1000);
                    } else {
                        $('.btnOldpass').attr('disabled', 'disabled')
                        $('.btnOldpass').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> ${response.message}</strong></div>`)
                            $('.btnOldpass').removeAttr('disabled')
                            $('.btnOldpass').html('Tiếp tục')
                        }, 1000);
                    }
                }

            })
        }
    })
    $('.btnOtp').click((e) => {
        e.preventDefault()
        const otp = $('#otp').val();
        if (otp == '') {
            $('.btnOtp').attr('disabled', 'disabled')
            $('.btnOtp').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>OTP không được để trống </strong></div>')
                $('.btnOtp').removeAttr('disabled')
                $('.btnOtp').html('Tiếp tục')
            }, 1000);

        } else {
            $.ajax({
                url: '/client/requestajax/changepass',
                type: 'post',
                data: {
                    otp
                },
                dataType: 'json',
                success(response) {
                    if (response == true) {
                        $('.btnOtp').attr('disabled', 'disabled')
                        $('.btnOtp').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.otp').remove()
                            $('.newPass').show()
                            $('.rePass').show()
                            $('.btnOtp').remove()
                            $('.btnNewpass').show()
                            $('#result').html('<div class="alert alert-warning alert-dismissible fade show">\
                                          <strong> Vui lòng nhập mật khẩu bạn muốn đổi </strong></div>')
                        }, 1000);
                    } else {
                        $('.btnOtp').attr('disabled', 'disabled')
                        $('.btnOtp').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> OTP không chính xác </strong></div>')
                            $('.btnOtp').removeAttr('disabled')
                            $('.btnOtp').html('Tiếp tục')
                        }, 1000);
                    }
                },
            })
        }
    })
    $('.btnNewpass').click((e) => {
        let newPass = $('#newpass').val().trim()
        let rePass = $('#repass').val().trim()
        if (validatePassword(newPass) == false) {
            $('.btnNewpass').attr('disabled', 'disabled')
            $('.btnNewpass').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Mật khẩu phải đủ 8 chữ số</strong></div>')
                $('.btnNewpass').removeAttr('disabled')
                $('.btnNewpass').html('Đổi mật khẩu')
            }, 1000);
        } else if (validatePassword(rePass) == false) {
            $('.btnNewpass').attr('disabled', 'disabled')
            $('.btnNewpass').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> Mật khẩu nhập lại phải đủ 8 chữ số</strong></div>')
                $('.btnNewpass').removeAttr('disabled')
                $('.btnNewpass').html('Đổi mật khẩu')
            }, 1000);
        } else if (newPass != rePass) {
            $('.btnNewpass').attr('disabled', 'disabled')
            $('.btnNewpass').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong> 2 mật khẩu phải giống nhau </strong></div>')
                $('.btnNewpass').removeAttr('disabled')
                $('.btnNewpass').html('Đổi mật khẩu')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajax/changepass',
                type: 'POST',
                data: {
                    newPass
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btnNewpass').attr('disabled', 'disabled')
                        $('.btnNewpass').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('.btnNewpass').html('Chuyển hướng')
                            $('#result').html(`<div class="alert alert-success alert-dismissible fade show">\
                                          <strong> Đổi mật khẩu thành công,chuyển hướng sau 3s</strong></div>`)
                            setTimeout(() => {
                                window.location.href = "/client/logout"
                            }, 3000)
                        }, 1000);
                    }
                }
            })
        }
    })

    $('.addApi').click((e) => {
        e.preventDefault()
        Swal.fire({
            title: 'Tạo API ?',
            text: "Bạn có chắc muốn tạo API thanh toán không!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '/client/requestajaxuseraddapi',
                    type: 'POST',
                    data: {},
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            Swal.fire(
                                'Thành công',
                                'Tạo API thành công',
                                'success'
                            )
                            setTimeout(() => {
                                window.location.reload()
                            }, 3000);
                        }
                    }
                })
            }
        })
    })

    $('#iconpassword').click((e) => {
        if ($('#oldPass').attr('type') == 'password') {
            $('#oldPass').attr('type', 'text')
            $('#iconpassword').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#oldPass').attr('type', 'password')
            $('#iconpassword').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })
    $('#iconpassword1').click((e) => {
        if ($('#newpass').attr('type') == 'password') {
            $('#newpass').attr('type', 'text')
            $('#iconpassword1').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#newpass').attr('type', 'password')
            $('#iconpassword1').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })
    $('#iconpassword2').click((e) => {
        if ($('#repass').attr('type') == 'password') {
            $('#repass').attr('type', 'text')
            $('#iconpassword2').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#repass').attr('type', 'password')
            $('#iconpassword2').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })
    // $('.copy').click((e) => {
    //     e.preventDefault()
    //     let link = e.target.getAttribute('data-link')
    //     new ClipboardJS('.copy-link');
    //     alert('Copy thành công')
    // })
</script>