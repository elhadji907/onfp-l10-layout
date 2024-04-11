@extends('layout.user-layout')
@section('title', 'Détails utilisateur')
@section('space-work')

    <section class="section profile">
        <div class="row">
            @if ($message = Session::get('status'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('users.index') }}" class="btn btn-success btn-sm"
                    title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                <p> | retour, liste des utilisateurs</p>
            </span>
            <div class="col-xl-4">
                <div class="card border-info mb-3">
                    <div class="card-header text-center">
                        Image de profil
                    </div>
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img class="rounded-circle w-50" alt="Profil" src="{{ asset($user->getImage()) }}" width="100"
                            height="auto">

                        <h2 class="pt-3">{{ $user?->civilite . ' ' . $user->firstname . ' ' . $user->name }}</h2>

                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>

                        {{-- <h5 class="card-title">Informations complémentaires</h5>
                        <p>créé par <b>{{ $user_create_name }}</b>, {{ $user->created_at->diffForHumans() }}</p>
                        <p>modifié par <b>{{ $user_update_name }}</b>, {{ $user->updated_at->diffForHumans() }}</p> --}}
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card border-info mb-3">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Utilisateur</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#"><a
                                        class="dropdown-item btn btn-sm mx-1" href="{{ route('users.edit', $user->id) }}"
                                        class="mx-1"><i class="bi bi-pencil mx-1"></i>Modifier</a></button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-autre">Info.
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content pt-0">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Détails</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Prénom</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->firstname }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nom</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Téléphone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->telephone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Adresse</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->adresse }}</div>
                                </div>

                            </div>

                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview" id="profile-autre">

                                    {{--  <h5 class="card-title">Audit</h5> --}}

                                    <div class="card-body profile-card pt-1 d-flex flex-column">
                                        <h5 class="card-title">Informations complémentaires</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label pb-2">Création </div>
                                            <div class="col-lg-9 col-md-8 pb-2">{{ 'créé par : ' . $user_create_name }}
                                                {{ $user->created_at->diffForHumans() }}</div>

                                            <div class="col-lg-3 col-md-4 label pt-2">Modification</div>

                                            @if ($user->created_at != $user->updated_at)
                                                <div class="col-lg-9 col-md-8 pt-2">
                                                    {{ 'modifié par : ' . $user_update_name }}
                                                    {{ $user->updated_at->diffForHumans() }}</div>
                                            @else
                                                <div class="col-lg-9 col-md-8 pt-2">
                                                    jamais modifié</div>
                                            @endif

                                            <div class="col-lg-3 col-md-4 label pt-3">Roles</div>
                                            <div class="col-lg-9 col-md-8 pt-3">
                                                @if (isset($user->roles) && $user->roles != '[]')
                                                    @foreach ($user->roles as $role)
                                                        <span class="badge bg-info">{{ $role->name }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="col-lg-2 col-md-3 label">Création</div>
                                        <div class="col-lg-10 col-md-9">créé le
                                            {{ Auth::user()->created_at->format('d/m/Y à H:i:s') }}</div>
                                        <div class="col-lg-2 col-md-3 label">Modification</div>
                                        <div class="col-lg-10 col-md-9">Modifié le
                                            {{ Auth::user()->updated_at->format('d/m/Y à H:i:s') }}</div> --}}
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
