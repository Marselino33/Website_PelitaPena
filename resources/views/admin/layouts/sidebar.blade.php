<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- Replace this with your new logo image -->
                <img src="{{ asset('assets/img/logo/new_logo3.png') }}" alt="DPMDPPA Logo" width="40">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">DPMDPPA</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item {{ \Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('laporan.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-clipboard"></i>
                <div class="text-truncate" data-i18n="Dashboards">Laporan</div>
            </a>
            <ul class="menu-sub">
         
    <li class="menu-item {{ Route::is('laporan.daftar') ? 'active' : '' }}">
        <a href="{{ route('laporan.daftar') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-clipboard"></i>
            <div data-i18n="Daftar Laporan">Daftar Laporan</div>
        </a>
    </li>
    <li class="menu-item {{ Route::is('laporan.masuk') || Route::is('laporan.masuk-detail') ? 'active' : '' }}">
        <a href="{{ route('laporan.masuk') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-envelope"></i>
            <div data-i18n="Laporan Masuk">Laporan Masuk</div>
        </a>
    </li>
                <li class="menu-item {{ \Route::is('laporan.dilihat') || \Route::is('laporan.detail-dilihat') ? 'active' : '' }}">
                    <a href="{{ route('laporan.dilihat') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-show"></i>
                        <div data-i18n="Analytics">Sudah Dilihat</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('laporan.diproses') || \Route::is('laporan.detail-diproses') ? 'active' : '' }}">
                    <a href="{{ route('laporan.diproses') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-loader-circle"></i>
                        <div data-i18n="Analytics">Laporan Diproses</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('laporan.dibatalkan') || \Route::is('laporan.detail-dibatalkan') ? 'active' : '' }}">
                    <a href="{{ route('laporan.dibatalkan') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-x-circle"></i>
                        <div data-i18n="Analytics">Laporan Dibatalkan</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('laporan.selesai') || \Route::is('laporan.detail-selesai')  ? 'active' : '' }}">
                    <a href="{{ route('laporan.selesai') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-check-circle"></i>
                        <div data-i18n="Analytics">Laporan Selesai</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ \Route::is('janji-temu.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div class="text-truncate" data-i18n="Dashboards">Booking Janji Temu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Route::is('janji-temu.index') || \Route::is('janji-temu.detail') ? 'active' : '' }}">
                    <a href="{{ route('janji-temu.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-time"></i>
                        <div data-i18n="Analytics">Belum Disetujui</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('janji-temu.disetujui') || \Route::is('janji-temu.detail-disetujui') ? 'active' : '' }}">
                    <a href="{{ route('janji-temu.disetujui') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-check"></i>
                        <div data-i18n="Analytics">Disetujui</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('janji-temu.ditolak') || \Route::is('janji-temu.detail-ditolak') ? 'active' : '' }}">
                    <a href="{{ route('janji-temu.ditolak') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-x"></i>
                        <div data-i18n="Analytics">Ditolak</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('janji-temu.dibatalkan') || \Route::is('janji-temu.detail-dibatalkan') ? 'active' : '' }}">
                    <a href="{{ route('janji-temu.dibatalkan') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar-x"></i>
                        <div data-i18n="Analytics">Dibatalkan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ \Route::is('category-violence.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div class="text-truncate" data-i18n="Dashboards">Kategory Kekerasan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Route::is('category-violence.index') || \Route::is('category-violence.edit') ? 'active' : '' }}">
                    <a href="{{ route('category-violence.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-ul"></i>
                        <div data-i18n="Analytics">Kategori kekerasan</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('category-violence.create') ? 'active' : '' }}">
                    <a href="{{ route('category-violence.create') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        <div data-i18n="Analytics">Buat Kategori</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ \Route::is('content.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div class="text-truncate" data-i18n="Dashboards">List Content</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Route::is('content.index') || \Route::is('content.show') || \Route::is('content.edit') ? 'active' : '' }}">
                    <a href="{{ route('content.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-file-find"></i>
                        <div data-i18n="Analytics">Content</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('content.create') ? 'active' : '' }}">
                    <a href="{{ route('content.create') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        <div data-i18n="Analytics">Buat Content</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Tambahan menu Donasi -->
        <li class="menu-item {{ \Route::is('admin.pages.donasi.index') ? 'active' : '' }}">
            <a href="{{ route('admin.pages.donasi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                <div data-i18n="Donasi">Donasi</div>
            </a>
        </li>

        <li class="menu-item {{ \Route::is('event.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div class="text-truncate" data-i18n="Dashboards">Event DPMDPPA</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Route::is('event.index') || \Route::is('event.edit') ? 'active' : '' }}">
                    <a href="{{ route('event.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar"></i>
                        <div data-i18n="Analytics">List Event</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('event.create') ? 'active' : '' }}">
                    <a href="{{ route('event.create') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar-plus"></i>
                        <div data-i18n="Analytics">Buat Event</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

<style>
    /* Updated color scheme using blue tones */
    :root {
        --primary-color: #6c9aff;
        --primary-darker: #5a8eff;
        --primary-hover: rgba(108, 154, 255, 0.1);
        --primary-active: rgba(108, 154, 255, 0.16);
        --text-color: #566a7f;
        --active-text-color: #5a8eff;
    }

    /* Sidebar base styling */
    .bg-menu-theme {
        background-color: #fff !important;
        color: var(--text-color);
    }

    /* Brand styling */
    .app-brand {
        padding: 0 1.5rem;
        height: 64px;
        display: flex;
        align-items: center;
    }

    .app-brand-text {
        color: var(--primary-color) !important;
        font-size: 16px;
    }

    /* Menu items styling */
    .menu-inner {
        padding: 0.625rem 0;
    }

    .menu-inner > .menu-item > .menu-link {
        margin: 0 1rem;
    }

    .menu-item.active > .menu-link {
        color: var(--primary-darker) !important;
        background-color: var(--primary-active) !important;
    }

    .menu-item.active > .menu-link .menu-icon {
        color: var(--primary-darker) !important;
    }

    .menu-link {
        transition: all 0.3s ease;
        color: var(--text-color);
        font-size: 14px;
    }

    .menu-link:hover {
        color: var(--primary-color) !important;
        background-color: var(--primary-hover) !important;
    }

    .menu-link:hover .menu-icon {
        color: var(--primary-color) !important;
    }

    .menu-icon {
        color: var(--text-color);
        transition: all 0.3s ease;
        font-size: 16px;
    }

    /* Submenu styling */
    .menu-sub {
        background-color: transparent !important;
    }

    .menu-sub .menu-link {
        padding-left: 3.5rem !important;
        font-size: 13px;
    }

    .menu-sub .menu-item.active > .menu-link {
        color: var(--primary-darker) !important;
        background-color: var(--primary-active) !important;
    }

    /* Menu toggle animation */
    .menu-toggle::after {
        border-color: var(--text-color) !important;
        transition: all 0.3s ease;
    }

    .menu-toggle:hover::after {
        border-color: var(--primary-color) !important;
    }

    .menu-item.open > .menu-toggle::after {
        transform: rotate(90deg) !important;
        border-color: var(--primary-color) !important;
    }

    /* Shadow effect */
    .menu-inner-shadow {
        background: linear-gradient(var(--primary-color) 0%, rgba(108, 154, 255, 0) 100%);
        opacity: 0.1;
    }
</style>
