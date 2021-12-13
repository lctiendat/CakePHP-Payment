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
    <div id="result" class="mb-3 mt-3" style="height: 50px;">

    </div>
    <div class="row">
        <div class="col-md-3">
            <input type="text" class="form-control" id="key" placeholder="Tìm kiếm">
        </div>
    </div>
    <table class="table text-center" data-toggle="table" data-sort-class="table-active" data-sortable="true" data-search="true" data-pagination="true" data-show-refresh="true" data-show-columns="true" data-show-fullscreen="true" data-height="460">
        <thead>
            <tr>
                <th>
                    #ID
                </th>
                <th>Email</th>
                <th>Số tiền</th>
                <th>Số coin</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($listUser) == 0) { ?>
                <center>Dữ liệu không được tìm thấy</center>
            <?php } else { ?>
                <?php foreach ($listUser as $key => $item) { ?>
                    <tr>
                        <td>
                            <?= $pageStart++ ?>
                        </td>
                        <td><?= $item->email ?></td>
                        <td class="addMoney"><?= number_format($item->cash) ?> <i class="fa fa-plus" data-cash="<?= $item->cash ?>" data-count="<?= ++$key ?>" data-email="<?= $item->email ?>"></i></td>
                        <td class="addCoin"><?= $item->coin ?> <i class="fa fa-plus" data-coin="<?= $item->coin ?>" data-count="<?= $key ?>" data-email="<?= $item->email ?>"></td>
                        <?php if ($item->status == 1) { ?>
                            <td class="userLock"><i class="fa fa-lock text-danger" data-count="<?= $key ?>" data-email="<?= $item->email ?>"></i></td>
                        <?php } else { ?>
                            <td class="<?php if ($item->email != $_SESSION['arrSessionUser']['email']) { ?>userUnlock <?php } ?>"><i class="fa fa-unlock <?= $item->email != $_SESSION['arrSessionUser']['email'] ? 'text-success' : 'text-secondary'  ?>" disabled class="fa fa-lock text-danger" data-count="<?= $key ?>" data-email="<?= $item->email ?>"></i></td>
                        <?php } ?>
                        <td>
                            <div class="row action">
                                <div class="col-6">
                                    <i class="fas fa-key text-primary password" data-email="<?= $item->email ?>"></i>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-user-cog <?php if ($item->email == $_SESSION['arrSessionUser']['email']) { ?> text-secondary<?php } else { ?> role <?= $item->role == 'user' ? 'text-primary' : 'text-danger' ?>" data-role="<?= $item->role ?>" data-count="<?= $key ?>" data-email="<?= $item->email ?> <?php } ?>"></i>
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
    <button type="button" style="display: none;" class="btn btn-outline-theme me-2" id="btnAddMoney" data-bs-toggle="modal" data-bs-target="#modalSm">Small modal</button>
    <div class="modal fade" id="modalSm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">cộng / trừ tiền</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="resultAddMoney" class="mb-2" style="height: 50px;">

                    </div>
                    <p> Bạn đang cộng / trừ tiền cho tài khoản có email <strong id="userMoney"></strong></p>
                    <div class="row">
                        <div class="col-md-3">
                            <select name="" id="calculation" class="form-control">
                                <option value="plus" selected>Cộng</option>
                                <option value="sub">Trừ</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" id="money" class="form-control" placeholder="Nhập số tiền muốn cộng hoặc trừ">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-outline-success btnAddMoney">Thao tác</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" style="display: none;" class="btn btn-outline-theme me-2" id="btnAddCoin" data-bs-toggle="modal" data-bs-target="#modalCoin">Small modal</button>
    <div class="modal fade" id="modalCoin">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">cộng / trừ coin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="resultAddCoin" class="mb-2" style="height: 50px;">

                    </div>
                    <p> Bạn đang cộng / trừ coin cho tài khoản có email <strong id="userCoin"></strong></p>
                    <div class="row">
                        <div class="col-md-3">
                            <select name="" id="calculationcoin" class="form-control">
                                <option value="plus" selected>Cộng</option>
                                <option value="sub">Trừ</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" id="coin" class="form-control" placeholder="Nhập số coin muốn cộng hoặc trừ">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-outline-success btnAddCoin">Thao tác</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" style="display: none;" class="btn btn-outline-theme me-2" id="btnLockUser" data-bs-toggle="modal" data-bs-target="#modalLockUser">Small modal</button>
    <div class="modal fade" id="modalLockUser">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">Khoá tài khoản người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="resultLockUser" class="mb-2" style="height: 50px;">

                    </div>
                    <p> Bạn đang thực hiện khoá tài khoản có email <strong id="userLock"></strong></p>
                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Thời gian khoá</p>
                            </div>
                            <div class="col-md-9">
                                <input type="date" id="lockTime" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Lí do khoá</p>
                            </div>
                            <div class="col-md-9">
                                <textarea name="" id="reason" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-outline-success btnLockUser">Khoá tài khoản</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" style="display: none;" class="btn btn-outline-theme me-2" id="btnChangepass" data-bs-toggle="modal" data-bs-target="#modalChangepass">Small modal</button>
    <div class="modal fade" id="modalChangepass">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">thay đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="resultChangepass" class="mb-2" style="height: 50px;">

                    </div>
                    <p> Bạn đang thực hiện thay đổi mật khẩu cho tài khoản có email <strong id="userPassword"></strong></p>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Mật khẩu</p>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group position-relative">
                                <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                                <span id="iconpassword" class="fa fa-eye float-right position-absolute" style="top: 12px; right:10px"></span>

                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-outline-success btnChangepass">Thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Dashboard/footer') ?>
<script>
    function validateMoney(money) {
        let reg = /^[0-9]/;
        return reg.test(money)
    }

    function formatNumber(number) {
        return new Intl.NumberFormat().format(number);
    }

    $(document).on('click', '.addMoney i', function(e) {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let count = e.target.getAttribute('data-count')
        let cash = e.target.getAttribute('data-cash')
        $('#userMoney').html(email)
        $('.btnAddMoney').attr('data-email', email)
        $('.btnAddMoney').attr('data-count', count)
        $('.btnAddMoney').attr('data-cash', cash)
        $('#btnAddMoney').click()
    })

    $('.btnAddMoney').click((e) => {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let count = e.target.getAttribute('data-count')
        let cash = e.target.getAttribute('data-cash')
        let money = $('#money').val().trim()
        let calculation = $('#calculation').val()

        if (validateMoney(money) == false) {
            $('.btnAddMoney').attr('disabled', 'disabled')
            $('.btnAddMoney').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultAddMoney').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng nhập đúng số tiền cần cộng / trừ</strong></div>')
                $('.btnAddMoney').removeAttr('disabled')
                $('.btnAddMoney').html('Thao tác')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/savemoneyuser',
                type: 'POST',
                data: {
                    email,
                    money,
                    calculation
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btn-close').click();
                        if (calculation == 'plus') {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Cộng tiền người dùng thành công</strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(3)`).html(`${formatNumber(parseInt(cash) + parseInt(money))} <i class="fa fa-plus" data-cash="${parseInt(cash) + parseInt(money)}" data-count="${count}" data-email="${email}">`)
                        } else {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Trừ tiền người dùng thành công</strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(3)`).html(`${formatNumber(parseInt(cash) - parseInt(money))} <i class="fa fa-plus" data-cash="${parseInt(cash) - parseInt(money)}" data-count="${count}" data-email="${email}">`)
                        }
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 2000);
                    } else {
                        $('.btnAddMoney').attr('disabled', 'disabled')
                        $('.btnAddMoney').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#resultAddMoney').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                            $('.btnAddMoney').removeAttr('disabled')
                            $('.btnAddMoney').html('Thao tác')
                        }, 1000);
                    }
                }

            })
        }
    })
    $(document).on('click', '.addCoin i', function(e) {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let count = e.target.getAttribute('data-count')
        let coin = e.target.getAttribute('data-coin')
        $('#userCoin').html(email)
        $('.btnAddCoin').attr('data-email', email)
        $('.btnAddCoin').attr('data-count', count)
        $('.btnAddCoin').attr('data-coin', coin)
        $('#btnAddCoin').click()
    })
    $('.btnAddCoin').click((e) => {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let coin = $('#coin').val().trim()
        let count = e.target.getAttribute('data-count')
        let coinOld = e.target.getAttribute('data-coin')
        let calculation = $('#calculationcoin').val()

        if (validateMoney(coin) == false) {
            $('.btnAddCoin').attr('disabled', 'disabled')
            $('.btnAddCoin').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultAddCoin').html('<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng nhập đúng số coin cần cộng / trừ</strong></div>')
                $('.btnAddCoin').removeAttr('disabled')
                $('.btnAddCoin').html('Thao tác')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/savecoinuser',
                type: 'POST',
                data: {
                    email,
                    coin,
                    calculation
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('.btn-close').click();
                        if (calculation == 'plus') {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Cộng coin người dùng thành công</strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(4)`).html(`${formatNumber(parseInt(coinOld) + parseInt(coin))} <i class="fa fa-plus" data-coin="${parseInt(coinOld) + parseInt(coin)}" data-count="${count}" data-email="${email}">`)
                        } else {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Trừ coin người dùng thành công</strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(4)`).html(`${formatNumber(parseInt(coinOld) - parseInt(coin))} <i class="fa fa-plus" data-coin="${parseInt(coinOld) - parseInt(coin)}" data-count="${count}" data-email="${email}">`)
                        }
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 2000);
                    } else {
                        $('.btnAddCoin').attr('disabled', 'disabled')
                        $('.btnAddCoin').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#resultAddCoin').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                            $('.btnAddCoin').removeAttr('disabled')
                            $('.btnAddCoin').html('Thao tác')
                        }, 1000);
                    }
                }

            })
        }
    })

    $(document).on('click', '.userUnlock i', function(e) {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let count = e.target.getAttribute('data-count')
        $('#userLock').html(email)
        $('.btnLockUser').attr('data-email', email)
        $('.btnLockUser').attr('data-count', count)
        $('#btnLockUser').click()
    })
    $('.btnLockUser').click((e) => {
        let email = e.target.getAttribute('data-email')
        let lockTime = $('#lockTime').val()
        let reason = $('#reason').val().trim()
        let count = e.target.getAttribute('data-count')
        let date = new Date
        let dateNow = `'${date.getFullYear()}-${(date.getMonth() + 1)}-${date.getDate()}'`
        if (lockTime == '') {
            $('.btnLockUser').attr('disabled', 'disabled')
            $('.btnLockUser').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultLockUser').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng chọn thời gian muốn khoá tài khoá tài khoản</strong></div>`)
                $('.btnLockUser').removeAttr('disabled')
                $('.btnLockUser').html('Khoá tài khoản')
            }, 1000);
        } else if (new Date(lockTime) < new Date(dateNow) || lockTime == dateNow) {
            $('.btnLockUser').attr('disabled', 'disabled')
            $('.btnLockUser').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultLockUser').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Ngày muốn khoá phải lớn hơn ngày hiện tại</strong></div>`)
                $('.btnLockUser').removeAttr('disabled')
                $('.btnLockUser').html('Khoá tài khoản')
            }, 1000);
        } else if (reason == '') {
            $('.btnLockUser').attr('disabled', 'disabled')
            $('.btnLockUser').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultLockUser').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Vui lòng điền lí do khoá</strong></div>`)
                $('.btnLockUser').removeAttr('disabled')
                $('.btnLockUser').html('Khoá tài khoản')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/lockuser',
                type: 'POST',
                data: {
                    email,
                    lockTime,
                    reason
                },
                dataType: 'json',
                success(response) {
                    console.log(response)
                    if (response.status == true) {
                        $('.btn-close').click();
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Khoá tài khoản người dùng thành công </strong></div>')
                        $(`tr:nth-child(${count}) td:nth-child(5)`).removeClass('userUnlock')
                        $(`tr:nth-child(${count}) td:nth-child(5)`).addClass('userLock')
                        $(`tr:nth-child(${count}) td:nth-child(5) i`).removeClass('fa fa-unlock text-success')
                        $(`tr:nth-child(${count}) td:nth-child(5) i`).addClass('fa fa-lock text-danger')
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 2000);
                    } else {
                        $('.btnLockUser').attr('disabled', 'disabled')
                        $('.btnLockUser').html('Đang xử lí ...')
                        setTimeout(() => {
                            $('#resultAddMoney').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                            $('.btnLockUser').removeAttr('disabled')
                            $('.btnLockUser').html('Thao tác')
                        }, 1000);
                    }
                }
            })
        }
    })

    $(document).on('click', '.userLock i', function(e) {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let count = e.target.getAttribute('data-count')
        Swal.fire({
            title: 'Mở khoá tài khoản?',
            text: "Bạn có chắc muốn mở khoá ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/requestajax/unlockuser',
                    type: 'POST',
                    data: {
                        email
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Mở khoá tài khoản người dùng thành công </strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(5)`).removeClass('userLock')
                            $(`tr:nth-child(${count}) td:nth-child(5)`).addClass('userUnlock')
                            $(`tr:nth-child(${count}) td:nth-child(5) i`).removeClass('fa fa-lock text-danger')
                            $(`tr:nth-child(${count}) td:nth-child(5) i`).addClass('fa fa-unlock text-success')
                            // setTimeout(() => {
                            //     window.location.reload()
                            // }, 2000);
                        }
                    }
                })
            }
        })
    })
    $('.btn-close').click((e) => {
        $('#resultLockUser').html('');
        $('#resultAddMoney').html('');
        $('#resultChangepass').html('')
    })
    $(document).on('click', '.action .password', function(e) {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        $('#userPassword').html(email)
        $('.btnChangepass').attr('data-email', email)
        $('#btnChangepass').click()
    })
    $('#iconpassword').click((e) => {
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text')
            $('#iconpassword').attr('class', 'fa fa-eye-slash float-right position-absolute')
        } else {
            $('#password').attr('type', 'password')
            $('#iconpassword').attr('class', 'fa fa-eye float-right position-absolute')
        }
    })

    function validatePassword(password) {
        const reg = /^[0-9]{8}$/;
        return reg.test(password);
    }
    $('.btnChangepass').click((e) => {
        e.preventDefault()
        let email = e.target.getAttribute('data-email')
        let password = $('#password').val().trim()
        if (validatePassword(password) == false) {
            $('.btnChangepass').attr('disabled', 'disabled')
            $('.btnChangepass').html('Đang xử lí ...')
            setTimeout(() => {
                $('#resultChangepass').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>Mật khẩu phải đúng 8 số</strong></div>`)
                $('.btnChangepass').removeAttr('disabled')
                $('.btnChangepass').html('Thay đổi')
            }, 1000);
        } else {
            $.ajax({
                url: '/dashboard/requestajax/changepass',
                type: 'POST',
                data: {
                    email,
                    password
                },
                dataType: 'JSON',
                success(response) {
                    if (response.status == true) {
                        $('.btn-close').click();
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thay đổi mật khẩu người dùng thành công </strong></div>')
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 2000);
                    }
                }
            })
        }
    })
    $(document).on('click', '.role', function(e) {
        e.preventDefault()
        let email = e.target.getAttribute('data-email');
        let role = e.target.getAttribute('data-role');
        let count = e.target.getAttribute('data-count')
        Swal.fire({
            title: 'Cập nhật phân quyền',
            text: `Bạn có muốn cập nhật phân quyền ${role == 'user' ? 'Quản trị viên' : 'Người dùng'} cho tài khoản ${email} không ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/requestajax/updaterole',
                    type: 'POST',
                    data: {
                        email
                    },
                    dataType: 'json',
                    success(response) {
                        if (response.status == true) {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Cập nhật phân quyền người dùng thành công </strong></div>')
                            $(`tr:nth-child(${count}) td:nth-child(6) .role`).removeClass(`${ role == 'user' ? 'text-primary' : 'text-danger' }`)
                            $(`tr:nth-child(${count}) td:nth-child(6) .role`).addClass(`${role == 'admin' ? 'text-primary' : 'text-danger' }`)
                            $(`tr:nth-child(${count}) td:nth-child(6) .role`).attr('data-role', `${role == 'admin' ? 'user' : 'admin' }`)
                            // setTimeout(() => {
                            //     window.location.reload()
                            // }, 2000);
                        }
                    }
                })
            }
        })
    })

    $('#key').keyup((e) => {
        e.preventDefault()
        let key = $('#key').val().trim()
        let model = 'Users'
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
                        <td>${response[i].email}</td>
                        <td class="addMoney">${ formatNumber(response[i].cash)} <i class="fa fa-plus" data-cash="${response[i].cash}" data-count="${j-1}" data-email="${response[i].email}"></i></td>
                        <td class="addCoin">${ response[i].coin} <i class="fa fa-plus" data-coin="${response[i].coin}" data-count="${j-1}" data-email="${response[i].email}"></td>
                        ${ '<?= $_SESSION['arrSessionUser']['email'] ?>' == response[i].email ? '<td><i class="fa fa-unlock text-secondary"></i> </td>' : response[i].status == 1 ? `<td class="userLock"><i class="fa fa-lock text-danger" data-count="${j-1}" data-email="${response[i].email}"></i></td>` :
                            `<td class="userUnlock"><i class="fa fa-unlock text-success" data-count="${j-1}" data-email="${response[i].email}"></i></td>`}
                            <td>
                            <div class="row action">
                                <div class="col-6">
                                    <i class="fas fa-key text-primary password" data-email="${response[i].email}"></i>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-user-cog ${ '<?= $_SESSION['arrSessionUser']['email'] ?>' == response[i].email ? 'text-secondary' : response[i].role == 'user' ? 'text-primary role' : 'text-danger role'} " data-count="${j-1}" data-role="${response[i].role}" data-email="${response[i].email}"></i>
                                </div>
                            </div>
                        </td>
                            </tr>`

                    }
                    $('tbody').html(data)
                }
            })
        }

    })
</script>