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
        <h3 class="text-uppercase">lịch sử giao dịch</h3>
        <div style="height: 2px; width:100px;background:purple">

        </div>
    </center>
    <div class="col-md-9 mx-auto mt-5">
        <div class="row text-center navbar-history" style="height: 50px;">
            <div class="col-md-3">
                <p id="receiveMoney" style="background: purple ;color:white">Nhận tiền</p>
            </div>
            <div class="col-md-3">
                <p id="transfers">Chuyển tiền</p>
            </div>
            <div class="col-md-3">
                <p id="recharge">Nạp tiền</p>
            </div>
            <div class="col-md-3">
                <p id="withdrawMoney">Rút tiền</p>
            </div>
        </div>
        <div class="card p-3 mt-3" style="border-top:50px solid purple; height:500px;overflow-y:scroll">
            <div class="receiveMoney">
                <?php if ($listReceive != null) { ?>
                    <?php foreach ($listReceive as $item) { ?>
                        <div class="card p-3 mt-2">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <i style="font-size: 40px;" class="fa fa-arrow-alt-circle-down text-success"></i>
                                </div>
                                <div class="col-md-7">
                                    <h5 style="font-size: 16px;">Nhận tiền từ <?= $item->transmitter ?></h5>
                                    <p class="text-secondary" style="font-size: 13px;"><?= $item->created ?></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="font-weight-bold">+ <?= number_format($item->amount_of_money) ?> đ</p>
                                </div>
                                <div class="col-md-1">
                                    <i id="showbillreceive" data-code="<?= $item->tranding_code ?>" class="fa fa-eye"></i>
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
                <?php if ($listTransfers != null) { ?>
                    <?php foreach ($listTransfers as $item) { ?>
                        <div class="card p-3 mt-2" data-id="<?= $item->id ?>">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <i style="font-size: 40px;" class="fa fa-arrow-alt-circle-up text-danger"></i>
                                </div>
                                <div class="col-md-7">
                                    <h5 style="font-size: 16px;">Chuyển tiền đến <?= $item->receiver ?></h5>
                                    <p class="text-secondary" style="font-size: 13px;"><?= $item->created ?></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="font-weight-bold">- <?= number_format($item->amount_of_money) ?> đ</p>
                                </div>
                                <div class="col-md-1">
                                    <i id="showbilltransfer" data-code="<?= $item->tranding_code ?>" class="fa fa-eye"></i>
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
            <div class="recharge">
                <?php if ($listReCharge != null) { ?>
                    <?php foreach ($listReCharge as $item) { ?>
                        <div class="card p-3 mt-2">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <i style="font-size: 40px;" class="fa fa-arrow-alt-circle-down text-success"></i>
                                </div>
                                <div class="col-md-7">
                                    <h5 style="font-size: 16px;">Nạp tiền vào tài khoản </h5>
                                    <p class="text-secondary" style="font-size: 13px;"><?= $item->created ?></p>
                                </div>
                                <div class="col-md-2">
                                    <?php if ($item->status == 'pending') { ?>
                                        <span class="badge badge-secondary">Chờ duyệt</span>
                                    <?php } elseif ($item->status == 'accept') { ?>
                                        <p class="font-weight-bold"> + <?= number_format($item->transaction_amount) ?> đ</p>
                                        <span class="badge badge-success">Thành công</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">Thất bại</span>
                                    <?php } ?>
                                </div>
                                <div class="col-md-1">
                                    <i id="showbillbank" data-code="<?= $item->tranding_code ?>" class="fa fa-eye"></i>
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
            <div class="withdrawMoney"">
                <?php if ($listWithdraw != null) { ?>
                    <?php foreach ($listWithdraw as $item) { ?>
                        <div class=" card p-3 mt-2">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <i style="font-size: 40px;" class="fa fa-arrow-alt-circle-up text-danger"></i>
                    </div>
                    <div class="col-md-7">
                        <h5 style="font-size: 16px;">Rút tiền về số thẻ ************<?= substr($item->bank, 12) ?> </h5>
                        <p class="text-secondary" style="font-size: 13px;"><?= $item->created ?></p>
                    </div>
                    <div class="col-md-2">
                        <?php if ($item->status == 'pending') { ?>
                            <span class="badge badge-secondary">Chờ duyệt</span>
                        <?php } elseif ($item->status == 'accept') { ?>
                            <p class="font-weight-bold">- <?= number_format($item->transaction_amount) ?> đ</p>
                            <span class="badge badge-success">Thành công</span>
                        <?php } else { ?>
                            <span class="badge badge-danger">Thất bại</span> <br>
                        <?php } ?>
                    </div>
                    <div class="col-md-1">
                        <i id="showbillbank" data-code="<?= $item->tranding_code ?>" class="fa fa-eye"></i>
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
    $('.card #showbillbank').click((e) => {
        let code = e.target.getAttribute('data-code')
        let type = 'bank';
        $.ajax({
            url: '/client/requestajaxbankhistory',
            type: 'POST',
            data: {
                code,
                type
            },
            dataType: 'json',
            success(response) {
                $('#tranding_code').html('#' + response.tranding_code)
                $('#type').html(response.transaction_type == 'withdraw' ? 'Rút tiền' : 'Nạp tiền')
                $('#money').html(response.transaction_amount)
                $('#time').html(new Date(response.created).toLocaleString())
                $('#receive').html(response.transaction_type == 'withdraw' ? '************' + response.bank.substring(12, 16) : response.email)
                $('#status').html(response.status == 'pending' ? `<span class="badge badge-secondary">Chờ duyệt</span>
` : response.status == 'accept' ? `<span class="badge badge-success">Thành công</span>
` : `<span class="badge badge-danger">Thất bại</span> <br>
 Lý do : ${response.reason}`)
                $('.showmodal').click()
            }
        })
    })
    $('.card #showbilltransfer').click((e) => {
        let code = e.target.getAttribute('data-code')
        let type = 'transfer';
        $.ajax({
            url: '/client/requestajaxbankhistory',
            type: 'POST',
            data: {
                code,
                type
            },
            dataType: 'json',
            success(response) {
                $('#tranding_codetransfer').html('#' + response.tranding_code)
                $('#typetransfer').html('Chuyển tiền')
                $('#moneytransfer').html(response.amount_of_money + ' đ')
                $('#timetransfer').html(new Date(response.created).toLocaleString())
                $('#receivetransfer').html(response.receiver)
                $('#typeAccount').html('Tài khoản nhận')
                $('#content').html(response.content)
                $('.showmodaltransfer').click()
            }
        })
    })
    $('.card #showbillreceive').click((e) => {
        let code = e.target.getAttribute('data-code')
        let type = 'receive';
        $.ajax({
            url: '/client/requestajaxbankhistory',
            type: 'POST',
            data: {
                code,
                type
            },
            dataType: 'json',
            success(response) {
                $('#tranding_codetransfer').html('#' + response.tranding_code)
                $('#typetransfer').html('Nhận tiền')
                $('#moneytransfer').html(response.amount_of_money + ' đ')
                $('#timetransfer').html(new Date(response.created).toLocaleString())
                $('#receivetransfer').html(response.transmitter)
                $('#typeAccount').html('Tài khoản gửi')
                $('#content').html(response.content)
                $('.showmodaltransfer').click()
            }
        })
    })
</script>