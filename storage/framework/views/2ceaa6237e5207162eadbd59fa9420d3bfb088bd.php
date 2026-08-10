<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title><?php echo $__env->yieldContent('title', 'CPNC'); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/QRAUqs9.png')); ?>" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/boxicons.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/core.css')); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/theme-default.css')); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/perfect-scrollbar.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/page-misc.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select2.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select2-bootstrap-5-theme.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/daterangepicker.css')); ?>" />

    <script src="<?php echo e(asset('assets/js/helpers.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/config.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/cpnc.css')); ?>" />
    <?php echo \Livewire\Livewire::styles(); ?>

    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="<?php echo e(URL::route('dashboard')); ?>" class="app-brand-link" style="justify-content:center;width:100%;">
                        <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo" class="img-fluid" style="max-height:60px;" />
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <?php if(session()->has('role') && session()->get('role') == 'Super Admin'): ?>
                    <li class="menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::route('dashboard')); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(session()->has('role') && session()->get('role') == 'Super Admin'): ?>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Master Input</span></li>
                    <?php endif; ?>

                    <?php if(session()->has('role') && session()->get('role') == 'Super Admin'): ?>
                    <li class="menu-item <?php echo e(request()->is('klien*') || request()->is('supir*') || request()->is('pelayaran*') || request()->is('gudang*') || request()->is('lapangan*') || request()->is('kosongan*') || request()->is('biaya*') || request()->is('kemasan*') || request()->is('jenisdokumen*') || request()->is('status*') || request()->is('daftarreferensi*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-book-content"></i>
                            <div data-i18n="Master Input">Master Input</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('klien*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('klien')); ?>"><div data-i18n="Klien">Klien</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('supir*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('supir')); ?>"><div data-i18n="Supir">Supir</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('pelayaran*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('pelayaran')); ?>"><div data-i18n="Pelayaran">Pelayaran</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('gudang*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('gudang')); ?>"><div data-i18n="Gudang">Gudang</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('lapangan*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('lapangan')); ?>"><div data-i18n="Lapangan">Lapangan</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('kosongan*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('kosongan')); ?>"><div data-i18n="Kosongan">Kosongan</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('kemasan*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('kemasan')); ?>"><div data-i18n="Kemasan">Kemasan</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('biaya*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('biaya')); ?>"><div data-i18n="Biaya">Biaya</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('jenisdokumen*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('jenisdokumen')); ?>"><div data-i18n="Jenis Dokumen">Jenis Dokumen</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('status*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('status')); ?>"><div data-i18n="Status">Status</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('daftarreferensi*') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('daftarreferensi')); ?>"><div data-i18n="Daftar Referensi">Daftar Referensi</div></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(session()->has('role') && (session()->get('role') == 'Super Admin' || session()->get('role') == 'Admin')): ?>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Transaksi</span></li>
                    <li class="menu-item <?php echo e(request()->is('order*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                            <div data-i18n="Order">Order</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('order') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('order')); ?>"><div data-i18n="Semua Order">Semua Order</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('order/group/beluminvoice') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('ordersorting', ['sorting' => 'beluminvoice'])); ?>"><div data-i18n="Belum Invoice">Belum Invoice</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('order/group/sudahinvoice') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('ordersorting', ['sorting' => 'sudahinvoice'])); ?>"><div data-i18n="Sudah Invoice">Sudah Invoice</div></a></li>
                        </ul>
                    </li>
                    <li class="menu-item <?php echo e(request()->is('invoice*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Invoice">Invoice</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('invoice') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoice')); ?>"><div data-i18n="Semua Invoice">Semua Invoice</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('invoice/belumdibayar') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicesorting', ['sorting' => 'belumdibayar'])); ?>"><div data-i18n="Belum Dibayar">Belum Dibayar</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('invoice/sudahdibayar') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicesorting', ['sorting' => 'sudahdibayar'])); ?>"><div data-i18n="Sudah Dibayar">Sudah Dibayar</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('invoice/belumpengeluaran') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicesorting', ['sorting' => 'belumpengeluaran'])); ?>"><div data-i18n="Belum Pengeluaran">Belum Pengeluaran</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('invoice/sudahpengeluaran') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicesorting', ['sorting' => 'sudahpengeluaran'])); ?>"><div data-i18n="Sudah Pengeluaran">Sudah Pengeluaran</div></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(session()->has('role') && session()->get('role') == 'Super Admin'): ?>
                    <li class="menu-item <?php echo e(request()->is('pengeluaran*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::route('pengeluaran')); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-credit-card"></i>
                            <div data-i18n="Pengeluaran">Pengeluaran</div>
                        </a>
                    </li>
                    <li class="menu-item <?php echo e(request()->is('kas*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::route('kas')); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Buku Kas">Buku Kas</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
                    <li class="menu-item <?php echo e(request()->is('laporanpiutang*') || request()->is('laporanorder*') || request()->is('laporankeseluruhan*') || request()->is('laporanrugilaba') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-line-chart"></i>
                            <div data-i18n="Laporan Piutang">Laporan Piutang</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('laporanpiutang') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanpiutang')); ?>"><div data-i18n="Laporan Piutang">Laporan Piutang</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporanorder') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanorder')); ?>"><div data-i18n="Laporan Order">Laporan Order</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporankeseluruhan') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporankeseluruhan')); ?>"><div data-i18n="Laporan Keseluruhan">Laporan Keseluruhan</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporanrugilaba') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanrugilaba')); ?>"><div data-i18n="Laporan Rugi/Laba">Laporan Rugi/Laba</div></a></li>
                        </ul>
                    </li>
                    <li class="menu-item <?php echo e(request()->is('laporanbukubesar*') || request()->is('laporanneraca*') || request()->is('laporanrugilabakeuangan*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                            <div data-i18n="Laporan Keuangan">Laporan Keuangan</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('laporanbukubesar') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanbukubesar')); ?>"><div data-i18n="Laporan Buku Besar">Laporan Buku Besar</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporanneraca') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanneraca')); ?>"><div data-i18n="Laporan Neraca">Laporan Neraca</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporanrugilabakeuangan') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanrugilabakeuangan')); ?>"><div data-i18n="Laporan Rugi/Laba">Laporan Rugi/Laba</div></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(session()->has('role') && (session()->get('role') == 'Super Admin' || session()->get('role') != 'Admin')): ?>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Trucking</span></li>
                    <li class="menu-item <?php echo e(request()->is('trucking*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-truck"></i>
                            <div data-i18n="Order Trucking">Order Trucking</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('trucking') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('trucking')); ?>"><div data-i18n="Semua Order">Semua Order</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('trucking/group/belumlunas') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('truckingsorting', ['sorting' => 'belumlunas'])); ?>"><div data-i18n="Belum Lunas">Belum Lunas</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('trucking/group/sudahlunas') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('truckingsorting', ['sorting' => 'sudahlunas'])); ?>"><div data-i18n="Sudah Lunas">Sudah Lunas</div></a></li>
                        </ul>
                    </li>
                    <li class="menu-item <?php echo e(request()->is('invoicetrucking*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Invoice Trucking">Invoice Trucking</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('invoicetrucking') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicetrucking')); ?>"><div data-i18n="Semua Invoice">Semua Invoice</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('invoicetrucking/belumdibayar') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicetruckingsorting', ['sorting' => 'belumdibayar'])); ?>"><div data-i18n="Belum Dibayar">Belum Dibayar</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('invoicetrucking/sudahdibayar') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('invoicetruckingsorting', ['sorting' => 'sudahdibayar'])); ?>"><div data-i18n="Sudah Dibayar">Sudah Dibayar</div></a></li>
                        </ul>
                    </li>
                    <li class="menu-item <?php echo e(request()->is('laporanpiutangtrucking*') || request()->is('laporantagihanklien*') || request()->is('laporanrugilabatrucking*') || request()->is('laporankomisisupir*') ? 'open active' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-line-chart-down"></i>
                            <div data-i18n="Laporan Trucking">Laporan Trucking</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo e(request()->is('laporanpiutangtrucking') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanpiutangtrucking')); ?>"><div data-i18n="Laporan Piutang">Laporan Piutang</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporantagihanklien') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporantagihanklien')); ?>"><div data-i18n="Laporan Tagihan Klien">Laporan Tagihan Klien</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporanrugilabatrucking') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporanrugilabatrucking')); ?>"><div data-i18n="Laporan Rugi/Laba">Laporan Rugi/Laba</div></a></li>
                            <li class="menu-item <?php echo e(request()->is('laporankomisisupir') ? 'active' : ''); ?>"><a class="menu-link" href="<?php echo e(URL::route('laporankomisisupir')); ?>"><div data-i18n="Laporan Komisi Supir">Laporan Komisi Supir</div></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </aside>
            <!-- / Menu -->

            <div class="layout-page">

                <!-- Navbar -->
                <nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0);" onclick="if(window.Helpers){window.Helpers.toggleCollapsed();}">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">
                        <span class="d-none d-xl-block text-muted small me-auto">
                            Welcome back, <strong><?php echo e(session('nama', 'User')); ?></strong>!
                        </span>
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?php echo e(asset('assets/images/img.png')); ?>" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <div class="fw-semibold"><?php echo e(session('nama', 'User')); ?></div>
                                            <small><?php echo e(session('role', '')); ?></small>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(URL::route('logout')); ?>">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <?php if (! empty(trim($__env->yieldContent('breadcumbs')))): ?>
                            <?php echo $__env->make('layout.partials.page_header', ['raw' => trim($__env->yieldContent('breadcumbs'))], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>

                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">PT. Cahyapraja Nusaceria</div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="<?php echo e(asset('assets/js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/masonry.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/menu.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/daterangepicker.min.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            if ($.fn.select2 && $.fn.select2.defaults) {
                $.fn.select2.defaults.set('theme', 'bootstrap-5');
            }
            $('select.form-control:not(.select2-hidden-accessible)').select2();
        });
    </script>

    <?php echo \Livewire\Livewire::scripts(); ?>

    <?php echo $__env->yieldContent('jscript'); ?>
</body>
</html>
<?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/layout/main_layout.blade.php ENDPATH**/ ?>