<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    
    <!-- Admin Title Section - Diubah strukturnya -->
    <div class="navbar-brand app-brand demo d-flex align-items-center">
        <div>
            <h1 class="admin-title mb-0 d-inline-block me-2">Admin</h1>
            <p class="admin-subtitle mb-0 d-inline-block">Lihat Semua Informasi di sini</p>
        </div>
    </div>
    
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
                    {{-- <span class="admin-text me-2">ADMIN</span> --}}
                    <div class="avatar">
                        <span class="avatar-initial rounded-circle bg-primary">
                            <i class="bx bx-user fs-4"></i>
                        </span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <span class="avatar-initial rounded-circle bg-primary">
                                            <i class="bx bx-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">Admin</span>
                                    <small class="text-muted">Administrator</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bx bx-power-off me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

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

    /* Navbar styling */
    .bg-navbar-theme {
        background-color: #fff !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 0.75rem 1.5rem;
    }

    .layout-navbar {
        height: 70px;
    }

    /* Admin title styling - Diperbarui */
    .admin-title {
        color: #333;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.2;
        display: inline-block;
        vertical-align: middle;
    }

    .admin-subtitle {
        color: #888;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.2;
        display: inline-block;
        vertical-align: middle;
    }

    .app-brand {
        display: flex;
        align-items: center;
        padding: 0;
    }

    /* Admin text on right side */
    .admin-text {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    /* Avatar styling */
    .avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        transition: all 0.3s ease;
    }

    .avatar-initial {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background-color: var(--primary-color) !important;
    }

    .avatar-initial:hover {
        background-color: var(--primary-darker) !important;
    }

    /* Dropdown styling */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        padding: 0.5rem 0;
        min-width: 14rem;
    }

    .dropdown-item {
        font-size: 14px;
        padding: 0.65rem 1.5rem;
        color: var(--text-color);
        transition: all 0.3s ease;
    }

    .dropdown-item:hover, .dropdown-item:focus {
        background-color: var(--primary-hover);
        color: var(--primary-color);
    }

    .dropdown-item:hover i, .dropdown-item:focus i {
        color: var(--primary-color);
    }

    .dropdown-divider {
        margin: 0.5rem 0;
        border-color: rgba(0, 0, 0, 0.05);
    }

    /* Button styling */
    .dropdown-item.btn, .dropdown-item[type="submit"] {
        text-align: left;
        background: transparent;
        border: none;
        width: 100%;
        cursor: pointer;
    }

    /* Icon styling */
    .bx {
        font-size: 1.15rem;
    }

    .fs-4 {
        font-size: 1.25rem !important;
    }

    /* Mobile menu toggle */
    .layout-menu-toggle {
        background-color: transparent;
    }

    .layout-menu-toggle i {
        color: var(--text-color);
    }

    .layout-menu-toggle:hover i {
        color: var(--primary-color);
    }

    /* Responsive adjustments */
    @media (max-width: 1199.98px) {
        .admin-subtitle {
            display: none;
        }
    }

    @media (max-width: 767.98px) {
        .admin-title {
            font-size: 18px;
        }
    }
</style>