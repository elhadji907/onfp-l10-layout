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
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert"><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif
                <div class="col-12 col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="d-flex mt-2 align-items-baseline"><a
                                        href="{{ route('demandeurs.show', $individuelle->demandeur->id) }}"
                                        class="btn btn-secondary btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Détails</p>
                                </span>
                                <span>
                                    <nav class="header-nav ms-auto">
                                        <ul class="d-flex align-items-center">
                                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                                {{--  @if ($individuelle?->statut == 'Attente')
                                                    <span
                                                        class="badge bg-warning badge-number">{{ $individuelle?->statut }}</span>
                                                @endif --}}
                                                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                                    <i class="bi bi-chat-left-text m-1"></i>
                                                    <span class="badge bg-success badge-number"
                                                        title="{{ $individuelle?->statut }}">{{ $individuelle->validationindividuelles->count() }}</span>
                                                </a>

                                                {{-- @if ($individuelle?->statut == 'Validée')
                                                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                                        <i class="bi bi-chat-left-text"></i>
                                                        <span class="badge bg-success badge-number">3</span>
                                                    </a> --}}
                                                <!-- End Messages Icon -->
                                                {{-- <button type="submit" class="btn btn-success btn-sm text-white"><i
                                                            class="bi bi-eye"></i>
                                                        {{ $individuelle?->statut }}
                                                    </button> --}}
                                                {{--  <span
                                                        class="badge bg-info badge-number">{{ $individuelle?->statut }}</span> --}}
                                                {{-- @endif --}}
                                                {{-- @if ($individuelle?->statut == 'Rejetée')
                                                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                                        <i class="bi bi-chat-left-text m-1"></i>
                                                        <span class="badge bg-success badge-number"
                                                            title="{{ $individuelle?->statut }}">{{ $individuelle->validationindividuelles->count() }}</span>
                                                    </a> --}}
                                                <!-- End Messages Icon -->
                                                {{-- <span
                                                        class="badge bg-danger badge-number">{{ $individuelle?->statut }}</span> --}}
                                                {{-- <button type="submit" class="btn btn-danger btn-sm text-white"><i
                                                            class="bi bi-eye"></i>
                                                        {{ $individuelle?->statut }}</button> --}}
                                                {{-- @endif --}}
                                            </a><!-- End Notification Icon -->

                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                                                <li class="dropdown-header">
                                                    @if ($individuelle->validationindividuelles->count() == '0')
                                                        Aucune validation pour le moment
                                                    @else
                                                        Vous avez
                                                        {{ $individuelle->validationindividuelles->count() . ' validation(s)' }}
                                                    @endif
                                                    @if ($individuelle->validationindividuelles->count() != '0')
                                                        <a href="{{ url('validationsRejetMessage/' . $individuelle->id) }}"><span
                                                                class="badge rounded-pill bg-primary p-2 ms-2">Voir
                                                                toutes</span></a>
                                                    @endif
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <?php $i = 1; ?>
                                                @foreach ($individuelle->validationindividuelles as $count => $validationindividuelle)
                                                    @if ($count < 2)
                                                        <li class="message-item">
                                                            {{-- <i class="bi bi-exclamation-circle text-warning"></i> --}}
                                                            <a
                                                                href="{{ url('validationsRejetMessage/' . $individuelle->id) }}">
                                                                <img src="{{ asset($validationindividuelle->user->getImage()) }}"
                                                                    alt="" class="rounded-circle">
                                                                <div>
                                                                    <h4>{{ $validationindividuelle->user->firstname . ' ' . $validationindividuelle->user->name }}
                                                                    </h4>
                                                                    <p>
                                                                        @if ($validationindividuelle->action == 'Attente')
                                                                            <span
                                                                                class="badge rounded-pill bg-warning">{{ $validationindividuelle->action }}</span>
                                                                        @elseif ($validationindividuelle->action == 'Validée')
                                                                            <span
                                                                                class="badge rounded-pill bg-info">{{ $validationindividuelle->action }}</span>
                                                                        @elseif ($validationindividuelle->action == 'Rejetée')
                                                                            <span
                                                                                class="badge rounded-pill bg-danger">{{ $validationindividuelle->action }}</span>
                                                                            <p>{!! substr($validationindividuelle?->motif, 0, 25) . ' ...' !!}</p>
                                                                        @else
                                                                            <span
                                                                                class="badge rounded-pill bg-warning">{{ $validationindividuelle->action }}</span>
                                                                        @endif
                                                                        {{-- {{ $validationindividuelle->action }} --}}
                                                                    </p>
                                                                    <p>{!! $validationindividuelle->created_at->diffForHumans() !!}</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                    @endif
                                                @endforeach
                                                @if ($individuelle->validationindividuelles->count() != '0')
                                                    <li class="dropdown-footer">
                                                        <a
                                                            href="{{ url('validationsRejetMessage/' . $individuelle->id) }}">Voir
                                                            toutes les validations</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </ul>
                                    </nav>
                                </span>
                                @if (auth()->user()->hasRole('super-admin'))
                                    {{-- @if ($individuelle?->statut == 'Validée')
                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                            data-bs-toggle="modal" data-bs-target="#AddRegionModal"><i
                                                class="bi bi-x"></i>Rejeter
                                        </button>
                                    @elseif($individuelle?->statut == 'Rejetée')
                                        <form action="{{ route('validation-individuelles.update', $individuelle->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="btn btn-success btn-sm text-white show_confirm_valider"><i
                                                    class="bi bi-x"></i>Valider</button>
                                        </form>
                                    @elseif($individuelle?->statut == 'Attente')
                                        <form action="{{ route('validation-individuelles.update', $individuelle->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="btn btn-success btn-sm text-white show_confirm_valider"><i
                                                    class="bi bi-x"></i>Valider</button>
                                        </form>
                                    @else
                                        <form action="#"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="btn btn-warning btn-sm text-white"><i
                                                    class="bi bi-x"></i>Retirer</button>
                                        </form>
                                    @endif --}}

                                    <span class="d-flex align-items-baseline">
                                        @if ($individuelle?->statut == 'Validée')
                                            <button
                                                class="btn btn-success btn-sm text-white">{{ $individuelle->statut }}</button>
                                        @elseif($individuelle?->statut == 'Rejetée')
                                            <button
                                                class="btn btn-danger btn-sm text-white">{{ $individuelle->statut }}</button>
                                        @elseif($individuelle?->statut == 'Attente')
                                            <button
                                                class="btn btn-secondary btn-sm text-white">{{ $individuelle->statut }}</button>
                                        @else
                                            <button
                                                class="btn btn-warning btn-sm text-white">{{ $individuelle->statut }}</button>
                                        @endif
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                @if ($individuelle?->statut == 'Validée')
                                                    <button class="btn btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#AddRegionModal">Rejeter
                                                        cette demande
                                                    </button>
                                                @elseif($individuelle?->statut == 'Rejetée')
                                                    <form
                                                        action="{{ route('validation-individuelles.update', $individuelle->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button
                                                            class="show_confirm_valider btn btn-sm mx-1">Valider</button>
                                                    </form>
                                                @elseif($individuelle?->statut == 'Attente')
                                                    <form
                                                        action="{{ route('validation-individuelles.update', $individuelle->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button
                                                            class="show_confirm_valider btn btn-sm mx-1">Valider</button>
                                                    </form>
                                                    <button class="btn btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#AddRegionModal">Rejeter
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm mx-1">Aucune action
                                                        possible</button>
                                                @endif
                                            </ul>
                                        </div>
                                    </span>
                                @endif
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
                                            class="btn btn-primary btn-sm text-white" title="voir détails"><i
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
        <div class="modal fade" id="AddRegionModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- <form method="POST" action="{{ route('addRegion') }}">
                        @csrf --}}
                    <form method="post" action="{{ route('validation-individuelles.destroy', $individuelle->id) }}"
                        enctype="multipart/form-data" class="row">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Rejet demande</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="motif" class="form-label">Motifs du rejet</label>
                            <textarea name="motif" id="motif" rows="5"
                                class="form-control form-control-sm @error('motif') is-invalid @enderror"
                                placeholder="Enumérer les motifs du rejet">{{ old('motif') }}</textarea>
                            @error('motif')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-printer"></i>
                                Rejeter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
