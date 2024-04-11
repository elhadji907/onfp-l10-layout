@extends('layout.user-layout')
@section('title', 'Détails employé')
@section('space-work')

    <section class="section profile">
        <div class="row">
            @if ($message = Session::get('status'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('employes.index') }}"
                    class="btn btn-success btn-sm" title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                <p> | retour, liste des employés</p>
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
                            @isset($employe->user->twitter)
                                <a href="{{ $employe->user->twitter }}" class="twitter" target="_blank"><i
                                        class="bi bi-twitter"></i></a>
                            @endisset
                            @isset($employe->user->facebook)
                                <a href="{{ $employe->user->facebook }}" class="facebook" target="_blank"><i
                                        class="bi bi-facebook"></i></a>
                            @endisset
                            @isset($employe->user->instagram)
                                <a href="{{ $employe->user->instagram }}" class="instagram" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                            @endisset
                            @isset($employe->user->linkedin)
                                <a href="{{ $employe->user->linkedin }}" class="linkedin" target="_blank"><i
                                        class="bi bi-linkedin"></i></a>
                            @endisset
                        </div>

                        {{-- <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div> --}}

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
                                    data-bs-target="#profile-overview">employé</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#"><a
                                        class="dropdown-item btn btn-sm mx-1"
                                        href="{{ route('employes.edit', $employe->id) }}" class="mx-1"><i
                                            class="bi bi-pencil mx-1"></i>Modifier</a></button>
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
                                    <div class="col-lg-3 col-md-4 label">Matricule</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $employe?->matricule }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Prénom & Nom</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user?->civilite . ' ' . $user->firstname . ' ' . $user->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date & lieu naissance</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->date_naissance?->format('d-m-Y') . ' à ' . $user->lieu_naissance }}
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

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date embauche</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $employe->date_embauche?->format('d-m-Y') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">CIN</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $employe?->cin }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Situation familiale</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $employe->user?->situation_familiale }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Direction</div>
                                    <div class="col-lg-9 col-md-8">{{ $employe->direction?->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Fonction</div>
                                    <div class="col-lg-9 col-md-8">{{ $employe->fonction?->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Catégorie</div>
                                    <div class="col-lg-9 col-md-8">{{ $employe->category?->name }}</div>
                                </div>

                            </div>

                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview" id="profile-autre">

                                    {{--  <h5 class="card-title">Audit</h5> --}}

                                    <div class="card-body profile-card pt-1 d-flex flex-column">
                                        <h5 class="card-title">Informations complémentaires</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label pb-2">Créé par </div>
                                            <div class="col-lg-9 col-md-8 pb-2">{{ $user_create_name }}
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
