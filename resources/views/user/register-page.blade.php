<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Page inscription</title>
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
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="{{ url('/register-page') }}" class="logo d-flex align-items-center w-auto">
                                        <span class="d-none d-lg-block">ONFP</span>
                                    </a>
                                </div>

                                <!-- Slides with captions -->
                                @include('user.slide-image')
                                <!-- End Slides with captions -->

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-body">

                                <div class="pt-0 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Créer un compte personnel</h5>
                                    {{--  <p class="text-center small">Entrez vos informations personnelles pour créer un
                                    compte</p> --}}
                                </div>

                                <form class="row g-3 needs-validation" novalidate method="POST"
                                    action="{{ route('register') }}">
                                    @csrf
                                    <!-- Prénom -->
                                    {{-- <div class="col-6">
                                        <label for="prenom" class="form-label">Prénom</label>
                                        <input type="text" name="prenom"
                                            class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                            id="prenom" required placeholder="Votre prenom"
                                            value="{{ old('prenom') }}" autocomplete="prenom" autofocus>
                                        <div class="invalid-feedback">
                                            @error('prenom')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Nom -->
                                    {{-- <div class="col-6">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" name="name"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            id="name" required placeholder="Votre Nom"
                                            value="{{ old('name') }}" autocomplete="name">
                                        <div class="invalid-feedback">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <!-- Date naissance -->
                                    {{--  <div class="col-6">
                                        <label for="date_naissance" class="form-label">Date naissance</label>
                                        <input type="date" name="date_naissance"
                                            class="form-control form-control-sm @error('date_naissance') is-invalid @enderror"
                                            id="date_naissance" required placeholder="Votre date de naissance"
                                            value="{{ old('date_naissance') }}" autocomplete="date_naissance" autofocus>
                                        <div class="invalid-feedback">
                                            @error('date_naissance')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Lieu naissance -->
                                    {{-- <div class="col-6">
                                        <label for="lieu_naissance" class="form-label">Lieu naissance</label>
                                        <input type="text" name="lieu_naissance"
                                            class="form-control form-control-sm @error('lieu_naissance') is-invalid @enderror"
                                            id="lieu_naissance" required placeholder="Votre lieu de naissance"
                                            value="{{ old('lieu_naissance') }}" autocomplete="lieu_naissance">
                                        <div class="invalid-feedback">
                                            @error('lieu_naissance')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Username -->
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="username" class="form-label">Username<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="username"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            id="username" required placeholder="Votre username"
                                            value="{{ old('username') }}" autocomplete="username">
                                        <div class="invalid-feedback">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Addresse E-mail -->
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="email" class="form-label">E-mail<span
                                                class="text-danger mx-1">*</span></label>
                                        <div class="input-group has-validation">
                                            {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                            <input type="email" name="email"
                                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                                id="email" required placeholder="Votre e-mail"
                                                value="{{ old('email') }}" autocomplete="email">
                                            <div class="invalid-feedback">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Telephone -->
                                    {{--  <div class="col-6">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="text" name="telephone"
                                            class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                            id="telephone" required placeholder="Votre n° de téléphone"
                                            value="{{ old('telephone') }}" autocomplete="telephone">
                                        <div class="invalid-feedback">
                                            @error('telephone')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Adresse -->
                                    {{-- <div class="col-12">
                                        <label for="adresse" class="form-label">Adresse de résidence</label>
                                        <div class="input-group has-validation">
                                            <input type="name" name="adresse"
                                                class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                                id="adresse" required placeholder="Votre adresse de résidence"
                                                value="{{ old('adresse') }}" autocomplete="adresse">
                                            <div class="invalid-feedback">
                                                @error('adresse')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Mot de passe -->
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="password" class="form-label">Mot de passe<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="password" name="password"
                                            class="form-control form-control-sm @error('password') is-invalid @enderror"
                                            id="password" required placeholder="Votre mot de passe"
                                            value="{{ old('password') }}" autocomplete="new-password">
                                        <div class="invalid-feedback">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Mot de passe de confirmation -->
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="password_confirmation" class="form-label">Confirmez mot de
                                            passe<span class="text-danger mx-1">*</span></label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" required
                                            placeholder="Confimez votre mot de passe"
                                            value="{{ old('password_confirmation') }}"
                                            autocomplete="new-password_confirmation">
                                        <div class="invalid-feedback">
                                            @error('password_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox"
                                                value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">Je suis d'accord et
                                                j'accepte les
                                                <a href="#">termes et conditions</a><span
                                                    class="text-danger mx-1">*</span></label>
                                            <div class="invalid-feedback">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Créer un
                                            compte</button>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <p class="small">Vous avez déjà un compte ? <a
                                                href="{{ url('/login-page') }}">Se connecter</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Conçu par <a href="https://www.onfp.sn/" target="_blank">Lamine BADJI</a>
                </div>
            </section>
            {{-- <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ url('/register-page') }}" class="logo d-flex align-items-center w-auto">
                                    <span class="d-none d-lg-block">ONFP</span>
                                </a>
                            </div>

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-0 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Créer un compte</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                        action="{{ route('register') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" name="prenom"
                                                class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                                id="prenom" required placeholder="Votre prenom"
                                                value="{{ old('prenom') }}" autocomplete="prenom" autofocus>
                                            <div class="invalid-feedback">
                                                @error('prenom')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="name" class="form-label">Nom</label>
                                            <input type="text" name="name"
                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                id="name" required placeholder="Votre Nom"
                                                value="{{ old('name') }}" autocomplete="name">
                                            <div class="invalid-feedback">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">E-mail</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email"
                                                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                                                    id="email" required placeholder="Votre e-mail"
                                                    value="{{ old('email') }}" autocomplete="email">
                                                <div class="invalid-feedback">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="telephone" class="form-label">Téléphone</label>
                                            <input type="text" name="telephone"
                                                class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                                id="telephone" required placeholder="Votre n° de téléphone"
                                                value="{{ old('telephone') }}" autocomplete="telephone">
                                            <div class="invalid-feedback">
                                                @error('telephone')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="adresse" class="form-label">Adresse de résidence</label>
                                            <div class="input-group has-validation">
                                                <input type="name" name="adresse"
                                                    class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                                    id="adresse" required placeholder="Votre adresse de résidence"
                                                    value="{{ old('adresse') }}" autocomplete="adresse">
                                                <div class="invalid-feedback">
                                                    @error('adresse')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Mot de passe</label>
                                            <input type="password" name="password"
                                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                id="password" required placeholder="Votre mot de passe"
                                                value="{{ old('password') }}" autocomplete="new-password">
                                            <div class="invalid-feedback">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirmez mot de
                                                passe</label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" required
                                                placeholder="Confimez votre mot de passe"
                                                value="{{ old('password_confirmation') }}"
                                                autocomplete="new-password_confirmation">
                                            <div class="invalid-feedback">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">Je suis d'accord et
                                                    j'accepte les
                                                    <a href="#">termes et conditions</a></label>
                                                <div class="invalid-feedback">
                                                    @error('password_confirmation')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Créer un
                                                compte</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Vous avez déjà un compte ? <a
                                                    href="{{ url('/login-page') }}">Se connecter</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                Conçu par <a href="https://www.onfp.sn/" target="_blank">Lamine BADJI</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section> --}}

        </div>
    </main>

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
