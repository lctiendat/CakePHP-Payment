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
            <div id="result" class="mt-3 mb-2" style="height: 50px;">

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
                            <h5 class="modal-title text-uppercase">Thêm ngân hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card p-5 addBank">
                                <div id="resultAdd" style="height: 50px;">

                                </div>
                                <form method="post" action="" enctype="multipart/form-data" id="myform">
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Tên ngân hàng</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Logo ngân hàng</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="logo">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button data-id="" type="submit" class="btn btn-outline-success btnAdd">Thêm ngân hàng</button>
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
                    # Mã giao dịch
                </th>
                <th>Người rút tiền</th>
                <th>Tài khoản nhận</th>
                <th>Số tiền rút</th>
                <th>Thời gian rút</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($listWithdrawalOrder) == 0) { ?>
                <center>Dữ liệu không được tìm thấy</center>
            <?php } else { ?>
                <?php foreach ($listWithdrawalOrder as $key => $item) { ?>
                    <tr>
                        <td>
                            <?= $item->tranding_code ?>
                        </td>
                        <td><?= $item->email ?></td>
                        <td><?= $item->bank ?></td>
                        <td><?= $item->transaction_amount ?></td>
                        <td><?= $item->created ?></td>
                        <td>
                            <?php if ($item->status == 'pending') { ?>
                                <div class="row action">
                                    <div class="col-md-6">
                                        <i class="fas fa-check accept text-success" data-count="<?= ++$key ?>" data-id="<?= $item->tranding_code ?>"></i>
                                    </div>
                                    <div class="col-md-6">
                                        <i class="fas fa-window-close cancel text-danger" data-count="<?= $key ?>" data-id="<?= $item->tranding_code ?>"></i>
                                    </div>
                                </div>
                            <?php } elseif ($item->status == 'accept') { ?>
                                <span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>
                            <?php } else { ?>
                                <span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Từ chối</span>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-outline-theme me-2 d-none btnShowModelCancelWithDraw" data-bs-toggle="modal" data-bs-target="#modalCancelWithdraw">Modal Cover</button>
    <div class="modal fade" id="modalCancelWithdraw">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">từ chối rút tiền</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-5 editBank">
                        <div id="resulCancel" style="height: 50px;">

                        </div>
                        <p class="mt-3">Bạn đang từ chối rút tiền của mã giao dịch <b id="trandingcode"></b></p>
                        <div class="form-group row mb-3 mt-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Lý do</label>
                            <div class="col-sm-10">
                                <textarea id="reason" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-outline-success btnCancel">Từ chối rút tiền</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    $(document).on('click', '.accept', function(e) {
        e.preventDefault()
        let code = e.target.getAttribute('data-id');
        let count = e.target.getAttribute('data-count');
        let type = 'withdraw'
        Swal.fire({
            title: 'Duyệt rút tiền?',
            text: `Bạn có chắc muốn duyệt đơn rút tiền #${code} không ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/requestajax/acceptorder',
                    type: 'POST',
                    data: {
                        code,
                        type
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Duyệt đơn rút tiền thành công </strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(6)`).html(`<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>`)
                            
                        }
                    }
                })
            }
        })
    })

    $(document).on('click', '.cancel', function(e) {
        e.preventDefault()
        let code = e.target.getAttribute('data-id');
        let count = e.target.getAttribute('data-count');
        $('#trandingcode').html(`#${code} `)
        $('.btnShowModelCancelWithDraw').click()
        $('.btnCancel').attr('data-id', code)
        $('.btnCancel').attr('data-count', count)
    })

    $('.btnCancel').click((e) => {
        e.preventDefault()
        let code = e.target.getAttribute('data-id');
        let count = e.target.getAttribute('data-count');
        let reason = $('#reason').val().trim()
        let type = 'withdraw'
        if (reason == '') {
            $('.btnCancel').attr('disabled', 'disabled')
            $('.btnCancel').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resulCancel').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng nhập lý do muốn từ chối</strong></div>')
                $('.btnCancel').removeAttr('disabled')
                $('.btnCancel').html('Từ chối rút tiền')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/cancelorder',
                type: 'POST',
                data: {
                    code,
                    reason,
                    type
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btn-close').click()
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Từ chối đơn rút tiền thành công </strong></div>')
                        $(`tr:nth-child(${count}) td:nth-child(6)`).html(`<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i>Từ chối</span>`)
                    }
                }
            })
        }
    })
    $('.btn-close').click((e) => {
        $('#resulCancel').html('')
    })

    $('#key').keyup((e) => {
        e.preventDefault()
        let key = $('#key').val().trim()
        let model = 'Withdraw'
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
                        <td>${response[i].tranding_code}</td>
                        <td>${response[i].email}</td>
                        <td>${response[i].bank}</td>
                        <td>${response[i].transaction_amount}</td>
                        <td>${response[i].created}</td>
                        <td>
                        ${ response[i].status == 'pending' ?
                            `<div class="row action">
                                    <div class="col-md-6">
                                       <i class="fas fa-check accept text-success" data-count="${j++}" data-id="${response[i].tranding_code}"></i>
                                    </div>
                                    <div class="col-md-6">
                                       <i class="fas fa-window-close cancel text-danger" data-count="${j-1}" data-id="${response[i].tranding_code}"></i>
                                    </div>
                            </div>`
                                 : response[i].status == 'accept' ? 
                                `<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>` :
                                `<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Từ chối</span>`}

                        </td>
                            </tr>`

                    }
                    $('tbody').html(data)
                }
            })
        }

    })
</script>