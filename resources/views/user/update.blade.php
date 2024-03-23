@extends('layout.user-layout')
@section('title', 'Modification utilisateur')
@section('space-work')
    <section class="section min-vh-0 d-flex flex-column align-items-center justify-content-center py-0">
        <div class="container">
            <div class="row justify-content-center">
                @if ($message = Session::get('status'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 pt-5">
                                    <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('user.index') }}"
                                            class="btn btn-success btn-sm" title="retour"><i
                                                class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                        <p> | Liste des utilisateurs</p>
                                    </span>
                                </div>
                            </div>

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Modification</h5>
                                <p class="text-center small">Introduire les nouvelles données pour modifier</p>
                            </div>
                            <form method="post" action="{{ route('users.update', $user->id) }}"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('patch')
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <label for="firstname" class="form-label">Prénom<span
                                            class="text-danger mx-1">*</span></label>
                                    <input type="text" name="firstname" value="{{ $user->firstname }}"
                                        class="form-control form-control-sm @error('firstname') is-invalid @enderror"
                                        id="firstname" placeholder="prénom">
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <label for="name" class="form-label">Nom<span
                                            class="text-danger mx-1">*</span></label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        id="name" placeholder="nom">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <label for="email" class="form-label">email<span
                                            class="text-danger mx-1">*</span></label>
                                    <div class="input-group has-validation">
                                        {{-- <span class="input-group-text" id="email">@</span> --}}
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            id="email" placeholder="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <label for="telephone" class="form-label">Téléphone<span
                                            class="text-danger mx-1">*</span></label>
                                    <input type="text" name="telephone" value="{{ $user->telephone }}"
                                        class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                        id="telephone" placeholder="téléphone">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <label for="adresse" class="form-label">Adresse<span
                                            class="text-danger mx-1">*</span></label>
                                    <input type="text" name="adresse" value="{{ $user->adresse }}"
                                        class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                        id="adresse" placeholder="adresse">
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" name="password"
                                        class="form-control  @error('password') is-invalid @enderror" id="password"
                                        placeholder="Votre mot de passe">
                                    <div class="invalid-feedback">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 col-lg-6 mb-4">
                                    <label for="roles" class="form-label">Roles</label>
                                    <select name="roles[]" class="form-select" aria-label="Select"
                                        id="multiple-select-field" multiple data-placeholder="Choisir roles">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role ?? old('role') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="newPassword" value="{{ $user->password }}">

                                <div class="col-12 col-md-12 col-lg-6 mb-4">
                                    <label for="profil" class="form-label">Image de profil</label>
                                    <input type="file" name="image" id="image" multiple
                                        class="form-control @error('image') is-invalid @enderror btn btn-outline-info btn-sm">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="col-xl-4">
                                        <div class="profile-card pt-4 d-flex flex-column">
                                            <img class="rounded-sm w-25" alt="Profil"
                                                src="{{ asset($user->getImage()) }}" width="20" height="auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Sauvegarder les
                                        modifications</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
