@extends('layout.user-layout')
@section('title', 'ONFP - Mon profil')
@section('space-work')
    <div class="pagetitle">
        <h1>Profil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item">Utilisateurs</li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row justify-content-center">
            {{-- Début Photo de profil --}}
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
                        <img class="rounded-circle w-25" alt="Profil" src="{{ asset(Auth::user()->getImage()) }}"
                            width="50" height="auto">

                        <h2>{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h2>
                        <h3>
                            @foreach (Auth::user()->roles as $role)
                                <span>{{ $role->name }} |</span>
                            @endforeach
                        </h3>
                        <div class="social-links mt-2">
                            @isset(Auth::user()->twitter)
                                <a href="{{ Auth::user()->twitter }}" class="twitter" target="_blank"><i
                                        class="bi bi-twitter"></i></a>
                            @endisset
                            @isset(Auth::user()->facebook)
                                <a href="{{ Auth::user()->facebook }}" class="facebook" target="_blank"><i
                                        class="bi bi-facebook"></i></a>
                            @endisset
                            @isset(Auth::user()->instagram)
                                <a href="{{ Auth::user()->instagram }}" class="instagram" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                            @endisset
                            @isset(Auth::user()->linkedin)
                                <a href="{{ Auth::user()->linkedin }}" class="linkedin" target="_blank"><i
                                        class="bi bi-linkedin"></i></a>
                            @endisset
                        </div>
                    </div>
                </div>

            </div>
            {{-- Fin Photo de profil --}}

            {{-- Début aperçu --}}
            <div class="col-xl-8">
                <div class="flex items-center gap-4">
                    <div class="card">
                        @if ($message = Session::get('status'))
                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($message = Session::get('message'))
                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Aperçu</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier
                                        profil
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Changer le mot de passe</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-settings">Notifications</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">À propos</h5>
                                    <p class="small fst-italic">
                                        créé, {{ Auth::user()->created_at->diffForHumans() }},
                                        modifié, {{ Auth::user()->updated_at->diffForHumans() }}
                                    </p>
                                    <h5 class="card-title">Détail du profils</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Prénom</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->firstname }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nom</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
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
                            </div>

                            <div class="tab-content pt-2">
                                {{-- Fin aperçu --}}

                                {{-- Début Edition --}}
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form method="post" action="{{ route('profile.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('patch') <div class="flex items-center gap-4">
                                            <h5 class="card-title">Modification du profil</h5>
                                            <!-- Profile Edit Form -->
                                            <div class="row mb-3">
                                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image
                                                    de
                                                    profil</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img class="rounded-circle w-25" alt="Profil"
                                                        src="{{ asset(Auth::user()->getImage()) }}" width="50"
                                                        height="auto">

                                                    {{-- <div class="pt-2">
                                                            <a href="#" class="btn btn-primary btn-sm"
                                                                title="Upload new profile image"><i
                                                                    class="bi bi-upload"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm"
                                                                title="Remove my profile image"><i
                                                                    class="bi bi-trash"></i></a>
                                                        </div> --}}
                                                    <div class="pt-2">
                                                        <input type="file" name="image" id="image" multiple
                                                            class="form-control @error('image') is-invalid @enderror btn btn-primary btn-sm">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Prénom --}}
                                            <div class="row mb-3">
                                                <label for="firstname"
                                                    class="col-md-4 col-lg-3 col-form-label">Prénom<span
                                                        class="text-danger mx-1">*</span>
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <div class="pt-2">
                                                        <input name="firstname" type="text"
                                                            class="form-control  @error('firstname') is-invalid @enderror"
                                                            id="firstname"
                                                            value="{{ $user->firstname ?? old('firstname') }}"
                                                            autocomplete="firstname" placeholder="Votre prénom">
                                                    </div>
                                                    @error('firstname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Nom --}}
                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Nom<span
                                                        class="text-danger mx-1">*</span></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name" value="{{ $user->name ?? old('name') }}"
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
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email<span
                                                        class="text-danger mx-1">*</span></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="Email" value="{{ $user->email ?? old('email') }}"
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
                                                <label for="telephone"
                                                    class="col-md-4 col-lg-3 col-form-label">Téléphone<span
                                                        class="text-danger mx-1">*</span></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="telephone" type="telephone"
                                                        class="form-control @error('telephone') is-invalid @enderror"
                                                        id="telephone" value="{{ $user->telephone ?? old('telephone') }}"
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
                                                <label for="adresse"
                                                    class="col-md-4 col-lg-3 col-form-label">Adresse<span
                                                        class="text-danger mx-1">*</span></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="adresse" type="adresse"
                                                        class="form-control @error('adresse') is-invalid @enderror"
                                                        id="adresse" value="{{ $user->adresse ?? old('adresse') }}"
                                                        autocomplete="adresse" placeholder="Votre adresse de résidence">
                                                    @error('adresse')
                                                        <span class="invalid-feedback" role="alert">
                                                            <div>{{ $message }}</div>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- twitter --}}
                                            <div class="row mb-3">
                                                <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                    profil</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="twitter" type="twitter"
                                                        class="form-control @error('twitter') is-invalid @enderror"
                                                        id="twitter" value="{{ $user->twitter ?? old('twitter') }}"
                                                        autocomplete="twitter"
                                                        placeholder="lien de votre compte x (ex twitter)">
                                                    @error('twitter')
                                                        <span class="invalid-feedback" role="alert">
                                                            <div>{{ $message }}</div>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- facebook --}}
                                            <div class="row mb-3">
                                                <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                    profil</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="facebook" type="facebook"
                                                        class="form-control @error('facebook') is-invalid @enderror"
                                                        id="facebook" value="{{ $user->facebook ?? old('facebook') }}"
                                                        autocomplete="facebook"
                                                        placeholder="lien de votre compte facebook">
                                                    @error('facebook')
                                                        <span class="invalid-feedback" role="alert">
                                                            <div>{{ $message }}</div>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- instagram --}}
                                            <div class="row mb-3">
                                                <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                    profil</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="instagram" type="instagram"
                                                        class="form-control @error('instagram') is-invalid @enderror"
                                                        id="instagram" value="{{ $user->instagram ?? old('instagram') }}"
                                                        autocomplete="instagram"
                                                        placeholder="lien de votre compte instagram">
                                                    @error('instagram')
                                                        <span class="invalid-feedback" role="alert">
                                                            <div>{{ $message }}</div>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- linkedin --}}
                                            <div class="row mb-3">
                                                <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                    profil</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="linkedin" type="linkedin"
                                                        class="form-control @error('linkedin') is-invalid @enderror"
                                                        id="linkedin" value="{{ $user->linkedin ?? old('linkedin') }}"
                                                        autocomplete="linkedin"
                                                        placeholder="lien de votre ompte linkedin">
                                                    @error('linkedin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <div>{{ $message }}</div>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
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
                                                        <p
                                                            class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                            <!-- End Profile Edit Form -->

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-content pt-2">
                                {{-- Fin Edition --}}
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{ route('password.update') }}">
                                        {{-- Début Modification mot de passe --}}
                                        <div class="flex items-center gap-4">
                                            <!-- Bordered Tabs -->
                                            <div class="tab-content pt-2">
                                                <div class="tab-pane fade show active profile-overview"
                                                    id="profile-overview">

                                                    <h5 class="card-title">Modification du mot de passe</h5>

                                                    <!-- Change Password Form -->
                                                    @csrf
                                                    @method('put')
                                                    <div class="row mb-3">
                                                        <label for="update_password_current_password"
                                                            class="col-md-4 col-lg-3 col-form-label">Mot de
                                                            passe actuel<span class="text-danger mx-1">*</span></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="current_password" type="password"
                                                                class="form-control @error('current_password') is-invalid @enderror"
                                                                id="update_password_current_password"
                                                                placeholder="Votre mot de passe actuel"
                                                                autocomplete="current-password">
                                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                                        </div>
                                                    </div>
                                                    <!-- Mot de passe -->
                                                    <div class="row mb-3">
                                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Mot
                                                            de
                                                            passe<span class="text-danger mx-1">*</span></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input type="password" name="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                id="password" placeholder="Votre mot de passe"
                                                                value="{{ old('password') }}"
                                                                autocomplete="new-password">
                                                            <div class="invalid-feedback">
                                                                @error('password')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Mot de passe de confirmation -->
                                                    <div class="row mb-3">
                                                        <label for="password_confirmation"
                                                            class="col-md-4 col-lg-3 col-form-label">Confirmez<span
                                                                class="text-danger mx-1">*</span></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input type="password" name="password_confirmation"
                                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                id="password_confirmation"
                                                                placeholder="Confimez votre mot de passe"
                                                                value="{{ old('password_confirmation') }}"
                                                                autocomplete="new-password_confirmation">
                                                            <div class="invalid-feedback">
                                                                @error('password_confirmation')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Changer
                                                            le mot de
                                                            passe</button>
                                                    </div>
                                                    <!-- End Change Password Form -->

                                                </div>

                                            </div><!-- End Bordered Tabs -->
                                        </div>
                                        {{-- Fin Modification mot de passe --}}

                                    </form><!-- End Change Password Form -->

                                </div>
                            </div><!-- End Bordered Tabs -->

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>
              
                                  <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                    <div class="col-md-8 col-lg-9">
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                        <label class="form-check-label" for="changesMade">
                                          Changes made to your account
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
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
                                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
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
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
