@extends('layout.user-layout')
@section('space-work')
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="pagetitle">
        <h1>Profil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Utilisateurs</li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h2>
                        <h3>Développeur web</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="flex items-center gap-4">
                    @if ($message = Session::get('status'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- @if ($message = Session::get('status'))
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Aperçu</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-edit">Editer</button>
                                </li>

                                {{--  <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Paramètres</button>
                            </li> --}}

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Changer le mot de passe</button>
                                </li>

                                {{--   <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#compte-deleted">Supprimer
                                    compte</button>
                            </li> --}}

                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    {{-- <h5 class="card-title">À propos</h5>
                                    <p class="small fst-italic">Description du profil</p> --}}

                                    <h5 class="card-title">Détail du profils</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Prénom</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->firstname }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nom</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                        <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8">Web Designer</div>
                                    </div> --}}

                                    {{-- <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8">USA</div>
                                </div> --}}
                                    {{-- 
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div style="color: blue" class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Téléphone</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->telephone }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Adresse</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->adresse }}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                        @csrf
                                    </form>
                                    <!-- Profile Edit Form -->

                                    <form method="post" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('patch')
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image de
                                                profil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="assets/img/profile-img.jpg" alt="Profile">
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Prénom --}}
                                        <div class="row mb-3">
                                            <label for="firstname" class="col-md-4 col-lg-3 col-form-label">Prénom
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="firstname" type="text"
                                                    class="form-control @error('firstname') is-invalid @enderror"
                                                    id="firstname" value="{{ $user->firstname ?? old('firstname') }}"
                                                    autofocus autocomplete="firstname" placeholder="Votre prénom">
                                            </div>
                                            @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Nom --}}
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" value="{{ $user->name ?? old('name') }}" autofocus
                                                    autocomplete="name" placeholder="Votre Nom">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <div>{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="Email" value="{{ $user->email ?? old('email') }}" autofocus
                                                    autocomplete="email" placeholder="Votre adresse e-mail">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <div>{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Telephone --}}
                                        <div class="row mb-3">
                                            <label for="telephone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="telephone" type="telephone"
                                                    class="form-control @error('telephone') is-invalid @enderror"
                                                    id="telephone" value="{{ $user->telephone ?? old('telephone') }}" autofocus
                                                    autocomplete="telephone" placeholder="Votre n° de téléphone">
                                                @error('telephone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <div>{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="row mb-3">
                                            <label for="adresse" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="adresse" type="adresse"
                                                    class="form-control @error('adresse') is-invalid @enderror"
                                                    id="adresse" value="{{ $user->adresse ?? old('adresse') }}" autofocus
                                                    autocomplete="adresse" placeholder="Votre adresse de résidence">
                                                @error('adresse')
                                                    <span class="invalid-feedback" role="alert">
                                                        <div>{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{--
                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-3 col-form-label">À
                                                propos</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 100px">Texte de modification de la description du profil</textarea>
                                            </div>
                                        </div>

                                         <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company" type="text" class="form-control" id="company"
                                                    value="Lueilwitz, Wisoky and Leuschke">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control" id="Job"
                                                    value="Web Designer">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="country" type="text" class="form-control" id="Country"
                                                    value="USA">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address"
                                                    value="A108 Adam Street, New York, NY 535022">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    value="(436) 486-3538 x29071">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter"
                                                    value="https://twitter.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control"
                                                    id="Facebook" value="https://facebook.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control"
                                                    id="Instagram" value="https://instagram.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin" type="text" class="form-control"
                                                    id="Linkedin" value="https://linkedin.com/#">
                                            </div>
                                        </div> --}}
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Sauvegarder les
                                                modifications</button>
                                        </div>
                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                            <div>
                                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                    {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                                                    <button form="send-verification"
                                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                        {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                                                    </button>
                                                </p>

                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                        {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif

                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <!-- Settings Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade"
                                                        checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts"
                                                        checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify"
                                                        checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <label for="update_password_current_password"
                                                class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control"
                                                    id="update_password_current_password" required
                                                    placeholder="Votre mot de passe actuel"
                                                    autocomplete="current-password">
                                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="update_password_password"
                                                class="col-md-4 col-lg-3 col-form-label">Nouveau</label>
                                            <div class="col-md-8 col-lg-9">
                                                {{--  <input name="newpassword" type="password" class="form-control"
                                                id="newPassword"> --}}

                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="update_password_password" required
                                                    placeholder="Votre nouveau mot de passe"
                                                    value="{{ old('password') }}" autocomplete="password">
                                                <div class="invalid-feedback">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="update_password_password_confirmation"
                                                class="col-md-4 col-lg-3 col-form-label">Confirmez</label>
                                            <div class="col-md-8 col-lg-9">
                                                {{-- <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword"> --}}


                                                <input type="password" name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="update_password_password_confirmation" required
                                                    placeholder="Confimez votre nouveau mot de passe"
                                                    value="{{ old('password_confirmation') }}"
                                                    autocomplete="password_confirmation">
                                                <div class="invalid-feedback">
                                                    @error('password_confirmation')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Changer le mot de
                                                passe</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="compte-deleted">
                                    <!-- Compte Deleted -->
                                    <section class="space-y-6">
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Delete Account') }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                            </p>
                                        </header>

                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>

                                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete your account?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                </p>

                                                <div class="mt-6">
                                                    <x-input-label for="password" value="{{ __('Password') }}"
                                                        class="sr-only" />

                                                    <x-text-input id="password" name="password" type="password"
                                                        class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Delete Account') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </section>

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
