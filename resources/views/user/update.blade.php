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

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Modification</h5>
                                <p class="text-center small">Introduire les nouvelles données pour modifier</p>
                            </div>
                            <form method="post" action="{{ route('user.update', $user->id) }}"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('patch')
                                <div class="col-6">
                                    <label for="firstname" class="form-label">Prénom</label>
                                    <input type="text" name="firstname" value="{{ $user->firstname }}"
                                        class="form-control form-control-sm @error('firstname') is-invalid @enderror"
                                        id="firstname" placeholder="prénom">
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        id="name" placeholder="nom">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                               {{--  <div class="col-6">
                                    <label for="email" class="form-label">email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="email">@</span>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            id="email" placeholder="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-6">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="text" name="telephone" value="{{ $user->telephone }}"
                                        class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                        id="telephone" placeholder="téléphone">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" name="adresse" value="{{ $user->adresse }}"
                                        class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                        id="adresse" placeholder="adresse">
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
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
