@extends('layout.user-layout')
@section('title', 'ONFP - ' . $formation->name)
@section('space-work')

    <section
        class="section profile min-vh-0 d-flex flex-column align-items-center justify-content-center py-0 section profile">
        <div class="container-fluid">
            <div class="pagetitle">
                {{-- <h1>Data Tables</h1> --}}
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">Formations {{ $type_formation }}</li>
                    </ol>
                </nav>
            </div>
            <!-- End Title -->
            <div class="row justify-content-center">
                @if ($message = Session::get('status'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
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
                <div class="flex items-center gap-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <span class="nav-link"><a href="{{ route('formations.index', $formation->id) }}"
                                            class="btn btn-secondary btn-sm" title="retour"><i
                                                class="bi bi-arrow-counterclockwise"></i></a>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Détails
                                        formation</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#responsable-overview">Opérateur</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#beneficiaires-overview">Bénéficiaires
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#module-overview">Module
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#ingenieur-overview">Ingénieur
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#evaluation-overview">Évaluation
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content pt-0">
                                <div class="tab-pane fade profile-overview pt-3" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <span class="card-title">Détails formation : <span
                                                class="{{ $formation?->statut }} text-white">
                                                {{ $formation?->statut }}</span>
                                        </span>
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <div class="label">Intitulé formation</div>
                                            <div>{{ $formation?->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Code</div>
                                            <div>{{ $formation?->code }}</div>
                                        </div>
                                        @isset($formation?->module?->name)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Module</div>
                                                <div>{{ $formation?->module?->name }}</div>
                                            </div>
                                        @endisset
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Région</div>
                                            <div>{{ $formation?->departement->region->nom }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Département</div>
                                            <div>{{ $formation->departement->nom }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Adresse exacte</div>
                                            <div>{{ $formation?->lieu }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Type formation</div>
                                            <div>{{ $formation?->types_formation?->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Statut juridique</div>
                                            <div>{{ $formation?->statut }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Niveau qualification</div>
                                            <div>{{ $formation->niveau_qualification }}</div>
                                        </div>
                                        @isset($formation?->date_debut)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Date début</div>
                                                <div>{{ $formation?->date_debut->format('d/m/Y') }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->date_fin)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Date fin</div>
                                                <div>{{ $formation?->date_fin->format('d/m/Y') }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->effectif_prevu)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Effectif prévu</div>
                                                <div>{{ $formation?->effectif_prevu }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->prevue_h)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Prévu homme</div>
                                                <div>{{ $formation?->prevue_h }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->prevue_f)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Prévu femmes</div>
                                                <div>{{ $formation?->prevue_f }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->frais_operateurs)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Frais opérateur</div>
                                                <div>{{ number_format($formation?->frais_operateurs, 2, ',', ' ') }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->frais_add)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Frais additionels</div>
                                                <div>{{ number_format($formation?->frais_add, 2, ',', ' ') }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->autes_frais)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Autres frais</div>
                                                <div>{{ number_format($formation?->autes_frais, 2, ',', ' ') }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->projets_id)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Projet</div>
                                                <div>{{ $formation?->projet?->name }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->programmes_id)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Programme</div>
                                                <div>{{ $formation?->programme?->name }}</div>
                                            </div>
                                        @endisset
                                        @isset($formation?->choixoperateur?->description)
                                            <div class="col-12 col-md-3 col-lg-3 mb-0">
                                                <div class="label">Choix opérateur</div>
                                                <div>{{ $formation?->choixoperateur?->description }}</div>
                                            </div>
                                        @endisset
                                    </form>
                                    <div class="col-12 col-md-12 col-lg-12 mb-0 text-center">
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('formations.edit', $formation->id) }}" class="mx-1"
                                            title="Modifier"><i class="bi bi-pencil"></i>&nbsp;Modifier</a>
                                    </div>
                                </div>
                            </div>
                            {{-- Détail --}}
                            <div class="tab-content">
                                <div class="tab-pane fade profile-overview" id="responsable-overview">
                                    @if (isset($operateur))
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">
                                                {{ $formation?->operateur?->name . '(' . $formation?->operateur?->sigle . ')' }}
                                                <a class="btn btn-info btn-sm" title=""
                                                    href="{{ route('operateurs.show', $formation?->operateur?->id) }}"><i
                                                        class="bi bi-eye"></i></a>&nbsp;
                                                <a href="{{ url('formationoperateurs', ['$idformation' => $formation->id, '$idmodule' => $formation->module->id, '$idlocalite' => $formation->departement->region->id]) }}"
                                                    class="btn btn-primary float-end btn-sm">
                                                    <i class="bi bi-pencil" title="Changer opérateur"></i> </a>
                                            </h5>
                                        </div>
                                    @elseif(isset($module))
                                        <div class="pt-1">
                                            <a href="{{ url('formationoperateurs', ['$idformation' => $formation?->id, '$idmodule' => $formation?->module?->id, '$idlocalite' => $formation?->departement?->region?->id]) }}"
                                                class="btn btn-primary float-end btn-sm">
                                                <i class="bi bi-person-plus-fill" title="Ajouter opérateur"></i> </a>
                                        </div>
                                    @else
                                    @endif
                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        @isset($operateur)
                                            <h1 class="card-title">
                                                Liste des formations
                                            </h1>
                                            <div class="row g-3">
                                                <table class="table table-bordered table-hover datatables"
                                                    id="table-formations">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Type</th>
                                                            <th>Intitulé formation</th>
                                                            <th>Localité</th>
                                                            {{-- <th>Modules</th> --}}
                                                            {{-- <th>Niveau qualification</th> --}}
                                                            <th>Effectif</th>
                                                            <th>Statut</th>
                                                            <th class="text-center">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($operateur?->formations as $operateurformation)
                                                            <tr>
                                                                <td>{{ $operateurformation?->code }}</td>
                                                                <td><a
                                                                        href="#">{{ $operateurformation->types_formation?->name }}</a>
                                                                </td>
                                                                <td>{{ $operateurformation?->name }}</td>
                                                                <td>{{ $operateurformation->departement?->region?->nom }}</td>
                                                                {{-- <td>{{ $operateurformation->module?->name }}</td> --}}
                                                                {{-- <td>{{ $operateurformation->niveau_qualification }}</td> --}}
                                                                <td class="text-center">
                                                                    @foreach ($operateurformation->individuelles as $individuelle)
                                                                        @if ($loop->last)
                                                                            <a class="text-primary fw-bold"
                                                                                href="{{ route('formations.show', $operateurformation->id) }}">{!! $loop->count ?? '0' !!}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td><a href="#"><span
                                                                            class="{{ $operateurformation?->statut }}">{{ $operateurformation?->statut }}</span></a>
                                                                </td>
                                                                <td>
                                                                    <span class="d-flex align-items-baseline"><a
                                                                            href="{{ route('formations.show', $operateurformation->id) }}"
                                                                            class="btn btn-primary btn-sm"
                                                                            title="voir détails"><i class="bi bi-eye"></i></a>
                                                                        <div class="filter">
                                                                            <a class="icon" href="#"
                                                                                data-bs-toggle="dropdown"><i
                                                                                    class="bi bi-three-dots"></i></a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                <li><a class="dropdown-item btn btn-sm"
                                                                                        href="{{ route('formations.edit', $operateurformation->id) }}"
                                                                                        class="mx-1" title="Modifier"><i
                                                                                            class="bi bi-pencil"></i>Modifier</a>
                                                                                </li>
                                                                                <li>
                                                                                    <form
                                                                                        action="{{ route('formations.destroy', $operateurformation->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="dropdown-item show_confirm"
                                                                                            title="Supprimer"><i
                                                                                                class="bi bi-trash"></i>Supprimer</button>
                                                                                    </form>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                </table>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content pt-0">
                                <div class="tab-pane fade show active profile-overview" id="beneficiaires-overview">
                                    @isset($module)
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <span class="card-title d-flex align-items-baseline">Code formation :&nbsp;
                                                    <span class="badge bg-info text-white">
                                                        {{ $formation?->code }}</span>
                                                </span>
                                                @if (auth()->user()->hasRole('super-admin'))
                                                    <span class="card-title d-flex align-items-baseline">Statut formation
                                                        :&nbsp;
                                                        <span class="{{ $formation?->statut }} text-white">
                                                            {{ $formation?->statut }}</span>
                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <form
                                                                    action="{{ route('validation-formations.update', $formation?->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button
                                                                        class="show_confirm_valider btn btn-sm mx-1">Démarrer</button>
                                                                </form>
                                                                <form action="{{ route('formationTerminer') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button
                                                                        class="show_confirm_valider btn btn-sm mx-1">Terminer</button>
                                                                </form>
                                                                <button class="btn btn-sm mx-1" data-bs-toggle="modal"
                                                                    data-bs-target="#RejetDemandeModal">Annuler
                                                                </button>
                                                                <hr>
                                                                <form action="{{ route('ficheSuivi') }}" method="post"
                                                                    target="_blank">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button class="btn btn-sm mx-1">Fiche de suivi</button>
                                                                </form>
                                                                <form action="{{ route('pvEvaluation') }}" method="post"
                                                                    target="_blank">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button class="btn btn-sm mx-1">PV Evaluation</button>
                                                                </form>
                                                                <hr>
                                                                <form action="{{ route('lettreEvaluation') }}" method="post"
                                                                    target="_blank">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button class="btn btn-sm mx-1">Lettre mission</button>
                                                                </form>
                                                                <form action="{{ route('abeEvaluation') }}" method="post"
                                                                    target="_blank">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button class="btn btn-sm mx-1">A B E</button>
                                                                </form>
                                                                <hr>
                                                                <form action="{{ route('sendFormationEmail') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button class="btn btn-sm mx-1">Démarrage (e-mail)</button>
                                                                </form>
                                                                <form action="{{ route('sendWelcomeEmail') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    {{-- @method('PUT') --}}
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $formation->id }}">
                                                                    <button class="btn btn-sm mx-1">Résultats (e-mail)</button>
                                                                </form>
                                                            </ul>
                                                        </div>
                                                    </span>
                                                @endif
                                                <div class="float-end">
                                                    <a href="{{ url('formationdemandeurs', ['$idformation' => $formation->id, '$idmodule' => $formation?->module?->id, '$idlocalite' => $formation->departement->region->id]) }}"
                                                        class="btn btn-outline-primary btn-rounded btn-sm">
                                                        <i class="bi bi-plus" title="Ajouter demandeur"></i> </a>
                                                </div>
                                            </div>
                                            <div class="row g-3 pt-3">
                                                <table
                                                    class="table table-bordered table-hover datatables align-middle justify-content-center table-borderless"
                                                    id="table-operateurModules">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">N° Dossier</th>
                                                            <th class="text-center">Civilité</th>
                                                            <th class="text-center">CIN</th>
                                                            <th>Prénom</th>
                                                            <th>NOM</th>
                                                            <th class="text-center">Date naissance</th>
                                                            <th class="text-center">Lieu de naissance</th>
                                                            {{-- <th>Adresse</th> --}}
                                                            {{-- @isset($individuelle?->note_obtenue) --}}
                                                            <th class="text-center">Note</th>
                                                            {{-- @endisset --}}
                                                            {{-- <th>Appréciation</th> --}}
                                                            {{-- <th class="col"><i class="bi bi-backspace-reverse"></i></th> --}}
                                                            <th class="col"><i class="bi bi-gear"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($formation->individuelles as $individuelle)
                                                            <tr>
                                                                <td class="text-center">{{ $i++ }}</td>
                                                                <td class="text-center">{{ $individuelle?->numero }}</td>
                                                                <td class="text-center">{{ $individuelle?->user?->civilite }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ $individuelle?->user?->cin }}</td>
                                                                <td>{{ $individuelle?->user?->firstname }}</td>
                                                                <td>{{ $individuelle?->user?->name }}</td>
                                                                <td style="text-align: center;">
                                                                    {{ $individuelle?->user->date_naissance?->format('d/m/Y') }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $individuelle?->user?->lieu_naissance }}</td>
                                                                {{-- <td>{{ $individuelle?->user->adresse }}</td> --}}
                                                                {{-- @isset($individuelle?->note_obtenue) --}}
                                                                <td class="text-center">
                                                                    {{ $individuelle?->note_obtenue ?? ' ' }}</td>
                                                                {{-- @endisset --}}
                                                                {{-- <td>{{ $individuelle?->appreciation }}</td> --}}
                                                                <td>
                                                                    <span class="d-flex align-items-baseline"><a
                                                                            href="{{ route('individuelles.show', $individuelle?->id) }}"
                                                                            class="btn btn-primary btn-sm"
                                                                            title="voir détails"><i class="bi bi-eye"></i></a>
                                                                        <div class="filter">
                                                                            <a class="icon" href="#"
                                                                                data-bs-toggle="dropdown"><i
                                                                                    class="bi bi-three-dots"></i></a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                {{-- <li>
                                                                                    <a class="btn btn-danger btn-sm"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#indiponibleModal{{ $individuelle->id }}"
                                                                                        title="retirer">Retirer de cette
                                                                                        formation
                                                                                    </a>
                                                                                </li> --}}
                                                                                <button class="btn btn-sm mx-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#indiponibleModal{{ $individuelle->id }}">Retirer
                                                                                </button>
                                                                                {{-- <li>
                                                                                    <form
                                                                                        action="{{ route('individuelles.destroy', $individuelle->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="dropdown-item show_confirm"
                                                                                            title="Supprimer"><i
                                                                                                class="bi bi-trash"></i>Supprimer</button>
                                                                                    </form>
                                                                                </li> --}}
                                                                            </ul>
                                                                        </div>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            {{-- Détail Modules --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade module-overview pt-3" id="module-overview">
                                    @if (isset($module))
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">
                                                {{ $module?->name }}
                                                <a class="btn btn-info btn-sm" title=""
                                                    href="{{ route('modules.show', $module?->id) }}"><i
                                                        class="bi bi-eye"></i></a>&nbsp;
                                                <a href="{{ url('formationmodules', ['$idformation' => $formation->id, '$idlocalite' => $formation->departement->region->id]) }}"
                                                    class="btn btn-primary float-end btn-sm">
                                                    <i class="bi bi-pencil" title="Changer module"></i> </a>
                                            </h5>
                                        </div>
                                    @else
                                        <div class="pt-1">
                                            <a href="{{ url('moduleformations', ['$idformation' => $formation->id, '$idlocalite' => $formation->departement->region->id]) }}"
                                                class="btn btn-primary float-end btn-sm">
                                                <i class="bi bi-plus" title="Ajouter module"></i> </a>
                                        </div>
                                    @endif
                                    {{-- <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        @isset($operateur)
                                            <h1 class="card-title">
                                                @if (isset($module))
                                                    Liste des formations en {{ $module?->name }}
                                                @endif
                                            </h1>
                                            <div class="row g-3">
                                                <table class="table table-bordered table-hover datatables"
                                                    id="table-formations">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Type</th>
                                                            <th>Intitulé formation</th>
                                                            <th>Localité</th>
                                                            <th>Effectif</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($module?->formations as $formation)
                                                            <tr>
                                                                <td>{{ $formation?->code }}</td>
                                                                <td><a
                                                                        href="#">{{ $formation->types_formation?->name }}</a>
                                                                </td>
                                                                <td>{{ $formation?->name }}</td>
                                                                <td>{{ $formation->departement?->region?->nom }}</td>
                                                                <td class="text-center">
                                                                    @foreach ($formation->individuelles as $individuelle)
                                                                        @if ($loop->last)
                                                                            <a class="text-primary fw-bold"
                                                                                href="{{ route('formations.show', $formation->id) }}">{!! $loop->count ?? '0' !!}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td><a href="#"><span
                                                                            class="{{ $formation?->statut }}">{{ $formation?->statut }}</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                </table>
                                            </div>
                                        @endisset
                                    </div> --}}

                                </div>
                            </div>
                            {{-- Détail ingenieur --}}
                            <div class="tab-content">
                                <div class="tab-pane fade ingenieur-overview" id="ingenieur-overview">
                                    @isset($module)
                                        @if (isset($ingenieur))
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="card-title">
                                                    {{ $ingenieur?->name }}
                                                    <a class="btn btn-info btn-sm" title=""
                                                        href="{{ route('ingenieurs.show', $ingenieur?->id) }}"><i
                                                            class="bi bi-eye"></i></a>&nbsp;
                                                    <a href="{{ url('formationingenieurs', ['$idformation' => $formation->id]) }}"
                                                        class="btn btn-primary float-end btn-sm">
                                                        <i class="bi bi-pencil" title="Changer ingenieur"></i> </a>
                                                </h5>
                                                <h5 class="card-title">
                                                    Agent de suivi
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#EditAgentSuiviModal{{ $formation->id }}">
                                                        <i class="bi bi-plus" title="Ajouter un agent de suivi"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                        @else
                                            <div class="pt-1">
                                                <a href="{{ url('formationingenieurs', ['$idformation' => $formation->id]) }}"
                                                    class="btn btn-primary float-end btn-sm">
                                                    <i class="bi bi-plus" title="Ajouter ingenieur"></i> </a>

                                                {{--  <form action="{{ route('ingenieurformations') }}" method="post" target="_blank">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $formation->id }}">
                                                <button class="btn btn-primary float-end btn-sm">Ajouter</button>
                                            </form> --}}
                                            </div>
                                        @endif
                                    @endisset
                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        @isset($ingenieur)
                                            <h1 class="card-title">
                                                Liste des formations
                                                @if (isset($ingenieur))
                                                    de {{ $ingenieur?->name }}
                                                @endif
                                            </h1>
                                            <div class="row g-3">
                                                <table class="table table-bordered table-hover datatables"
                                                    id="table-formations">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Type</th>
                                                            <th>Intitulé formation</th>
                                                            <th>Localité</th>
                                                            {{-- <th>Modules</th> --}}
                                                            {{-- <th>Niveau qualification</th> --}}
                                                            <th>Effectif</th>
                                                            <th>Statut</th>
                                                            <th class="text-center"><i class="bi bi-gear"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($ingenieur?->formations as $ingenieurformation)
                                                            <tr>
                                                                <td>{{ $ingenieurformation?->code }}</td>
                                                                <td><a
                                                                        href="#">{{ $ingenieurformation->types_formation?->name }}</a>
                                                                </td>
                                                                <td>{{ $ingenieurformation?->name }}</td>
                                                                <td>{{ $ingenieurformation->departement?->region?->nom }}</td>
                                                                {{-- <td>{{ $ingenieurformation->module?->name }}</td> --}}
                                                                {{-- <td>{{ $ingenieurformation->niveau_qualification }}</td> --}}
                                                                <td class="text-center">
                                                                    @foreach ($ingenieurformation->individuelles as $individuelle)
                                                                        @if ($loop->last)
                                                                            <a class="text-primary fw-bold"
                                                                                href="{{ route('formations.show', $ingenieurformation->id) }}">{!! $loop->count ?? '0' !!}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td><a href="#"><span
                                                                            class="{{ $ingenieurformation?->statut }}">{{ $ingenieurformation?->statut }}</span></a>
                                                                </td>
                                                                <td>
                                                                    <span class="d-flex align-items-baseline"><a
                                                                            href="{{ route('formations.show', $ingenieurformation->id) }}"
                                                                            class="btn btn-primary btn-sm"
                                                                            title="voir détails"><i class="bi bi-eye"></i></a>
                                                                        <div class="filter">
                                                                            <a class="icon" href="#"
                                                                                data-bs-toggle="dropdown"><i
                                                                                    class="bi bi-three-dots"></i></a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                <li><a class="dropdown-item btn btn-sm"
                                                                                        href="{{ route('formations.edit', $ingenieurformation->id) }}"
                                                                                        class="mx-1" title="Modifier"><i
                                                                                            class="bi bi-pencil"></i>Modifier</a>
                                                                                </li>
                                                                                <li>
                                                                                    <form
                                                                                        action="{{ route('formations.destroy', $ingenieurformation->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="dropdown-item show_confirm"
                                                                                            title="Supprimer"><i
                                                                                                class="bi bi-trash"></i>Supprimer</button>
                                                                                    </form>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                </table>
                                            </div>
                                        @endisset
                                    </div>

                                </div>
                            </div>
                            {{-- Evaluation --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade module-overview pt-3" id="evaluation-overview">
                                    @isset($module)
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <form method="post"
                                                action="{{ url('notedemandeurs', ['$idformation' => $formation->id]) }}"
                                                enctype="multipart/form-data" class="row g-3">
                                                @csrf
                                                @method('PUT')
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h1 class="card-title"> Liste des bénéficiaires :
                                                        {{ $count_demandes }}</h1>
                                                    <h5 class="card-title">
                                                        Membres du jury
                                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#EditMembresJuryModal{{ $formation->id }}">
                                                            <i class="bi bi-plus" title="Ajouter les membres du jury"></i>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div class="row g-3">
                                                    <table class="table table-bordered table-hover datatables"
                                                        id="table-evaluation">
                                                        <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                {{-- <th>Numéro</th> --}}
                                                                <th>Civilité</th>
                                                                <th>CIN</th>
                                                                <th>Prénom</th>
                                                                <th>NOM</th>
                                                                <th>Date naissance</th>
                                                                <th>Lieu de naissance</th>
                                                                <th>Note<span class="text-danger mx-1">*</span></th>
                                                                <th>Observations</th>
                                                                {{-- <th class="col"><i class="bi bi-gear"></i></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>                                                            
                                                        @foreach ($formation->individuelles as $individuelle)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    {{-- <td>{{ $individuelle?->numero }}</td> --}}
                                                                    <td>{{ $individuelle?->user?->civilite }}</td>
                                                                    <td>{{ $individuelle?->user?->cin }}</td>
                                                                    <td>{{ $individuelle?->user?->firstname }}</td>
                                                                    <td>{{ $individuelle?->user?->name }}</td>
                                                                    <td>{{ $individuelle?->user->date_naissance?->format('d/m/Y') }}
                                                                    </td>
                                                                    <td>{{ $individuelle?->user->lieu_naissance }}</td>
                                                                    <td><input type="number"
                                                                            value="{{ $individuelle?->note_obtenue }}"
                                                                            name="notes[]" placeholder="note" step="0.01"
                                                                            min="0" max="20">
                                                                        <input type="hidden" name="individuelles[]"
                                                                            value="{{ $individuelle?->id }}">
                                                                    </td>
                                                                    <td style="text-align: center; vertical-align: middle;">
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#EditDemandeurModal{{ $individuelle->id }}">
                                                                            <i class="bi bi-plus" title="Observations"></i>
                                                                        </button>
                                                                    </td>
                                                                    {{-- <td>
                                                                    <span class="d-flex align-items-baseline"><a
                                                                            href="{{ route('individuelles.show', $individuelle->id) }}"
                                                                            class="btn btn-primary btn-sm"
                                                                            title="voir détails"><i class="bi bi-eye"></i></a>
                                                                        <div class="filter">
                                                                            <a class="icon" href="#"
                                                                                data-bs-toggle="dropdown"><i
                                                                                    class="bi bi-three-dots"></i></a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                <li>
                                                                                    <a class="btn btn-danger btn-sm"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#indiponibleModal{{ $individuelle->id }}"
                                                                                        title="retirer">Retirer de cette
                                                                                        formation
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </span>
                                                                </td> --}}
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    </table>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-outline-primary"><i
                                                            class="bi bi-check2-circle"></i>&nbsp;Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Operateur-->
        @foreach ($formation->individuelles as $individuelle)
            <div class="modal fade" id="indiponibleModal{{ $individuelle->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ url('indisponibles', ['$idformation' => $formation->id]) }}"
                            enctype="multipart/form-data" class="row">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Retirer demandeur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="individuelleid" value="{{ $individuelle->id }}">
                                <label for="motif" class="form-label">Justification du retrait</label>
                                <textarea name="motif" id="motif" rows="5"
                                    class="form-control form-control-sm @error('motif') is-invalid @enderror"
                                    placeholder="Expliquer les raisons du retrait de ce bénéficiaire">{{ old('motif') }}</textarea>
                                @error('motif')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="bi bi-arrow-right-circle"></i>
                                    Retirer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="modal fade" id="RejetDemandeModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('validation-formations.destroy', $formation->id) }}"
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
                                Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Observations --}}
        @foreach ($formation->individuelles as $individuelle)
            <div class="modal fade" id="EditDemandeurModal{{ $individuelle->id }}" tabindex="-1" role="dialog"
                aria-labelledby="EditDemandeurModalLabel{{ $individuelle->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ route('individuelles.updateObservations') }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('patch')
                            <div class="modal-header" id="EditDemandeurModalLabel{{ $individuelle->id }}">
                                <h5 class="modal-title">Ajouter un commentaire ou une observation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $individuelle->id }}">
                                <label for="floatingInput" class="mb-3">Observation<span
                                        class="text-danger mx-1">*</span></label>
                                <textarea name="observations" id="observations" cols="30" rows="5"
                                    class="form-control form-control-sm @error('observations') is-invalid @enderror" placeholder="Observations"
                                    autofocus>{{ $individuelle->observations ?? old('observations') }}</textarea>
                                @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                    Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- Agent de suivi --}}
        <div class="modal fade" id="EditAgentSuiviModal{{ $formation->id }}" tabindex="-1" role="dialog"
            aria-labelledby="EditAgentSuiviModalLabel{{ $formation->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('formations.updateAgentSuivi') }}"
                        enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('patch')
                        <div class="modal-header" id="EditAgentSuiviModalLabel{{ $formation->id }}">
                            <h5 class="modal-title">Ajouter un agent de suivi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $formation->id }}">
                            <div class="form-floating mb-3">
                                <input type="text" name="suivi_dossier"
                                    value="{{ $formation?->suivi_dossier ?? old('suivi_dossier') }}"
                                    class="form-control form-control-sm @error('suivi_dossier') is-invalid @enderror"
                                    id="suivi_dossier" placeholder="Nom de l'agent de suivi" autofocus>
                                @error('suivi_dossier')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                <label for="floatingInput">Agent suivi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" name="date_suivi"
                                    value="{{ $formation?->date_suivi?->format('Y-m-d') ?? old('date_suivi') }}"
                                    class="form-control form-control-sm @error('date_suivi') is-invalid @enderror"
                                    id="date_suivi" placeholder="Date suivi">
                                @error('date_suivi')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                <label for="floatingInput">Date suivi</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                Vavilider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Membres du jury --}}
        <div class="modal fade" id="EditMembresJuryModal{{ $formation->id }}" tabindex="-1" role="dialog"
            aria-labelledby="EditMembresJuryModalLabel{{ $formation->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ route('formations.updateMembresJury') }}"
                        enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('patch')
                        <div class="modal-header" id="EditMembresJuryModalLabel{{ $formation->id }}">
                            <h5 class="modal-title">Evaluation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $formation->id }}">

                            <div class="mb-3">
                                <label>N° convention<span class="text-danger mx-1">*</span></label>
                                <input type="text" name="numero_convention"
                                    value="{{ $formation?->numero_convention ?? old('numero_convention') }}"
                                    class="form-control form-control-sm @error('numero_convention') is-invalid @enderror"
                                    id="numero_convention" placeholder="n° convention">
                                @error('numero_convention')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Date évaluation<span class="text-danger mx-1">*</span></label>
                                <input type="date" name="date_pv"
                                    value="{{ $formation?->date_pv?->format('Y-m-d') ?? old('date_pv') }}"
                                    class="form-control form-control-sm @error('date_pv') is-invalid @enderror"
                                    id="date_pv" placeholder="date_pv">
                                @error('date_pv')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="evaluateur" class="form-label">Evaluateur<span
                                        class="text-danger mx-1">*</span></label>
                                <select name="evaluateur" class="form-select @error('evaluateur') is-invalid @enderror"
                                    aria-label="Select" id="select-field" data-placeholder="Choisir evaluateur">
                                    <option value="{{ $formation?->evaluateur?->id }}">
                                        {{ $formation?->evaluateur?->name . ', ' . $formation?->evaluateur?->fonction }}
                                    </option>
                                    @foreach ($evaluateurs as $evaluateur)
                                        <option value="{{ $evaluateur->id }}">
                                            {{ $evaluateur?->name . ', ' . $evaluateur?->fonction . ' [NE : ' . $evaluateur?->formations->count() . ']' ?? old('evaluateur') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('evaluateur')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Montant indemnité de membre <span class="text-danger mx-1">*</span></label>
                                <input type="number" name="frais_evaluateur" min="0" step="0.001"
                                    value="{{ $formation?->frais_evaluateur ?? old('frais_evaluateur') }}"
                                    class="form-control form-control-sm @error('frais_evaluateur') is-invalid @enderror"
                                    id="frais_evaluateur" placeholder="Montant indemnité de membre ">
                                @error('frais_evaluateur')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-9 col-lg-9 mb-3">
                                    <label>Evaluateur ONFP<span class="text-danger mx-1">*</span></label>
                                    <input type="text" name="nom_evaluateur_onfp"
                                        value="{{ $formation?->evaluateur_onfp ?? old('nom_evaluateur_onfp') }}"
                                        class="form-control form-control-sm @error('nom_evaluateur_onfp') is-invalid @enderror"
                                        id="nom_evaluateur_onfp" placeholder="Nom évaluateur onfp">
                                    @error('nom_evaluateur_onfp')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-3 col-lg-3 mb-3">
                                    <label>Initiale<span class="text-danger mx-1">*</span></label>
                                    <input type="text" name="initiale_evaluateur_onfp"
                                        value="{{ $formation?->initiale_evaluateur_onfp ?? old('initiale_evaluateur_onfp') }}"
                                        class="form-control form-control-sm @error('initiale_evaluateur_onfp') is-invalid @enderror"
                                        id="initiale_evaluateur_onfp" placeholder="Initiale évaluateur onfp">
                                    @error('initiale_evaluateur_onfp')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Type de certificat délivré<span class="text-danger mx-1">*</span></label>
                                <input type="text" name="type_certificat" min="0" step="0.001"
                                    value="{{ $formation?->type_certificat ?? old('type_certificat') }}"
                                    class="form-control form-control-sm @error('type_certificat') is-invalid @enderror"
                                    id="type_certificat" placeholder="Attestation ou Titre ">
                                @error('type_certificat')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">

                                <label for="membres_jury">Membres du jury</label>

                                <textarea name="membres_jury" id="membres_jury" cols="30" rows="3"
                                    class="form-control form-control-sm @error('membres_jury') is-invalid @enderror"
                                    placeholder="Membre 1; Membre 2; Membre 3 " autofocus>{{ $formation->membres_jury ?? old('membres_jury') }}</textarea>

                                {{-- <input type="text" name="membres_jury"
                                    value="{{ $formation?->membres_jury ?? old('membres_jury') }}"
                                    class="form-control form-control-sm @error('membres_jury') is-invalid @enderror"
                                    id="membres_jury" placeholder="Ajouter membres du jury" autofocus> --}}
                                @error('membres_jury')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">

                                <label for="recommandations">Recommandations</label>

                                <textarea name="recommandations" id="recommandations" cols="30" rows="3s"
                                    class="form-control form-control-sm @error('recommandations') is-invalid @enderror" placeholder="Recommandations"
                                    autofocus>{{ $formation?->recommandations ?? old('recommandations') }}</textarea>
                                @error('recommandations')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                Vavilider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        new DataTable('#table-operateurModules', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                }
            },
            "order": [
                [0, 'asc']
            ],
            language: {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                    "rows": {
                        _: "%d lignes sÃ©lÃ©ctionnÃ©es",
                        0: "Aucune ligne sÃ©lÃ©ctionnÃ©e",
                        1: "1 ligne sÃ©lÃ©ctionnÃ©e"
                    }
                }
            }
        });
    </script>
@endpush
