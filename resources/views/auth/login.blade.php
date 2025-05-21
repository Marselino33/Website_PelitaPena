<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <base href="/public">
    <title>Pelita Pena – Admin Login</title>
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
        
        .form-password-toggle .input-group-text {
            background-color: transparent;
            border-left: none;
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
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #6c757d;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        
        .divider span {
            padding: 0 1rem;
        }
        
        .password-hint {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        .forgot-password {
            color: #dc3545;
            text-decoration: none;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-sidebar">
            <div class="logo-container">
                <div class="logo-icon">
                    <img src="assets/img/logo1.png" alt="Minus Icon" width="50" height="50">
                </div>
                <span class="logo-text">Pelita Pena</span>
            </div>
            
            <div class="admin-text">
                <h2 style="color:#ffffff">Admin</h2>
                <p>Kelola dengan Bijak, Kendali di Tangan Anda</p>
            </div>
        </div>
        
        <div class="login-content"> 
            <div class="login-form-container">
                <h1 class="login-title">Login Untuk Masuk</h1>
                <p class="login-subtitle">Tolong isi detail informasi untuk masuk ke akun anda</p>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>Email,Username,nomor telepon atau password anda salah</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div id="error-container" class="alert alert-danger" style="display: none;"></div>
                
                <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="position-relative">
                            <i class="bx bx-user input-icon"></i>
                            <input type="text" class="form-control input-with-icon" id="credential" name="credential" placeholder="Username" autofocus>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <a href="{{ route('password.request') }}" class="forgot-password">
  <small>Lupa Password?</small>
</a>


                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                <i class="bx bx-lock-alt"></i>
                            </span>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" aria-describedby="password">
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        <div class="password-hint">Your password must have at least 8 characters</div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me">
                            <label class="form-check-label" for="remember-me">Ingat akun</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <button class="btn btn-login d-grid w-100" type="submit">Login</button>
                    </div>
                    
                    <div class="divider">
                        <span>Or sign up with</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="asset-admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="asset-admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="asset-admin/assets/vendor/js/bootstrap.js"></script>
    <script src="asset-admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="asset-admin/assets/vendor/js/menu.js"></script>
    <script src="asset-admin/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>