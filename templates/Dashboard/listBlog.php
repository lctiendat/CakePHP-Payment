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
            <button type="button" class="btn btn-outline-theme me-2 btnShowModal mb-3" data-bs-toggle="modal" data-bs-target="#modalAddBank">Thêm bài viết</button>
            <div id="result" class="mb-3 mt-3" style="height: 50px;">

            </div>
            <!-- <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="key" placeholder="Tìm kiếm">
                </div>
            </div> -->
            <div class="modal fade" id="modalAddBank">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-uppercase">Thêm bài viết</h5>
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
                                            <textarea rows="2" id="title" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Mô tả</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" id="description" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Nội dung</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" id="contentBlog" width="100%" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                    </div>
                                    <div class=" form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Ảnh nền</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="thumbnail">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button data-id="" type="submit" id="button" class="btn btn-outline-success btnAdd">Thêm bài viết</button>
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
                    #ID
                </th>
                <th>Tiêu đề</th>
                <th>Ảnh nền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($listBlog) == 0) { ?>
                <center>Dữ liệu không được tìm thấy</center>
            <?php } else { ?>
                <?php foreach ($listBlog as $item) { ?>
                    <tr>
                        <td>
                            <?= $pageStart++ ?>
                        </td>
                        <td><?= strlen($item->title) > 60 ? mb_substr($item->title, 0, 60) . '...' : $item->title ?></td>
                        <td> <img src="<?= $item->thumbnail ?>" alt="" style="width: 40px; height:40px; object-fit: fill;"></td>
                        <td>
                            <div class="row action">
                                <div class="col-md-6">
                                    <a href=""><i class="fas fa-pen edit" data-id="<?= $item->id ?>"></i></a>
                                </div>
                                <div class="col-md-6">
                                    <a href=""><i class="fas fa-trash delete" data-id="<?= $item->id ?>"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <button style="display: none;" type="button" class="btn btn-outline-theme me-2 btnShowModalEdit" data-bs-toggle="modal" data-bs-target="#modalEditBank">Modal Cover</button>
    <div class="modal fade" id="modalEditBank">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">chỉnh sửa bài viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-5 editBank">
                        <div id="resultEdit" style="height: 50px;">

                        </div>
                        <div class="form-group row mb-3 mt-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề</label>
                            <div class="col-sm-10">
                                <textarea rows="2" id="title1" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Mô tả</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" id="description1" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mt-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Nội dung</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" id="content1" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Ảnh nền</label>
                                        <div class="col-sm-7">
                                            <textarea rows="2" id="thumbnail1" class="form-control" oninput="auto_height(this)"></textarea>
                                        </div>
                                        <div class="col-sm-3">
                                            <img id="demoimg" alt="" style="width: 50px; height:50px; object-fit: fill;">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button data-id="" type="submit" class="btn btn-outline-success btnEdit">Chỉnh sửa bài viết</button>
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
            function auto_height(elem) {
                elem.style.height = "1px";
                elem.style.height = (elem.scrollHeight) + "px";
            }
            $('.btnAdd').click((e) => {
                e.preventDefault()
                let title = $('#title').val().trim()
                let description = $('#description').val().trim()
                let thumbnail = $('#thumbnail').val().trim()
                let content = $('#contentBlog').val().trim()

                if (title == '') {
                    $('.btnAdd').attr('disabled', 'disabled')
                    $('.btnAdd').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tiêu đề không hợp lệ</strong></div>')
                        $('.btnAdd').removeAttr('disabled')
                        $('.btnAdd').html('Thêm bài viết')
                    }, 1000);
                } else if (description == '') {
                    $('.btnAdd').attr('disabled', 'disabled')
                    $('.btnAdd').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mô tả không hợp lệ</strong></div>')
                        $('.btnAdd').removeAttr('disabled')
                        $('.btnAdd').html('Thêm bài viết')
                    }, 1000);
                } else if (description == '') {
                    $('.btnAdd').attr('disabled', 'disabled')
                    $('.btnAdd').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Nội dung không hợp lệ</strong></div>')
                        $('.btnAdd').removeAttr('disabled')
                        $('.btnAdd').html('Thêm bài viết')
                    }, 1000);
                } else if (thumbnail == '') {
                    $('.btnAdd').attr('disabled', 'disabled')
                    $('.btnAdd').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ảnh nền không hợp lệ</strong></div>')
                        $('.btnAdd').removeAttr('disabled')
                        $('.btnAdd').html('Thêm bài viết')
                    }, 1000);
                } else {
                    $.ajax({
                        url: '/dashboard/requestajax/saveblog',
                        type: 'POST',
                        data: {
                            title,
                            description,
                            content,
                            thumbnail
                        },
                        dataType: 'json',
                        success(response) {
                            if (response.status == true) {
                                $('.btn-close').click();
                                $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thêm bài viết thành công</strong></div>')
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
                            } else {
                                $('.btn-close').click();
                                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Có lỗi xảy ra. Bạn vui lòng kiểm tra lại.</strong></div>')
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
                            }
                        }
                    })
                }
            })

            $('.edit').click((e) => {
                e.preventDefault()
                let id = e.target.getAttribute('data-id')
                $('.btnEdit').attr('data-id', id)
                $.ajax({
                    url: '/dashboard/requestajax/getblog',
                    type: 'POST',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success(response) {
                        $('#title1').val(response.title)
                        $('#description1').val(response.description)
                        $('#content1').val(response.content)
                        $('#demoimg').attr('src', response.thumbnail)
                        $('#thumbnail1').val(response.thumbnail)

                        $('.btnShowModalEdit').click()
                    }
                })
            })
            $('.btnEdit').click((e) => {
                e.preventDefault()
                let id = e.target.getAttribute('data-id')
                let title = $('#title1').val().trim()
                let description = $('#description1').val().trim()
                let thumbnail = $('#thumbnail1').val()
                let content = $('#content1').val().trim()
                if (title == '') {
                    $('.btnEdit').attr('disabled', 'disabled')
                    $('.btnEdit').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultEdit').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Tiêu đề không hợp lệ</strong></div>')
                        $('.btnEdit').removeAttr('disabled')
                        $('.btnEdit').html('Chỉnh sửa bài viết')
                    }, 1000);
                } else if (description == '') {
                    $('.btnEdit').attr('disabled', 'disabled')
                    $('.btnEdit').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mô tả không hợp lệ</strong></div>')
                        $('.btnEdit').removeAttr('disabled')
                        $('.btnEdit').html('Chỉnh sửa bài viết')
                    }, 1000);
                } else if (thumbnail == '') {
                    $('.btnEdit').attr('disabled', 'disabled')
                    $('.btnEdit').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#resultAdd').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ảnh nền không hợp lệ</strong></div>')
                        $('.btnEdit').removeAttr('disabled')
                        $('.btnAbtnEditdd').html('Chỉnh sửa bài viết')
                    }, 1000);
                } else {
                    $.ajax({
                        url: '/dashboard/requestajax/saveblog',
                        type: 'POST',
                        data: {
                            id,
                            title,
                            description,
                            content,
                            thumbnail
                        },
                        dataType: 'json',
                        success(response) {
                            if (response.status == true) {
                                $('.btn-close').click();
                                $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Chỉnh sửa bài viết thành công</strong></div>')
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
                            } else {
                                $('.btn-close').click();
                                $('#result').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Có lỗi xảy ra. Bạn vui lòng kiểm tra lại.</strong></div>')
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
                            }
                        }

                    })
                }
            })
            $('.delete').click((e) => {
                e.preventDefault()
                let id = e.target.getAttribute('data-id')
                Swal.fire({
                    title: 'Xoá bài viết ?',
                    text: "Bạn có chắc muốn xoá bài viết này không!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/dashboard/requestajax/deleteblog',
                            type: 'POST',
                            data: {
                                id
                            },
                            dataType: 'json',
                            success(response) {
                                if (response.status == true) {
                                    Swal.fire({
                                        title: 'Xoá thành công',
                                        text: "Xoá bài viết thành công!",
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
            $('#thumbnail1').blur((e) => {
                e.preventDefault()
                // alert(1)
                $('#demoimg').onload()
            })
        </script>