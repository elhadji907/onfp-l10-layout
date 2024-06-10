@extends('layout.user-layout')
@section('title', 'Détails demande individuelle')
@section('space-work')
    <section class="section min-vh-0 d-flex flex-column align-items-center justify-content-center py-0 section profile">
        <div class="container">
            <div class="row justify-content-center">
                @if ($message = Session::get('status'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-12 col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="d-flex mt-2 align-items-baseline"><a
                                        href="{{ route('demandeurs.show', $individuelle->demandeur->id) }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Détails</p>
                                </span>
                                @if ($individuelle?->statut == 'Attente')
                                    <span class="badge bg-white text-warning">{{ $individuelle?->statut }}</span>
                                @endif
                                @if ($individuelle?->statut == 'Validée')
                                    <span class="badge bg-white text-info">{{ $individuelle?->statut }}</span>
                                @endif
                                @if ($individuelle?->statut == 'Rejetée')
                                    <span class="badge bg-white text-danger">{{ $individuelle?->statut }}</span>
                                @endif

                                @if (auth()->user()->hasRole('super-admin'))
                                    @if ($individuelle?->statut == 'Validée')
                                        <form action="{{ route('validation-individuelles.destroy', $individuelle->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger show_confirm_annuler">
                                                <span class="badge bg-white text-danger">Rejeter</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('validation-individuelles.update', $individuelle->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-success show_confirm">
                                                <span class="badge bg-white text-info">Valider</span>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                                {{-- <button type="submit" class="dropdown-item show_confirm" title="valider"><i
                                    class="bi bi-trash"></i>Valider</button> --}}

                                {{--  <a href="#" data-bs-toggle="modal" data-bs-target="#modalValidation"
                                    class="btn btn-primary float-end btn-rounded" title="validation">Validation</a> --}}
                            </div>
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <form method="post" action="{{ url('individuelles/' . $individuelle->id) }}"
                                    enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Civilité</div>
                                        <div>{{ $individuelle->demandeur->user?->civilite }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">N° CIN</div>
                                        <div>{{ $individuelle->demandeur->user?->cin }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Prénom</div>
                                        <div>{{ $individuelle->demandeur->user->firstname }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Nom</div>
                                        <div>{{ $individuelle->demandeur->user->name }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div for="date_naissance" class="label">Date naissance</div>
                                        <div>{{ $individuelle->demandeur->user->date_naissance?->format('Y-m-d') }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Lieu naissance</div>
                                        <div>{{ $individuelle->demandeur->user->lieu_naissance }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Adresse</div>
                                        <div>{{ $individuelle->demandeur->user->adresse }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Email</div>
                                        <div>{{ $individuelle->demandeur->user->email }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Téléphone personnel</div>
                                        <div>{{ $individuelle->demandeur->user->telephone }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Téléphone secondaire</div>
                                        <div>{{ $individuelle->demandeur->user->telephone_secondaire }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Formation sollicitée</div>
                                        <div>{{ $individuelle?->module?->name }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Si autre formation ? précisez</div>
                                        <div>{{ $individuelle->autre_module }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Lieu de formation</div>
                                        <div>{{ $individuelle?->departement?->nom }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Situation familiale</div>
                                        <div>{{ $individuelle->demandeur->user->situation_familiale }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Situation professionnelle</div>
                                        <div>{{ $individuelle->demandeur->user->situation_professionnelle }}</div>
                                    </div>


                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Niveau étude</div>
                                        <div>{{ $individuelle->niveau_etude }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Diplôme académique</div>
                                        <div>{{ $individuelle->diplome_academique }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Si autre ? précisez</div>
                                        <div>{{ $individuelle->autre_diplome_academique }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Option du diplôme</div>
                                        <div>{{ $individuelle->option_diplome_academique }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Etablissement académique</div>
                                        <div>{{ $individuelle->etablissement_academique }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Diplôme professionnel</div>
                                        <div>{{ $individuelle->diplome_professionnel }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Si autre ? précisez</div>
                                        <div>{{ $individuelle->autre_diplome_professionnel }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Etablissement professionnel</div>
                                        <div>{{ $individuelle->etablissement_professionnel }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Spécialité</div>
                                        <div>{{ $individuelle->specialite_diplome_professionnel }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Votre projet après la formation</div>
                                        <div>{{ $individuelle->projet_poste_formation }}</div>
                                    </div>

                                    <div class="col-12 col-md-3 col-lg-3 mb-0">
                                        <div class="label">Qualification et autres diplômes</div>
                                        <div>{{ $individuelle->qualification }}</div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <div class="label">Expériences et stages</div>
                                        <div>{{ $individuelle->experience }}</div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <div class="label">Informations complémentaires sur
                                            le projet
                                            professionnel</div>
                                        <div>{{ $individuelle->projetprofessionnel }}</div>
                                    </div>

                                    <div class="text-center">
                                        <a href="{{ route('individuelles.edit', $individuelle->id) }}"
                                            class="btn btn-info btn-sm text-white" title="voir détails"><i
                                                class="bi bi-pencil"></i>&nbsp;Modifier</a>
                                    </div>
                                </form>
                            </div>
                            {{-- @include('demandes.individuelles.validationModal') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
