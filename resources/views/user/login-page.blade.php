<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Page de connexion</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon-onfp.png') }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section class="section login min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center py-1">
                                        <a href="{{ url('/login-page') }}"
                                            class="logo d-flex align-items-center w-auto">
                                            <span class="d-none d-lg-block">ONFP</span>
                                        </a>
                                    </div>

                                    <!-- Slides with captions -->
                                    @include('user.slide-image')
                                    <!-- End Slides with captions -->

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            {{-- <div class="d-flex justify-content-center py-4">
                                <a href="{{ url('/login-page') }}" class="logo d-flex align-items-center w-auto">
                                    <span class="d-none d-lg-block">ONFP</span>
                                </a>
                            </div> --}}
                            <!-- End Logo -->

                            <div class="card">

                                <div class="card-body">
                                    @if ($message = Session::get('status'))
                                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                            role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="pt-0 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Connectez-vous</h5>
                                        {{-- <p class="text-center small">Entrez votre nom d'utilisateur et votre mot de
                                            passe pour vous connecter</p> --}}
                                    </div>
                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                        action="{{ route('login') }}">
                                        @csrf

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" required placeholder="Votre adresse e-mail"
                                                    value="{{ old('email') }}" autofocus>
                                                <div class="invalid-feedback">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Mot de passe</label>
                                            <input type="password" name="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                id="password" required placeholder="Votre mot de passe">
                                            <div class="invalid-feedback">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Souviens-toi de
                                                    moi</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Se connecter</button>
                                        </div>
                                        <div class="col-12">
                                            @if (Route::has('password.request'))
                                                <p class="small mb-0">Mot de passe oublié !<a
                                                        href="{{ route('password.request') }}"> Réinitialiser</a></p>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Vous n'avez pas de compte ?<a
                                                    href="{{ url('/register-page') }}"> Créer un compte</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Conçu par <a href="https://www.onfp.sn/" target="_blank">Lamine BADJI</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
            @include('sweetalert::alert')
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
