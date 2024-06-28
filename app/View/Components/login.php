
<!DOCTYPE html>
<html lang="en">

<head>    <link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" />     <link href="/rappasoft/laravel-livewire-tables/thirdparty.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>    Login
 | Invoices - Voov Media</title>
    <!-- Favicon -->
    <link rel="icon" href="https://invoices.infyom.com/web/media/logos/favicon.png" type="image/png">
    <meta name="csrf-token" content="YV0yLWskYfeTOoyJ9x5Rm4I0G94umv5kd2YLPtuk">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!-- General CSS Files -->
    <link rel="stylesheet" type="text/css" href="https://invoices.infyom.com/assets/css/third-party.css">
    <link rel="stylesheet" type="text/css" href="https://invoices.infyom.com/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://invoices.infyom.com/assets/css/plugins.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/page.css?id=dec99654bce5cbe529c1">
    <!-- CSS Libraries -->
        <script src="/rappasoft/laravel-livewire-tables/core.min.js"  ></script> <script src="/rappasoft/laravel-livewire-tables/thirdparty.min.js"  ></script></head>

<body>
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed authImage">
        <ul class="nav nav-pills justify-content-end cursor-pointer mt-4 me-4">
    <li class="nav-item dropdown">
        <a class="btn btn-primary w-150px mb-5 indicator m-3" data-bs-toggle="dropdown" href="javascript:void(0)"
            role="button" aria-expanded="false">English
        </a>
        <ul class="dropdown-menu w-70px">
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="ar">Arabic
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="zh">Chinese
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="en">English
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="fr">French
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="de">German
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="pt">Portuguese
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="ru">Russian
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="es">Spanish
                    </a>
                </li>
                            <li class="">
                    <a class="dropdown-item  px-5 language-select text-dark"
                        data-id="tr">Turkish
                    </a>
                </li>
                    </ul>
    </li>
</ul>
            <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="https://invoices.infyom.com" class="image mb-7 mb-sm-10 image-medium">
                <img alt="Logo" src="https://invoices.infyom.com/assets/images/infyom.png" class="img-fluid object-contain">
            </a>
        </div>
        <div class="width-540">
                                </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">Sign In</h1>
            <form method="POST" action="https://invoices.infyom.com/login">
                <input type="hidden" name="_token" value="YV0yLWskYfeTOoyJ9x5Rm4I0G94umv5kd2YLPtuk" autocomplete="off">                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        Email:<span class="required"></span>
                    </label>
                    <input name="email" type="email" class="form-control" autofocus id="email"
                        aria-describedby="emailHelp" required placeholder=" Email">
                </div>
                <div class="mb-sm-7 mb-4">
                    <div class="d-flex justify-content-between">
                        <label for="password" class="form-label">Password:<span
                                class="required"></span></label>
                                                    <a href="https://invoices.infyom.com/forgot-password" class="link-info fs-6 text-decoration-none">
                                Forgot your password?
                            </a>
                                            </div>
                    <div class="mb-3 position-relative">
                        <input name="password" type="password" class="form-control" id="password" required
                            placeholder="Password" aria-label="Password" data-toggle="password">
                        <span
                            class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                            <i class="bi bi-eye-slash-fill"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-sm-7 mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="text-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <button type="button" class="btn btn-warning w-100 mt-2" id="adminLogin" tabindex="4">
                                Admin
                            </button>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <button type="button" class="btn btn-success w-100 mt-2" id="clientLogin" tabindex="4">
                                Client
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <footer>
        <div class="container-fluid padding-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6">
                    <div class="copyright text-center text-muted">
                        All rights reserved &copy; 2024 <a
                            href="https://invoices.infyom.com" class="font-weight-bold ml-1"
                            target="_blank">InfyInvoices</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://invoices.infyom.com/messages.js"></script>
    <script src="/assets/js/auth-third-party.js?id=7b6878283f287c398645"></script>
    <script src="/assets/js/auth/auth.js?id=d2ab646ec86eda1b236f"></script>
    <script src="/assets/js/auto-fill/auto-fill-login.js?id=48c838afa4a1e56e7afc"></script>
        <script>
        let changeLanguageUrl = "https://invoices.infyom.com/set-language";
        $(document).ready(function() {
            $('.alert').delay(5000).slideUp(300);
        });
    </script>
</body>

</html>
