<?= $this->element('Client/header') ?>
<style>
    .formbank {
        display: none;
    }

    label span {
        font-size: 13px;
        color: red;
    }

    .btn {
        background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;
        width: 200px !important;
        font-size: 13px;
        height: 50px;
        border: 0;
    }
</style>
<div class="container" style="margin-top: 50px;">
    <center>
        <h3 class="text-uppercase">tài khoản ngân hàng</h3>
        <div style="height: 2px; width:100px;background:purple">
        </div>
    </center>
    <div class="row mt-3">
        <div class="col-md-8 mx-auto">
            <div class="card p-3" style="border-top: 50px solid purple; ">
                <?php if ($bankOfUser != null) { ?>
                    <div class="card p-3" style="height: 100px;">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="<?= $bankOfUser->bankLogo ?>" width="100%" alt="" style="width: 70px; height:70px; object-fit: fill;">
                            </div>
                            <div class="col-md-8">
                                <p><?= $bankOfUser->bankName ?></p>
                                <span style="font-size: 14px ; color:gray">**** **** **** <?= $cardHide ?></span>
                            </div>
                            <div class="col-md-1">
                                <i id="deletebank" class="fa fa-ban" style="line-height: 70px; font-size:25px;color:gray"></i>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href="" data-toggle="modal" class="text-secondary nav-link" data-target="#exampleModal" id="showbank"><i class="fa fa-plus p-1" style="border:1px solid gray"></i> Thêm ngân hàng</a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Danh sách ngân hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center">
                                        <?php
                                        foreach ($banks as $item) {
                                        ?>
                                            <div class="col-md-4">
                                                <img id="<?= $item->id ?>" src="<?= $item->logo ?>" width="100%" style="width: 70px; height:70px; object-fit: fill;" alt=""> <br>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-2 formbank">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div id="result" style="height: 50px;"></div>
                                <div class="form-group">
                                    <label for="">Ngân hàng</label>
                                    <input type="text" class="form-control" id="bankname" readonly>
                                    <input type="hidden" id="bankid">
                                </div>
                                <div class="form-group">
                                    <label for="">Tên chủ thẻ <span>* Tên chủ thẻ phải ghi in hoa và không ghi dấu.</span></label>
                                    <input type="text" id="holder" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Số thẻ <span> * Dãy 16 số nằm trên thẻ ngân hàng của bạn</span></label>
                                    <input type="text" id="cardnumber" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày phát hành<span> * Thẻ phải được phát hành trước tháng hiện tại</span></label>
                                    <input type="month" id="datecard" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" checked> <label style="font-size: 13px;" for="">Tôi chắc chắn tôi đã nhập đúng thông tin thẻ </label>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary form-control w-50 addbank">Thêm ngân hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Client/footer') ?>
<script>
    let listBank = JSON.parse('<?= json_encode($banks)?>')
    $('img').click((e) => {
        e.preventDefault()
        let bank = e.target.getAttribute('id')
        $('.close').click()
        $('.formbank').show()
        $('#showbank').remove()
        for (let i = 0; i < listBank.length; i++) {
            if (bank == listBank[i].id) {
                $('#bankname').attr('value', listBank[i].name)
                $('#bankid').attr('value', listBank[i].id)
            }
        }
    })

    function validateHolder(holder) {
        let reg = /^[A-Z \s]{1,}$/;
        return reg.test(holder)
    }

    function validateCardnumber(cardnumber) {
        let reg = /^[0-9]{16}$/;
        return reg.test(cardnumber)
    }

    function validateDatecard(datecard) {
        let reg = /^\d{4}\-\d{1,2}$/
        return reg.test(datecard)
    }
    $('.addbank').click((e) => {
        e.preventDefault()
        let bankid = $('#bankid').val()
        let holder = $('#holder').val()
        let cardnumber = $('#cardnumber').val()
        let datecard = $('#datecard').val()
        let date = new Date
        let dateNow = `'${date.getFullYear()}-${(date.getMonth() + 1)}'`
        if (bankid == '') {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ngân hàng không hợp lệ</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Thêm ngân hàng')
            }, 1000);
        } else if (validateHolder(holder) == false) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tên chủ thẻ không hợp lệ</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Thêm ngân hàng')
            }, 1000);
        } else if (validateCardnumber(cardnumber) == false) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Số thẻ không hợp lệ</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Thêm ngân hàng')
            }, 1000);
        } else if (validateDatecard(datecard) == false || (new Date(datecard) > new Date(dateNow)) == true) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ngày phát hành không hợp lệ</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Thêm ngân hàng')
            }, 1000);
        } else if ($('input[type="checkbox"]:checked').length == 0) {
            $('button').attr('disabled', 'disabled')
            $('button').html('Đang xử lí ...')
            setTimeout(() => {
                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng xác nhận đúng thông tin thẻ</strong></div>')
                $('button').removeAttr('disabled')
                $('button').html('Thêm ngân hàng')
            }, 1000);
        } else {
            $.ajax({
                url: '/client/requestajaxbank',
                type: 'POST',
                data: {
                    bankid,
                    holder,
                    cardnumber,
                    datecard
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('button').attr('disabled', 'disabled')
                        $('button').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thêm tài khoản ngân hàng thành công</strong></div>')
                            //1  $('button').removeAttr('disabled')
                            $('button').html('Thêm ngân hàng')
                            setTimeout(() => {
                                window.location.href = ""
                            }, 1000);
                        }, 1000);
                    }
                }
            })
        }
    })
    $('#deletebank').click((e) => {
        Swal.fire({
            title: 'Xoá thẻ ngân hàng',
            text: "Bạn có chắc muốn xoá thẻ ngân hàng này không ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/client/requestajaxdeletebank',
                    type: 'POST',
                    data: {

                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: 'Xoá thẻ ngân hàng thành công',
                                showConfirmButton: false
                            })
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        }
                    }
                })
            }
        })
    })
</script>