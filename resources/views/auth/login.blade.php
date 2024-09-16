<!DOCTYPE html>
<html lang="en" class="default">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project management | Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
    <!-- UI Icon -->
    <link rel="stylesheet" href="{{ asset('assets/icons/uicons-regular-rounded/css/uicons-regular-rounded.css') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/variables/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>

    <div class="ol-card rounded-0 vh-100">
        <div class="ol-card-body">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-12">
                        <div class="ol2-logo-area">
                            <a href="#">
                                <img src="{{ asset('assets/images/workplace.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="login-form-wrap">
                            <form class="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <h1 class="title fs-36px mb-20px">{{ get_phrase('Log in') }}</h1>
                                <p class="sub-title3 fs-15px mb-30px">
                                    {{ get_phrase('See your growth and get consulting support!') }}
                                </p>
                                <div class="mb-20px">
                                    <label for="email"
                                        class="form-label ol2-form-label mb-3">{{ get_phrase('Email') }}</label>
                                    <input type="email" class="form-control ol2-form-control" id="email"
                                        name="email" placeholder="Your email here">
                                </div>
                                <div class="mb-3">
                                    <label for="password"
                                        class="form-label ol2-form-label mb-3">{{ get_phrase('Password') }}</label>
                                    <div class="password-input-wrap">
                                        <input type="password" class="form-control ol2-form-control password-field"
                                            id="password" name="password" placeholder="Min 8 character">
                                        <div class="password-toggle-icons">
                                            <span class="password-toggle-icon fs-5" toggle=".password-field"><i
                                                    class="fi fi-rr-eye-crossed"></i></span>
                                            <span class="password-toggle-icon fs-5 d-none password-toggle-icon-show"
                                                toggle=".password-field"><i class="fi fi-rr-eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-30px d-flex align-items-center gap-2 flex-wrap justify-content-between">
                                    <div class="form-check form-check-checkbox2">
                                        <input class="form-check-input form-check-input-checkbox2" type="checkbox"
                                            value="" id="flexCheckDefault">
                                        <label class="form-check-label form-check-label-checkbox2"
                                            for="flexCheckDefault">
                                            {{ get_phrase('Remember me') }}
                                        </label>
                                    </div>
                                    <a href="#"
                                        class="sub-title3 fw-medium fs-15px link-text">{{ get_phrase('Forget
                                                                                Password?') }}</a>
                                </div>
                                <button type="submit"
                                    class="btn ol2-btn-primary w-100 mb-3">{{ get_phrase('Log in') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
