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
            <button type="button" class="btn btn-outline-theme me-2 btnShowModalAdd mb-3" data-bs-toggle="modal" data-bs-target="#modalAddBank">Thêm ngân hàng</button>
            <div id="result" class="mt-3" style="height: 50px;">

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
                                            <input type="text" class="form-control" id="logo">
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
            <button style="display: none;" type="button" class="btn btn-outline-theme me-2 btnShowModalEdit" data-bs-toggle="modal" data-bs-target="#modalEditBank">Modal Cover</button>
            <div class="modal fade" id="modalEditBank">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-uppercase">chỉnh sửa ngân hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card p-5 editBank">
                                <div id="resultEdit" style="height: 50px;">

                                </div>
                                <div class="form-group row mb-3 mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tên ngân hàng</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Logo ngân hàng</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="logo">
                                    </div>
                                    <div class="col-md-3">
                                        <img style="width: 40px; height:40px; object-fit: fill;" alt="" width="100%">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button data-id="" type="submit" class="btn btn-outline-success btnEdit">Chỉnh sửa ngân hàng</button>
                                    </div>
                                </div>
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
                    #ID
                </th>
                <th>Tên ngân hàng</th>
                <th>Logo ngân hàng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($listBank) == 0) { ?>
                <center>Dữ liệu không được tìm thấy</center>
            <?php } else { ?>
                <?php foreach ($listBank as  $item) { ?>
                    <tr>
                        <td>
                            <?= $pageStart++ ?>
                        </td>
                        <td><?= $item->name ?></td>
                        <td> <img src="<?= $item->logo ?>" alt="" style="width: 40px; height:40px; object-fit: fill;"></td>
                        <td>
                            <div class="row action">
                                <div class="col-md-6">
                                    <a href=""><i class="fas fa-pen edit" data-id="<?= $item->id ?>"></i></a>
                                </div>
                                <div class="col-md-6">
                                    <a href=""><i class="fas fa-trash delete" data-bank="<?= $item->name ?>" data-id="<?= $item->id ?>"></i></a>
                                </div>
                            </div>
                        </td>
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
    $('.action i.delete').click((e) => {
        e.preventDefault()
        let id = e.target.getAttribute('data-id')
        let bank = e.target.getAttribute('data-bank')
        let action = 'delete'
        Swal.fire({
            title: 'Xoá ngân hàng?',
            text: `Bạn có chắc muốn xoá ngân hàng ${bank} không ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/requestajax/actionbank',
                    type: 'POST',
                    data: {
                        id,
                        action
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            Swal.fire({
                                title: 'Xoá thành công',
                                text: "Xoá ngân hàng thành công!",
                                icon: 'success',
                                showCancelButton: false,
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
    $('.action i.edit').click((e) => {
        e.preventDefault()
        let id = e.target.getAttribute('data-id')
        $.ajax({
            url: '/dashboard/requestajax/getbank',
            type: 'POST',
            data: {
                id
            },
            dataType: 'JSON',
            success(response) {
                $('.editBank #name').val(response.name)
                $('.editBank #logo').val(response.logo)
                $('.editBank img').attr('src', response.logo)
                $('.editBank button.btnEdit').attr('data-id', response.id)
                $('.btnShowModalEdit').click()
            }
        })
    })
    $('.btnEdit').click((e) => {
        let id = e.target.getAttribute('data-id')
        let name = $('.editBank #name').val().trim()
        let logo = $('.editBank #logo').val().trim()
        let action = 'update'
        if (name == '') {
            $('.btnEdit').attr('disabled', 'disabled')
            $('.btnEdit').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultEdit').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tên ngân hàng không hợp lệ</strong></div>')
                $('.btnEdit').removeAttr('disabled')
                $('.btnEdit').html('Chỉnh sửa ngân hàng')
            }, 1000);
        } else if (logo == '') {
            $('.btnEdit').attr('disabled', 'disabled')
            $('.btnEdit').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultEdit').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Logo ngân hàng không hợp lệ</strong></div>')
                $('.btnEdit').removeAttr('disabled')
                $('.btnEdit').html('Chỉnh sửa ngân hàng')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/actionbank',
                type: 'POST',
                data: {
                    id,
                    name,
                    logo,
                    action
                },
                dataType: 'json',
                success(response) {
                    console.log(response)
                    if (response.status == true) {
                        $('.btn-close').click();
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Chỉnh sửa ngân hàng thành công</strong></div>')
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    }
                }
            })
        }
    })
    $('.btnAdd').click((e) => {
        e.preventDefault()
        let name = $('.addBank #name').val().trim()
        let logo = $('.addBank #logo').val().trim()
        let action = 'creat'
        if (name == '') {
            $('.btnAdd').attr('disabled', 'disabled')
            $('.btnAdd').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tên ngân hàng không hợp lệ</strong></div>')
                $('.btnAdd').removeAttr('disabled')
                $('.btnAdd').html('Thêm ngân hàng')
            }, 1000);
        } else if (logo == '') {
            $('.btnAdd').attr('disabled', 'disabled')
            $('.btnAdd').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Logo ngân hàng không hợp lệ</strong></div>')
                $('.btnAdd').removeAttr('disabled')
                $('.btnAdd').html('Thêm ngân hàng')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/actionbank',
                type: 'POST',
                data: {
                    name,
                    logo,
                    action
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btn-close').click();
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thêm ngân hàng thành công</strong></div>')
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    }
                }
            })
        }
    })
</script>