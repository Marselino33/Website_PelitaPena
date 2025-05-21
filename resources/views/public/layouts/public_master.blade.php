<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <base href="/public">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .phone {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .phone img {
            max-width: 100%;
            height: auto;
            transition: opacity 0.5s ease-in-out;
        }

        .steps {
            flex: 1;
            padding: 20px;
        }

        .steps h2 {
            margin-bottom: 20px;
            font-size: 2em;
        }

        .steps p {
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .steps ol {
            list-style: none;
            padding: 0;
        }

        .steps li {
            margin-bottom: 15px;
            cursor: pointer;
            transition: background 0.3s ease;
            padding: 15px;
            border-radius: 10px;
            font-size: 1.2em;
        }

        .steps li:hover {
            background: #f1f1f1;
        }

        .steps li.active {
            background: #f1f1f1;
            border-left: 10px solid #7FBC8C;
            padding-left: 11px;
        }
    </style>

</head>

<body>
    @include('public.layouts.header')
    @yield('content')
    @include('public.layouts.footer')

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/gijgo.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blue: {
                            400: '#60a5fa',
                            500: '#3b82f6',
                        },
                        pink: {
                            100: '#fce7f3',
                            500: '#7FBC8C',
                            // aku perbaharui hijaunya yaa guys
                        }
                    }
                }
            }
        }
    </script>
    <script>
        let currentIndex = 0;
        const steps = document.querySelectorAll('#stepsList li');
        const phoneImage = document.getElementById('phoneImage');

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle('active', i === index);
            });
            phoneImage.style.opacity = 0;
            setTimeout(() => {
                phoneImage.src = steps[index].getAttribute('data-image');
                phoneImage.style.opacity = 1;
            }, 500);
        }

        steps.forEach((step, index) => {
            step.addEventListener('click', () => {
                clearInterval(autoSwitch);
                currentIndex = index;
                showStep(index);
            });
        });

        const autoSwitch = setInterval(() => {
            currentIndex = (currentIndex + 1) % steps.length;
            showStep(currentIndex);
        }, 7000);

        showStep(currentIndex);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
