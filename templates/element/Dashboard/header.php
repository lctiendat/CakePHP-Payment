<?php
$this->disableAutoLayout();
header("xhr.setRequestHeader('Content-Type', 'text/plain')")
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Bảng Điều Khiển - VioPay</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />

	<link href="https://seantheme.com/hud/assets/css/vendor.min.css" rel="stylesheet" />
	<link href="https://seantheme.com/hud/assets/css/app.min.css" rel="stylesheet" />
	<link href="https://seantheme.com/hud/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<style>
		ul.pagination li {
			position: relative;
			float: left;
			padding: 6px 12px;
			margin-left: -1px;
			line-height: 1.428571429;
			text-decoration: none;
			border: 1px solid #ddd;
		}

		ul.pagination li.active {
			position: relative;
			float: left;
			padding: 6px 12px;
			margin-left: -1px;
			line-height: 1.428571429;
			text-decoration: none;
			border: 1px solid #ddd;
		}
		textarea:focus,
        textarea.form-control:focus,
        input.form-control:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=number]:focus,
        button,
        [type=text].form-control:focus,
        [type=password].form-control:focus,
        [type=email].form-control:focus,
        [type=tel].form-control:focus,
        [contenteditable].form-control:focus {
            /* box-shadow: inset 0 -1px 0 #ddd; */
            outline: none;
            box-shadow: none;
        }
	</style>
</head>

<body>

	<div id="app" class="app">

		<div id="header" class="app-header">

			<div class="desktop-toggler">
				<button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed" data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</button>
			</div>


			<div class="mobile-toggler">
				<button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled" data-toggle-target=".app">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</button>
			</div>


			<div class="brand">
				<a href="#" class="brand-logo">
					<span class="brand-img">
						<span class="brand-img-text text-theme">H</span>
					</span>
					<span class="brand-text">VIOPAY ADMIN</span>
				</a>
			</div>


			<div class="menu">
				<div class="menu-item dropdown">
					<a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app" class="menu-link">
						<div class="menu-icon"><i class="bi bi-search nav-icon"></i></div>
					</a>
				</div>
				<div class="menu-item dropdown dropdown-mobile-full">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
						<div class="menu-icon"><i class="bi bi-grid-3x3-gap nav-icon"></i></div>
					</a>
					<div class="dropdown-menu fade dropdown-menu-end w-300px text-center p-0 mt-1">
						<div class="row row-grid gx-0">
							<div class="col-4">
								<a href="#" class="dropdown-item text-decoration-none p-3 bg-none">
									<div class="position-relative">
										<i class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>
										<i class="bi bi-envelope h2 opacity-5 d-block my-1"></i>
									</div>
									<div class="fw-500 fs-10px text-white">INBOX</div>
								</a>
							</div>
							<div class="col-4">
								<a href="#" class="dropdown-item text-decoration-none p-3 bg-none">
									<div><i class="bi bi-hdd-network h2 opacity-5 d-block my-1"></i></div>
									<div class="fw-500 fs-10px text-white">DISK DRIVE</div>
								</a>
							</div>
							<div class="col-4">
								<a href="#" class="dropdown-item text-decoration-none p-3 bg-none">
									<div><i class="bi bi-calendar4 h2 opacity-5 d-block my-1"></i></div>
									<div class="fw-500 fs-10px text-white">CALENDAR</div>
								</a>
							</div>
						</div>
						<div class="row row-grid gx-0">
							<div class="col-4">
								<a href="#" class="dropdown-item text-decoration-none p-3 bg-none">
									<div><i class="bi bi-terminal h2 opacity-5 d-block my-1"></i></div>
									<div class="fw-500 fs-10px text-white">TERMINAL</div>
								</a>
							</div>
							<div class="col-4">
								<a href="#" class="dropdown-item text-decoration-none p-3 bg-none">
									<div class="position-relative">
										<i class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>
										<i class="bi bi-sliders h2 opacity-5 d-block my-1"></i>
									</div>
									<div class="fw-500 fs-10px text-white">SETTINGS</div>
								</a>
							</div>
							<div class="col-4">
								<a href="#" class="dropdown-item text-decoration-none p-3 bg-none">
									<div><i class="bi bi-collection-play h2 opacity-5 d-block my-1"></i></div>
									<div class="fw-500 fs-10px text-white">LIBRARY</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="menu-item dropdown dropdown-mobile-full">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
						<div class="menu-icon"><i class="bi bi-bell nav-icon"></i></div>
						<div class="menu-badge bg-theme"></div>
					</a>
					<div class="dropdown-menu dropdown-menu-end mt-1 w-300px fs-11px pt-1">
						<h6 class="dropdown-header fs-10px mb-1">NOTIFICATIONS</h6>
						<div class="dropdown-divider mt-1"></div>
						<a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">
							<div class="fs-20px">
								<i class="bi bi-bag text-theme"></i>
							</div>
							<div class="flex-1 flex-wrap ps-3">
								<div class="mb-1 text-white">NEW ORDER RECEIVED ($1,299)</div>
								<div class="small">JUST NOW</div>
							</div>
							<div class="ps-2 fs-16px">
								<i class="bi bi-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">
							<div class="fs-20px w-20px">
								<i class="bi bi-person-circle text-theme"></i>
							</div>
							<div class="flex-1 flex-wrap ps-3">
								<div class="mb-1 text-white">3 NEW ACCOUNT CREATED</div>
								<div class="small">2 MINUTES AGO</div>
							</div>
							<div class="ps-2 fs-16px">
								<i class="bi bi-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">
							<div class="fs-20px w-20px">
								<i class="bi bi-gear text-theme"></i>
							</div>
							<div class="flex-1 flex-wrap ps-3">
								<div class="mb-1 text-white">SETUP COMPLETED</div>
								<div class="small">3 MINUTES AGO</div>
							</div>
							<div class="ps-2 fs-16px">
								<i class="bi bi-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">
							<div class="fs-20px w-20px">
								<i class="bi bi-grid text-theme"></i>
							</div>
							<div class="flex-1 flex-wrap ps-3">
								<div class="mb-1 text-white">WIDGET INSTALLATION DONE</div>
								<div class="small">5 MINUTES AGO</div>
							</div>
							<div class="ps-2 fs-16px">
								<i class="bi bi-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap">
							<div class="fs-20px w-20px">
								<i class="bi bi-credit-card text-theme"></i>
							</div>
							<div class="flex-1 flex-wrap ps-3">
								<div class="mb-1 text-white">PAYMENT METHOD ENABLED</div>
								<div class="small">10 MINUTES AGO</div>
							</div>
							<div class="ps-2 fs-16px">
								<i class="bi bi-chevron-right"></i>
							</div>
						</a>
						<hr class="bg-white-transparent-5 mb-0 mt-2" />
						<div class="py-10px mb-n2 text-center">
							<a href="#" class="text-decoration-none fw-bold">SEE ALL</a>
						</div>
					</div>
				</div>
				<div class="menu-item dropdown dropdown-mobile-full">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
						<div class="menu-img online">
							<img src="/dashboard/assets/img/user/profile.jpg" height="60px" />
						</div>
						<div class="menu-text d-sm-block d-none"><span class="__cf_email__"><?= $_SESSION['arrSessionUser']['email'] ?></span></div>
					</a>
					<div class="dropdown-menu dropdown-menu-end me-lg-3 fs-11px mt-1">
						<a class="dropdown-item d-flex align-items-center" href="#">PROFILE <i class="bi bi-person-circle ms-auto text-theme fs-16px my-n1"></i></a>
						<a class="dropdown-item d-flex align-items-center" href="#">INBOX <i class="bi bi-envelope ms-auto text-theme fs-16px my-n1"></i></a>
						<a class="dropdown-item d-flex align-items-center" href="#">CALENDAR <i class="bi bi-calendar ms-auto text-theme fs-16px my-n1"></i></a>
						<a class="dropdown-item d-flex align-items-center" href="#">SETTINGS <i class="bi bi-gear ms-auto text-theme fs-16px my-n1"></i></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item d-flex align-items-center" href="/client/logout">LOGOUT <i class="bi bi-toggle-off ms-auto text-theme fs-16px my-n1"></i></a>
					</div>
				</div>
			</div>


			<form class="menu-search" method="POST" name="header_search_form">
				<div class="menu-search-container">
					<div class="menu-search-icon"><i class="bi bi-search"></i></div>
					<div class="menu-search-input">
						<input type="text" class="form-control form-control-lg" placeholder="Search menu..." />
					</div>
					<div class="menu-search-icon">
						<a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app"><i class="bi bi-x-lg"></i></a>
					</div>
				</div>
			</form>

		</div>


		<div id="sidebar" class="app-sidebar">

			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

				<div class="menu">
					<div class="menu-header">Navigation</div>
					<div class="menu-item active">
						<a href="/dashboard/" class="menu-link">
							<span class="menu-icon"><i class="bi bi-cpu"></i></span>
							<span class="menu-text">Dashboard</span>
						</a>
					</div>
					<div class="menu-header">Quản lý</div>
					<div class="menu-item">
						<a href="/dashboard/banks" class="menu-link">
							<span class="menu-icon"><i class="fa fa-university"></i></span>
							<span class="menu-text">Ngân hàng</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="/dashboard/users" class="menu-link">
							<span class="menu-icon"><i class="fa fa-user"></i></span>
							<span class="menu-text">Người dùng</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="/dashboard/withdrawalorder" class="menu-link">
							<span class="menu-icon"><i class="fa fa-money-check"></i></span>
							<span class="menu-text">Lệnh rút tiền</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="/dashboard/rechargeorder" class="menu-link">
							<span class="menu-icon"><i class="fa fa-money-check"></i></span>
							<span class="menu-text">Lệnh nạp tiền</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="/dashboard/vouchers" class="menu-link">
							<span class="menu-icon"><i class="fa fa-percent"></i></span>
							<span class="menu-text">Mã giảm giá</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="/dashboard/blogs" class="menu-link">
							<span class="menu-icon"><i class="fa fa-blog"></i></span>
							<span class="menu-text">Bài viết</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="/dashboard/transitionhistory" class="menu-link">
							<span class="menu-icon"><i class="fa fa-history"></i></span>
							<span class="menu-text">Lịch sử chuyển tiền</span>
						</a>
					</div>
					<!-- <div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="bi bi-controller"></i></span>
							<span class="menu-text">Ngân hàng</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="/dashboard/banks/list" class="menu-link">
									<span class="menu-text">Danh sách ngân hàng</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="/dashboard/banks/add" class="menu-link">
									<span class="menu-text">Thêm ngân hàng</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="bi bi-controller"></i></span>
							<span class="menu-text">Người dùng</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="ui_bootstrap.html" class="menu-link">
									<span class="menu-text">Danh sách người dùng</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="ui_buttons.html" class="menu-link">
									<span class="menu-text">Thêm ngân hàng</span>
								</a>
							</div>
						</div>
					</div> -->
				</div>
			</div>

		</div>