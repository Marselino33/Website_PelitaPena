<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <base href="/public">
    <title>Pelita Pena – Lupa Password</title>
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="asset-admin/assets/img/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset-admin/assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="asset-admin/assets/css/demo.css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/css/pages/page-auth.css">
    <script src="asset-admin/assets/vendor/js/helpers.js"></script>
    <script src="asset-admin/assets/js/config.js"></script>
    <style>
        .login-container {
            display: flex;
            min-height: 100vh;
        }
        
        .login-sidebar {
            width: 40%;
            background-color: #6BAADF;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-sidebar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 0;
        }
        
        .login-sidebar::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 0;
        }
        
        .logo-container {
            z-index: 1;
            display: flex;
            align-items: center;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            margin-left: 0.5rem;
        }
        
        .admin-text {
            z-index: 1;
            text-align: center;
        }
        
        .admin-text h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .admin-text p {
            font-size: 1rem;
        }
        
        .login-content {
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-form-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }
        
        .login-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .login-subtitle {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        .input-with-icon {
            padding-left: 40px;
            position: relative;
        }
        
        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background-color: #6BAADF;
            border: none;
            border-radius: 0.375rem;
            color: white;
            font-weight: 500;
            margin-top: 1rem;
        }
        
        .btn-login:hover {
            background-color: #5a91c0;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: #6BAADF;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }
        
        .alert ul {
            margin: 0;
            padding-left: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-sidebar {
                width: 100%;
                height: 200px;
                padding: 1.5rem;
            }
            
            .login-content {
                width: 100%;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Sidebar -->
        <div class="login-sidebar">
            <div class="logo-container">
                <div class="logo-icon">
                    <img src="assets/img/logo1.png" alt="Pelita Pena Logo" width="30" height="30">
                </div>
                <span class="logo-text">Pelita Pena</span>
            </div>
            
            <div class="admin-text">
                <h2 style="color:#ffffff">Admin</h2>
                <p>Kelola dengan Bijak, Kendali di Tangan Anda</p>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="login-content">
            <div class="login-form-container">
                <h1 class="login-title">Lupa Password</h1>
                <p class="login-subtitle">Masukkan email admin Anda untuk mendapatkan link reset password</p>
                
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('password.check') }}" method="POST">
                    @csrf
                    <div class="mb-3 position-relative">
                        <i class="bx bx-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control input-with-icon" 
                            placeholder="Email"
                            value="{{ old('email') }}" 
                            required
                            autocomplete="email"
                        >
                    </div>
                    
                    <button type="submit" class="btn btn-login d-grid w-100">
                        Lanjutkan
                    </button>
                </form>
                
                <a href="{{ route('login') }}" class="back-link">
                    <i class="bx bx-arrow-back" style="margin-right: 4px;"></i> Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
    
    <script src="asset-admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="asset-admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="asset-admin/assets/vendor/js/bootstrap.js"></script>
    <script src="asset-admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="asset-admin/assets/vendor/js/menu.js"></script>
    <script src="asset-admin/assets/js/main.js"></script>
</body>
</html>
