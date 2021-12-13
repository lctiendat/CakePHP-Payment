<?= $this->element('Client/header') ?>
<style>
    .navbar-history p {
        line-height: 45px;
        border: 1px solid gray;
        border-radius: 5px;
        font-size: 15px;
    }

    .transfers,
    .withdrawMoney,
    .recharge {
        display: none;
    }
</style>
<div class="container" style="margin-top:50px">

    <center>
        <h3 class="text-uppercase">tổng hợp mã giảm giá</h3>
        <div style="height: 2px; width:100px;background:purple">

        </div>
    </center>
    <div class="col-md-7 mx-auto mt-5">
        <div class="row text-center navbar-history" style="height: 50px;">
            <div class="col-md-4">
                <p id="receiveMoney" style="background: purple ;color:white">Mã giảm tiền</p>
            </div>
            <div class="col-md-4">
                <p id="transfers">Mã hoàn phần trăm tiền</p>
            </div>
            <div class="col-md-4">
                <p id="withdrawMoney">Mã giảm giá của bạn</p>
            </div>
        </div>
        <div class="card p-3 mt-3" style="border-top:50px solid purple;">
            <div class="receiveMoney">
                <?php if ($listVoucherReduce != null) { ?>
                    <?php foreach ($listVoucherReduce as $item) { ?>
                        <div class="card p-3 mt-2" style="height: 100px;border:2px solid purple">
                            <div class="row">
                                <div class="col-md-2 text-center p-2" style="border-right:2px solid purple ">
                                    <span>Mã giảm tiền</span>
                                </div>
                                <div class="col-md-8">
                                    <h5 style="font-size: 16px;"><?= $item->title ?></h5>
                                    <span class="text-secondary" style="font-size: 13px;"> Ngày hết hạn : <?= $item->expired_time ?></span> <br>
                                    <span class="text-secondary" style="font-size: 13px;"> Số coin cần đổi : <strong class="text-dark"><?= $item->coin ?></strong> Viocoin</span>
                                </div>
                                <div class="col-md-2">
                                    <p data-code="<?= $item->code ?>" data-title="<?= $item->title ?>" data-coin="<?= $item->coin ?>" class="text-black mt-2 getVoucher font-weight-bold">Đổi ngay</p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <center>
                        <p>Dữ liệu của bạn không được tìm thấy</p>
                    </center>
                <?php } ?>
            </div>
            <div class="transfers">
                <?php if ($listVoucherRefund != null) { ?>
                    <?php foreach ($listVoucherRefund as $item) { ?>
                        <div class="card p-3 mt-2" style="height: 100px;border:2px solid purple">
                            <div class="row">
                                <div class="col-md-2 text-center p-2" style="border-right:2px solid purple ">
                                    <span>Mã hoàn tiền</span>
                                </div>
                                <div class="col-md-8">
                                    <h5 style="font-size: 16px;"><?= $item->title ?></h5>
                                    <span class="text-secondary" style="font-size: 13px;"> Ngày hết hạn : <?= $item->expired_time ?></span> <br>
                                    <span class="text-secondary" style="font-size: 13px;"> Số coin cần đổi : <strong class="text-dark"><?= $item->coin ?></strong> Viocoin</span>
                                </div>
                                <div class="col-md-2">
                                    <p data-code="<?= $item->code ?>" data-title="<?= $item->title ?>" data-coin="<?= $item->coin ?>" class="text-black mt-2 getVoucher font-weight-bold">Đổi ngay</p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <center>
                        <p>Dữ liệu của bạn không được tìm thấy</p>
                    </center>
                <?php } ?>
            </div>
            <div class="withdrawMoney">
                <?php if ($listVoucherOfUser != null) { ?>
                    <?php foreach ($listVoucherOfUser as $item) { ?>
                        <div class="card p-3 mt-2" style="height: 100px;border:2px solid purple">
                            <div class="row">
                                <div class="col-md-2 text-center p-2" style="border-right:2px solid purple ">
                                    <span>Mã <?= $item->type == 'reduce'?'giảm':'hoàn' ?> tiền</span>
                                </div>
                                <div class="col-md-6">
                                    <h5 style="font-size: 16px;"><?= $item->title ?></h5>
                                    <span class="text-secondary" style="font-size: 13px;"> Ngày hết hạn : <?= $item->expired_time ?></span> <br>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p class="p-2 mt-2" style="border: 2px solid purple;border-style:dashed"><?= $item->code ?></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <center>
                        <p>Dữ liệu của bạn không được tìm thấy</p>
                    </center>
                <?php } ?>
            </div>
        </div>
        <button type="button" class="btn btn-primary d-none showmodal" data-toggle="modal" data-target="#myModal">
            Open modal
        </button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">THÔNG TIN GIAO DỊCH</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray">Mã giao dịch</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="tranding_code"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray">Loại giao dịch</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="type"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray">Số tiền</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="money"></p>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray"> Thời gian</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="time"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray"> Tài khoản nhận</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="receive"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray"> Trạng thái</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="status"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary d-none showmodaltransfer" data-toggle="modal" data-target="#myModal1">
            Open modal
        </button>
        <div class="modal fade" id="myModal1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">THÔNG TIN GIAO DỊCH</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray">Mã giao dịch</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="tranding_codetransfer"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray">Loại giao dịch</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="typetransfer"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray">Số tiền</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="moneytransfer"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray"> Thời gian</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="timetransfer"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray" id="typeAccount"> Tài khoản nhận</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="receivetransfer"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 14px;color:gray"> Nội dung</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p id="content"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Client/footer') ?>
<script>
    $('#transfers').click((e) => {
        $('.transfers').show()
        $('.receiveMoney').hide()
        $('.withdrawMoney').hide()
        $('.recharge').hide()
        $('#transfers').css({
            'background': 'purple',
            'color': 'white'
        })
        $('#receiveMoney').css({
            'background': 'white',
            'color': 'black'
        })
        $('#withdrawMoney').css({
            'background': 'white',
            'color': 'black'
        })
        $('#recharge').css({
            'background': 'white',
            'color': 'black'
        })

    })
    $('#receiveMoney').click((e) => {
        $('.transfers').hide()
        $('.receiveMoney').show()
        $('.withdrawMoney').hide()
        $('.recharge').hide()
        $('#receiveMoney').css({
            'background': 'purple',
            'color': 'white'
        })
        $('#transfers').css({
            'background': 'white',
            'color': 'black'
        })
        $('#withdrawMoney').css({
            'background': 'white',
            'color': 'black'
        })
        $('#recharge').css({
            'background': 'white',
            'color': 'black'
        })
    })
    $('#withdrawMoney').click((e) => {
        $('.transfers').hide()
        $('.receiveMoney').hide()
        $('.withdrawMoney').show()
        $('.recharge').hide()
        $('#withdrawMoney').css({
            'background': 'purple',
            'color': 'white'
        })
        $('#receiveMoney').css({
            'background': 'white',
            'color': 'black'
        })
        $('#transfers').css({
            'background': 'white',
            'color': 'black'
        })
        $('#recharge').css({
            'background': 'white',
            'color': 'black'
        })
    })
    $('#recharge').click((e) => {
        $('.recharge').show()
        $('.receiveMoney').hide()
        $('.withdrawMoney').hide()
        $('.transfers').hide()
        $('#recharge').css({
            'background': 'purple',
            'color': 'white'
        })
        $('#receiveMoney').css({
            'background': 'white',
            'color': 'black'
        })
        $('#withdrawMoney').css({
            'background': 'white',
            'color': 'black'
        })
        $('#transfers').css({
            'background': 'white',
            'color': 'black'
        })
    })
    $('.getVoucher').click((e) => {
        e.preventDefault()
        let code = e.target.getAttribute('data-code')
        let title = e.target.getAttribute('data-title')
        let coin = e.target.getAttribute('data-coin')
        Swal.fire({
            title: 'Đổi mã giảm giá',
            text: `Bạn có muốn đổi mã ${title} với ${coin} VioCoin không ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/client/requestajaxusergetvoucher',
                    type: 'POST',
                    data: {
                        code
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: `Đổi mã giảm giá thành công`,
                            })
                            setTimeout(() => {
                                window.location.reload()
                            }, 3000);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: `${response.message}`,
                            })
                        }
                    }
                })
            }
        })
    })
</script>