<?= $this->element('Client/header') ?>
<style>
    .service i {
        font-size: 50px;
        color: purple !important;
    }

    .service span {
        font-size: 13px;
        color: purple;
    }

    .service__exm {
        background: white;
        width: 120px;
        height: 120px;
        line-height: 120px;
        border-radius: 10px;
    }

    .title {
        font-size: 15px;
        font-weight: bold;
    }

    .des {
        font-size: 13px;
        color: gray;
    }

    .blog i {
        font-size: 13px;
    }

    .cal {
        font-size: 12px;
        color: gray;
    }

    .readmore {
        font-size: 13px;
        color: purple;
    }

    ::placeholder {
        font-size: 14px;
    }

</style>
<div class="container pb-5">
    <div class="row mt-3">
        <div class="col-md-9 mx-auto">
            <div class="card p-3 mt-3 border-0 shadow" style="border-radius: 20px;">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://toigingiuvedep.vn/wp-content/uploads/2021/05/hinh-anh-avatar-de-thuong.jpg" width="100%" style="height: 100px;" class="rounded-circle" alt="">
                    </div>
                    <div class="col-md-5 col-12 mt-4">
                        <span style="font-size: 20px;" class="font-weight-bold"><?= $user->fullname ?></span> <br>
                        <span style="color: gray;font-size:15px"><?= $user->email ?> <?= $user->role == 'admin' ? '<a href="/dashboard/" ><i class="bi bi-gear"> </i></a>' : '' ?></span>
                    </div>
                    <div class="col-md-2 col-5 mt-4 text-center">
                        <span style="color: gray;font-size:13px">Số dư</span> <br>
                        <span style="font-size: 17px;"><?= number_format($user->cash) ?></span> <br>
                    </div>
                    <div class="col-md-2 col-5 mt-4 text-center">
                        <span style="color: gray;font-size:13px">VioCoin</span> <br>
                        <span style="font-size: 17px;"><?= number_format($user->coin) ?></span> <br>
                    </div>
                    <div class="col-md-1 col-2" style="margin-top: 37px;">
                        <a href="/profile"> <i class="fa fa-angle-right text-dark" style="font-size: 30px;"></i></a>
                    </div>
                </div>
            </div>

            <center class="mt-4">
                <p class="text-uppercase">danh sách dịch vụ</p>
                <div style="height: 2px; width:100px;background:purple">
                </div>
            </center>

            <div class="row service text-center mt-5">
                <div class="col-md-3 col-6">
                    <a href="/transfer">
                        <div class="mx-auto service__exm">
                            <i class="bi bi-send" style="color: #6666CC;"></i> <br>
                        </div>
                        <span>Chuyển tiền</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="/bank">
                        <div class="mx-auto service__exm">
                            <i class="bi bi-bank" style="color: #6666CC;"></i> <br>
                        </div>
                        <span>Ngân hàng</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="/recharge">
                        <div class="mx-auto service__exm">
                            <i class="bi bi-box-arrow-in-left" style="color: #6666CC;"></i> <br>
                        </div>
                        <span>Nạp tiền</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="/withdraw">
                        <div class="mx-auto service__exm">
                            <i class="bi bi-box-arrow-in-right" style="color: #6666CC;"></i> <br>
                        </div>
                        <span>Rút tiền</span>
                    </a>
                </div>
                <div class="col-md-3 mt-3 col-6">
                    <div class="mx-auto service__exm" id="attendance">
                        <i class="bi bi-calendar" style="color: #6666CC;"></i> <br>
                    </div>
                    <span>Điểm danh</span>
                </div>
                <div class="col-md-3 mt-3 col-6">
                    <a href="/voucher">
                        <div class="mx-auto service__exm">
                            <i class="bi bi-calculator" style="color: #6666CC;"></i> <br>
                        </div>
                        <span>Mã giảm giá</span>
                    </a>
                </div>
            </div>
            <center class="mt-4">
                <p class="text-uppercase">Bài viết</p>
                <div style="height: 2px; width:100px;background:purple">
                </div>
            </center>
            <a href="/blog" style="font-size: 13px;color:purple" class="float-right">Xem tất cả</a>
            <div class="row mt-3 blog">
                <?php foreach ($blogs as $item) { ?>
                    <div class="col-md-4 mxx-auto mt-2">
                        <div class="card border-0 shadow mxx-auto" style="border-radius:10px">
                            <img src="<?= $item->thumbnail ?>" width="100%" height="150px" style="object-fit: cover;border-radius:10px 10px 0 0" alt="">
                            <div class="p-3">
                                <span class="mt-3 title"><?= strlen($item->title) > 50 ? substr($item->title, 0, 50) . '...' : $item->title ?></span> <br>
                                <span class="des"><?= strlen($item->description) > 100 ? substr($item->description, 0, 100) . '...' : $item->description  ?></span> <br>
                                <span class="cal"> <i class="bi bi-calendar"></i> <?= $item->created ?></span>
                                <span class="float-right readmore"> <a style="color: purple;" href="/blog/<?= $item->slug ?>"> Xem thêm</a></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <center class="mt-5">
                <p class="text-uppercase">đăng ký để nhận thông tin mới nhất</p>
                <div style="height: 2px; width:100px;background:purple">
                </div>
            </center>
            <div class="row mt-4">
                <div class="col-md-8">
                    <input type="text" class="form-control" style="height: 50px;border:1px solid purple" placeholder="Email của bạn">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success">Đăng ký ngay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary d-none showModal" data-toggle="modal" data-target="#myModal">
    Open modal
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Điểm danh hằng ngày</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="result" style="height: 50px;">

                </div>
                <div class="card p-4 mt-3" style="font-size: 13px;">
                    <div class="row text-center">
                        <div class="col">
                            <p> Thứ 2</p>
                        </div>
                        <div class="col">
                            <p> Thứ 3</p>
                        </div>
                        <div class="col">
                            <p> Thứ 4</p>
                        </div>
                        <div class="col">
                            <p> Thứ 5</p>
                        </div>
                        <div class="col">
                            <p> Thứ 6</p>
                        </div>
                        <div class="col">
                            <p> Thứ 7</p>
                        </div>
                        <div class="col">
                            <p> Chủ nhật</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-right mr-3">
                <?php if ($attendance == null) { ?>
                    <button class="btn btnAttendance text-white">Điểm danh</button>
                <?php } else { ?>
                    <button class="btn text-white" disabled>Đã điểm danh</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->element('Client/footer') ?>
<script>
    let date = new Date();
    let day = date.getDay() - 1
    let coin = ''

    switch (day) {
        case 0:
            coin = 200
            break
        case 1:
            coin = 300
            break
        case 2:
            coin = 400
            break
        case 3:
            coin = 500
            break
        case 4:
            coin = 600
            break
        case 5:
            coin = 700
            break
        case 6:
            coin = 800
            break
    }
    $('#attendance').click((e) => {
        e.preventDefault()
        $('.showModal').click()
    })
    $('.btnAttendance').click((e) => {
        e.preventDefault()
        $.ajax({
            url: '/client/requestajaxattendance',
            type: 'POST',
            data: {

            },
            dataType: 'json',
            success(response) {
                console.log(response)
                if (response.status == true) {
                    $('.btnAttendance').attr('disabled', 'disabled')
                    $('.btnAttendance').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#result').html(`<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Thành công.Bạn được cộng ${coin} VioCoin. </strong></div>`)
                        $('.btnAttendance').html('Thành công')
                        setTimeout(() => {
                            window.location.reload()
                        }, 3000);
                    }, 1000);
                }
            }
        })
    })
</script>