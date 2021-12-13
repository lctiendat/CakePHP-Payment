<?= $this->element('Dashboard/header') ?>
<style>
    tr {
        height: 50px;
    }

    td {
        line-height: 50px;
    }
</style>
<div id="content" class="app-content">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-outline-theme me-2 btnShowModalAdd mb-3" data-bs-toggle="modal" data-bs-target="#modalAddBank">Thêm mã giảm giá</button>
            <div id="result" class="mb-3 mt-3" style="height: 50px;">

            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="key" placeholder="Tìm kiếm">
                </div>
            </div>
            <div class="modal fade" id="modalAddBank">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-uppercase">Thêm mã giảm giá</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card p-5 addBank">
                                <div id="resultAdd" style="height: 50px;">

                                </div>
                                <form method="post" action="" enctype="multipart/form-data" id="myform">
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề</label>
                                        <div class="col-sm-10">
                                            <textarea name="" id="title" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Mô tả</label>
                                        <div class="col-sm-10">
                                            <textarea name="" id="description" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Mã giảm giá</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="code">
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-outline-theme me-2 btn-random">Tạo Ngẫu nhiên</button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Số tiền giảm</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="money">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Số lượng</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="amount">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Coin</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="coin">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Loại</label>
                                        <div class="col-sm-10">
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <label for="">
                                                        <input type="radio" name="type" id="type" value="reduce" checked> Giảm tiền
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">
                                                        <input type="radio" name="type" id="type" value="refund"> Hoàn phần trăm tiền
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Ngày hết hạn</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="expired">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button data-id="" type="submit" class="btn btn-outline-success btnAdd">Thêm mã giảm giá</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- html -->
    <table class="table text-center" data-toggle="table" data-sort-class="table-active" data-sortable="true" data-search="true" data-pagination="true" data-show-refresh="true" data-show-columns="true" data-show-fullscreen="true" data-height="460">
        <thead>
            <tr>
                <th>
                    # ID
                </th>
                <th>Tiêu đề</th>
                <th>Mã giảm giá</th>
                <th>Số tiền giảm</th>
                <th>Số lượng còn lại</th>
                <th>Coin</th>
                <th>Loại mã giảm giá</th>
                <th>Thời gian hết hạn</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($listVoucher) == 0) { ?>
                <center>Dữ liệu không được tìm thấy</center>
            <?php } else { ?>
                <?php foreach ($listVoucher as $item) { ?>
                    <tr>
                        <td><?= $pageStart++ ?></td>
                        <td><?= $item->title ?></td>
                        <td><?= $item->code ?></td>
                        <td><?= $item->money ?></td>
                        <td><?= $item->amount ?></td>
                        <td><?= $item->coin ?></td>
                        <td><?= $item->type == 'reduce' ? 'Trừ tiền' : 'Hoàn tiền' ?></td>
                        <td><?= $item->expired_time ?></td>
                        <td><i class="fa fa-trash delete" data-code="<?= $item->code ?>"></i></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <?php if ($dataCount > 10) { ?>
        <div class="row mt-3">
            <div class="col-md-12 float-right">
                <ul class="pagination">
                    <?= $this->Paginator->prev("Prev") ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next("Next") ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>

<?= $this->element('Dashboard/footer') ?>
<script>
    function randomCode() {
        let length = 10;
        let characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let code = '';
        for (var i = 0; i < 10; i++) {
            code += characters.charAt(Math.floor(Math.random() *
                characters.length));
        }
        return code;
    }

    function validateMoney(money) {
        let reg = /^[0-9]/;
        return reg.test(money)
    }
    $('.btn-random').click((e) => {
        e.preventDefault()
        $('#code').attr('value', randomCode())
    })
    $('.btnAdd').click((e) => {
        e.preventDefault()
        let title = $('#title').val().trim()
        let description = $('#description').val().trim()
        let code = $('#code').val().trim()
        let money = $('#money').val().trim()
        let amount = $('#amount').val().trim()
        let coin = $('#coin').val().trim()
        let type = $('#type:checked').val().trim()
        let expired = $('#expired').val().trim()
        let date = new Date
        let dateNow = `'${date.getFullYear()}-${(date.getMonth() + 1)}-${date.getDate()}'`
        if (type == 'reduce') {
            if (title == '') {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tiêu đề không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (description == '') {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mô tả không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (code == '') {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mã giảm giá không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (validateMoney(money) == false || money < 1) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Số tiền giảm không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (validateMoney(amount) == false || amount < 1) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Số lượng không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (validateMoney(coin) == false || coin < 1) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Coin không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (expired == '' || new Date(expired) < new Date(dateNow) || expired == dateNow) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ngày hết hạn không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else {
                $.ajax({
                    url: '/dashboard/requestajax/addvoucher',
                    type: 'POST',
                    data: {
                        title,
                        description,
                        code,
                        money,
                        amount,
                        coin,
                        type,
                        expired
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            $('.btn-close').click();
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thêm mã giảm giá thành công</strong></div>')
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        } else {
                            $('.btnAdd').attr('disabled', 'disabled')
                            $('.btnAdd').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('#resultAdd').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>'`)
                                $('.btnAdd').removeAttr('disabled')
                                $('.btnAdd').html('Thêm mã giảm giá')
                            }, 1000);
                        }
                    }
                })
            }
        } else {
            if (title == '') {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tiêu đề không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (description == '') {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mô tả không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (code == '') {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mã giảm giá không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (validateMoney(money) == false || money < 1 || money > 100) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Phần trăm giảm không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (validateMoney(amount) == false || amount < 1) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Số lượng không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (validateMoney(coin) == false || coin < 1) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Coin không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else if (expired == '' || new Date(expired) < new Date(dateNow) || expired == dateNow) {
                $('.btnAdd').attr('disabled', 'disabled')
                $('.btnAdd').html('Đang xử lí ...')
                setTimeout(() => {
                    $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ngày hết hạn không hợp lệ</strong></div>')
                    $('.btnAdd').removeAttr('disabled')
                    $('.btnAdd').html('Thêm mã giảm giá')
                }, 1000);
            } else {
                $.ajax({
                    url: '/dashboard/requestajax/addvoucher',
                    type: 'POST',
                    data: {
                        title,
                        description,
                        code,
                        money,
                        amount,
                        coin,
                        type,
                        expired
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            $('.btn-close').click();
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thêm mã giảm giá thành công</strong></div>')
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        } else {
                            $('.btnAdd').attr('disabled', 'disabled')
                            $('.btnAdd').html('Đang xử lí ...')
                            setTimeout(() => {
                                $('#resultAdd').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>'`)
                                $('.btnAdd').removeAttr('disabled')
                                $('.btnAdd').html('Thêm mã giảm giá')
                            }, 1000);
                        }
                    }
                })
            }
        }
    })
    $(document).on('click', '.delete', function(e) {
        e.preventDefault()
        let code = e.target.getAttribute('data-code')
        Swal.fire({
            title: 'Xoá mã giảm giá',
            text: `Bạn có muốn xoá mã ${code} không ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/requestajax/deletevoucher',
                    type: 'POST',
                    data: {
                        code
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Xoá mã giảm giá thành công </strong></div>')
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        }
                    }
                })
            }
        })
    })
    $('#key').keyup((e) => {
        e.preventDefault()
        let key = $('#key').val().trim()
        let model = 'Vouchers'
        if (key != '') {
            $.ajax({
                url: '/dashboard/requestajax/search',
                type: 'POST',
                data: {
                    key,
                    model
                },
                dataType: 'json',
                success(response) {
                    console.log(response)
                    let data = ''
                    let j = 1
                    for (let i = 0; i < response.length; i++) {
                        data += `<tr>
                        <td>${j++}</td>
                        <td>${response[i].title}</td>
                        <td>${response[i].code}</td>
                        <td>${response[i].money}</td>
                        <td>${response[i].amount}</td>
                        <td>${response[i].coin}</td>
                        <td>${response[i].type == 'reduce' ? 'Trừ tiền' : 'Hoàn tiền' }</td>
                        <td>${response[i].expired_time }</td>
                        <td><i class="fa fa-trash delete" data-code="${response[i].code}"></i></td>
                        </tr>`

                    }
                    $('tbody').html(data)
                }
            })
        }

    })
</script>