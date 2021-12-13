<?= $this->element('Dashboard/header') ?>

<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1"> TỔNG TIỀN NGƯỜI DÙNG NẠP VÀO TRONG HÔM NAY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= number_format($withdrawToday) ?> đ</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> <?= $withdrawToday > $withdrawYesterday ? 'Tăng' : 'Giảm' ?> <span class="text-success"><?= (($withdrawToday - $withdrawYesterday) / $withdrawYesterday) * 100 ?></span> % so với ngày hôm qua<br />
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TỔNG TIỀN NGƯỜI DÙNG NẠP VÀO TRONG TRONG THÁNG NÀY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= number_format($withdrawCurrentMonth) ?> đ</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> <?= $withdrawCurrentMonth > $withdrawLastMonth ? 'Tăng' : 'Giảm' ?> <span class="text-success"><?= (($withdrawCurrentMonth - $withdrawLastMonth) / $withdrawLastMonth) * 100 ?></span> % so với tháng trước<br />
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1"> TỔNG TIỀN NGƯỜI DÙNG RÚT RA TRONG HÔM NAY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= number_format($rechargeToday) ?> đ</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> <?= $rechargeToday > $rechargeYesterday ? 'Tăng' : 'Giảm' ?> <span class="text-success"><?= (($rechargeToday - $rechargeYesterday) / $rechargeYesterday) * 100 ?></span> % so với ngày hôm qua<br />
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TỔNG TIỀN NGƯỜI DÙNG RÚT RA TRONG TRONG THÁNG NÀY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= number_format($rechargeCurrentMonth) ?> đ</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> <?= $rechargeCurrentMonth > $rechargeLastMonth ? 'Tăng' : 'Giảm' ?> <span class="text-success"><?= (($rechargeCurrentMonth - $rechargeLastMonth) / $rechargeLastMonth) * 100 ?></span> % so với tháng trước<br />
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">NHẬT KÝ HOẠT ĐỘNG NGƯỜI DÙNG</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless mb-2px small text-nowrap">
                            <tbody>
                                <?php foreach ($logs as $item) { ?>
                                    <tr>
                                        <td>
                                            <span class="d-flex align-items-center">
                                                <i class="bi bi-circle-fill fs-6px text-theme me-2"></i>
                                                <?= $item->thread ?>
                                            </span>
                                        </td>
                                        <td><small><?= $item->created ?></small></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Dashboard/footer') ?>