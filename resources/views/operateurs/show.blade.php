@extends('layout.user-layout')
@section('title', 'ONFP - Operateurs')
@section('space-work')

    <section
        class="section profile min-vh-0 d-flex flex-column align-items-center justify-content-center py-0 section profile">
        <div class="container">
            <div class="pagetitle">
                {{-- <h1>Data Tables</h1> --}}
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">Opérateurs</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
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
                                    <span class="nav-link"><a href="{{ route('operateurs.index', $operateur->id) }}"
                                            class="btn btn-secondary btn-sm" title="retour"><i
                                                class="bi bi-arrow-counterclockwise"></i></a>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview"><i
                                            class="bi bi-eye"></i> Opérateur</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#responsable-overview"><i
                                            class="bi bi-person"></i> Représentant</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#module-overview">Modules
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#foration-overview">Formations</button>
                                </li>

                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- <span class="d-flex align-items-baseline"><a
                                    href="{{ route('operateurs.index', $operateur->id) }}" class="btn btn-secondary btn-sm"
                                    title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                <p> | Retour</p>
                            </span> --}}
                                {{-- <button type="button" class="btn btn-primary float-end btn-rounded" data-bs-toggle="modal"
                                data-bs-target="#AddOperateurModal">
                                <i class="bi bi-person-plus" title="Ajouter"></i>
                            </button> --}}
                            </div>
                            {{-- Détail opérateur --}}
                            <div class="tab-content pt-0">
                                <div class="tab-pane fade profile-overview pt-3" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Opérateur</h5>
                                        <div class="col-12 col-md-9 col-lg-9 mb-0">
                                            <div class="label">Raison sociale</div>
                                            <div>{{ $operateur?->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Sigle</div>
                                            <div>{{ $operateur?->sigle }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Numéro agrément</div>
                                            <div>{{ $operateur?->numero_agrement }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Adresse email</div>
                                            <div><a href="mailto:{{ $operateur?->email1 }}">{{ $operateur?->email1 }}</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone fixe</div>
                                            <div><a href="tel:+221{{ $operateur?->fixe }}">{{ $operateur?->fixe }}</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone portable</div>
                                            <div><a
                                                    href="tel:+221{{ $operateur?->telephone1 }}">{{ $operateur?->telephone1 }}</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Boite postale</div>
                                            <div>{{ $operateur?->user?->bp }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Catégorie</div>
                                            <div>{{ $operateur?->categorie }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Statut juridique</div>
                                            <div>{{ $operateur?->statut }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Autre statut</div>
                                            <div>{{ $operateur?->autre_statut }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Siège</div>
                                            <div>{{ $operateur?->departement?->nom }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Adrese</div>
                                            <div>{{ $operateur?->adresse }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">RCCM/Ninea</div>
                                            <div>{{ $operateur?->rccm }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">N° RCCM/Ninea</div>
                                            <div>{{ $operateur?->ninea }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Quitus</div>
                                            <div>{{ $operateur?->quitus }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Date délivrance quitus</div>
                                            <div>{{ $operateur?->debut_quitus?->diffForHumans() }}</div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            {{-- Détail représentant --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="responsable-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Représentant</h5>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Civilité</div>
                                            <div>{{ $operateur?->user?->civilite }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Prénom</div>
                                            <div>{{ $operateur->prenom_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Nom</div>
                                            <div>{{ $operateur->nom_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Email</div>
                                            <div><a href="mailto:{{ $operateur->email2 }}">{{ $operateur->email2 }}</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone</div>
                                            <div><a
                                                    href="tel:+221{{ $operateur->telephone2 }}">{{ $operateur->telephone2 }}</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Fonction responsable</div>
                                            <div>{{ $operateur->fonction_responsable }}</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Détail Modules --}}
                            {{-- class show et active pour l'affichage par défaut --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview pt-3" id="module-overview">
                                    <form method="post" action="{{ url('operateurmodules') }}"
                                        enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <h5 class="card-title">Ajouter nouveau module</h5>
                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                <tr>
                                                    <th>Modules<span class="text-danger mx-1">*</span></th>
                                                    <th>Niveau qualification<span class="text-danger mx-1">*</span></th>
                                                    <th>Domaines<span class="text-danger mx-1">*</span></th>
                                                    {{-- <th width="5%"><i class="bi bi-gear"></i></th> --}}
                                                </tr>
                                                {{-- <tr>
                                                    <td><input type="text" name="modules[0][module]"
                                                            placeholder="Entrer un module"
                                                            class="form-control form-control-sm" autofocus /></td>
                                                    <td><input type="text" name="niveau_qualifications[0][niveau_qualification]"
                                                            placeholder="Entrer niveau qualification"
                                                            class="form-control form-control-sm" /></td>
                                                    <td><input type="text" name="domaines[0][domaine]"
                                                            placeholder="Entrer un domaine"
                                                            class="form-control form-control-sm" /></td>
                                                    <td><button type="button" name="add" id="add-btn"
                                                            class="btn btn-success btn-sm" title="Ajouter une ligne"><i
                                                                class="bi bi-plus-lg"></i></button>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <input type="hidden" name="operateur" value="{{ $operateur->id }}">
                                                    <td><input type="text" name="module"
                                                            placeholder="Entrer un module"
                                                            class="form-control form-control-sm" autofocus /></td>
                                                    <td><input type="text" name="niveau_qualification"
                                                            placeholder="Entrer niveau qualification"
                                                            class="form-control form-control-sm" /></td>
                                                    <td><input type="text" name="domaine"
                                                            placeholder="Entrer un domaine"
                                                            class="form-control form-control-sm" /></td>
                                                    {{-- <td><button type="button" name="add" id="add-btn"
                                                            class="btn btn-success btn-sm" title="Ajouter une ligne"><i
                                                                class="bi bi-plus-lg"></i></button>
                                                    </td> --}}
                                                </tr>
                                            </table>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2">
                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                        class="bi bi-printer"></i> Enregistrer</button>
                                            </div>
                                        </div>

                                    </form><!-- End module -->

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <h5 class="card-title">Modules</h5>
                                        {{-- <form method="post" action="#" enctype="multipart/form-data"
                                            class="row g-3"> --}}
                                        <div class="row g-3">
                                            <table
                                                class="table datatables align-middle justify-content-center table-borderless"
                                                id="table-operateurModules">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Module</th>
                                                        <th scope="col">Niveau qualification</th>
                                                        <th scope="col">Domaine</th>
                                                        <th scope="col">Statut</th>
                                                        <th class="col"><i class="bi bi-gear"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($operateur->operateurmodules as $operateurmodule)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td>{{ $operateurmodule->module }}</td>
                                                            <td>{{ $operateurmodule->niveau_qualification }}</td>
                                                            <td>{{ $operateurmodule->domaine }}</td>
                                                            <td>
                                                                {{-- @foreach ($operateurmodule->moduleoperateurstatuts as $moduleoperateurstatut)
                                                                    @if ($loop->last)
                                                                        <span
                                                                            class="badge bg-info">{{ $moduleoperateurstatut->statut }}</span>
                                                                    @endif
                                                                @endforeach --}}

                                                                @if ($operateurmodule?->statut == 'Validé')
                                                                    <button
                                                                        class="btn btn-success btn-sm text-white">{{ $operateurmodule->statut }}</button>
                                                                @elseif($operateurmodule?->statut == 'Rejeté')
                                                                    <button
                                                                        class="btn btn-danger btn-sm text-white">{{ $operateurmodule->statut }}</button>
                                                                @elseif($operateurmodule?->statut == 'Attente')
                                                                    <button
                                                                        class="btn btn-secondary btn-sm text-white">{{ $operateurmodule->statut }}</button>
                                                                @else
                                                                    <button
                                                                        class="btn btn-warning btn-sm text-white">{{ $operateurmodule->statut }}</button>
                                                                @endif
                                                            </td>
                                                            {{--     <td>
                                                                @isset($individuelle?->statut)
                                                                    @if ($individuelle?->statut == 'Attente')
                                                                        <span
                                                                            class="badge bg-secondary text-white">{{ $individuelle?->statut }}
                                                                        </span>
                                                                    @endif
                                                                    @if ($individuelle?->statut == 'Validée')
                                                                        <span
                                                                            class="badge bg-success text-white">{{ $individuelle?->statut }}
                                                                        </span>
                                                                    @endif
                                                                    @if ($individuelle?->statut == 'Rejetée')
                                                                        <span
                                                                            class="badge bg-danger text-white">{{ $individuelle?->statut }}
                                                                        </span>
                                                                    @endif
                                                                @endisset
                                                            </td> --}}
                                                            <td>
                                                                <span class="d-flex align-items-baseline">
                                                                    {{--  <a class="btn btn-success btn-sm"
                                                                        href="{{ route('individuelles.edit', $individuelle->id) }}"
                                                                        class="mx-1" title="Modifier"><i class="bi bi-pencil"></i></a> --}}

                                                                    {{-- <a href="{{ route('operateurmodules.show', $operateurmodule->id) }}" --}}
                                                                    <a href="{{ route('operateurmodules.show', $operateurmodule->id) }}"
                                                                        class="btn btn-primary btn-sm"
                                                                        title="voir détails"><i class="bi bi-eye"></i></a>
                                                                    <div class="filter">
                                                                        <a class="icon" href="#"
                                                                            data-bs-toggle="dropdown"><i
                                                                                class="bi bi-three-dots"></i></a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <button class="dropdown-item btn btn-sm mx-1"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#EditOperateurmoduleModal{{ $operateurmodule->id }}">Modifier
                                                                            </button>
                                                                            @if ($operateurmodule?->statut == 'Validé')
                                                                                <button
                                                                                    class="dropdown-item btn btn-sm mx-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#AddRegionModal{{ $operateurmodule->id }}">Rejeter
                                                                                </button>
                                                                            @elseif($operateurmodule?->statut == 'Rejeté')
                                                                                <form
                                                                                    action="{{ route('validation-operateur-modules.update', $operateurmodule->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <button
                                                                                        class="show_confirm_valider dropdown-item btn btn-sm mx-1">Valider</button>
                                                                                </form>
                                                                            @elseif($operateurmodule?->statut == 'Attente')
                                                                                <form
                                                                                    action="{{ route('validation-operateur-modules.update', $operateurmodule->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <button
                                                                                        class="show_confirm_valider dropdown-item btn btn-sm mx-1">Valider</button>
                                                                                </form>
                                                                                <button
                                                                                    class="dropdown-item btn btn-sm mx-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#AddRegionModal{{ $operateurmodule->id }}">Rejeter
                                                                                </button>
                                                                            @else
                                                                                {{-- <button class="btn btn-sm mx-1">Aucune
                                                                                    action
                                                                                    possible</button> --}}
                                                                            @endif
                                                                            {{-- <li>
                                                                                <button type="button"
                                                                                    class="dropdown-item btn btn-sm mx-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#myModal{{ $operateurmodule->id }}">
                                                                                    <i class="bi bi-trash"
                                                                                        title="Supprimer"></i> Supprimer
                                                                                </button>
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
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- Détail Formations --}}
                            <div class="tab-content">
                                <div class="tab-pane fade profile-overview pt-1" id="foration-overview">
                                    <h5 class="card-title">Liste des formations</h5>
                                    <table class="table datatables" id="table-formations">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Type</th>
                                                <th>Intitulé formation</th>
                                                <th>Localité</th>
                                                <th>Modules</th>
                                                {{-- <th>Niveau qualification</th> --}}
                                                <th>Effectif</th>
                                                <th>Statut</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($operateur?->formations as $formation)
                                                <tr>
                                                    <td>{{ $formation?->code }}</td>
                                                    <td><a href="#">{{ $formation->types_formation?->name }}</a>
                                                    </td>
                                                    <td>{{ $formation?->name }}</td>
                                                    <td>{{ $formation->departement?->region?->nom }}</td>
                                                    <td>{{ $formation->module?->name }}</td>
                                                    {{-- <td>{{ $formation->niveau_qualification }}</td> --}}
                                                    <td class="text-center">
                                                        @foreach ($formation->individuelles as $individuelle)
                                                            @if ($loop->last)
                                                                <a class="text-primary fw-bold"
                                                                    href="{{ route('formations.show', $formation->id) }}">{!! $loop->count ?? '0' !!}</a>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td><a href="#">{{ $formation?->statut }}</a></td>
                                                    <td>
                                                        <span class="d-flex align-items-baseline"><a
                                                                href="{{ route('formations.show', $formation->id) }}"
                                                                class="btn btn-primary btn-sm" title="voir détails"><i
                                                                    class="bi bi-eye"></i></a>
                                                            <div class="filter">
                                                                <a class="icon" href="#"
                                                                    data-bs-toggle="dropdown"><i
                                                                        class="bi bi-three-dots"></i></a>
                                                                <ul
                                                                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                    <li><a class="dropdown-item btn btn-sm"
                                                                            href="{{ route('formations.edit', $formation->id) }}"
                                                                            class="mx-1" title="Modifier"><i
                                                                                class="bi bi-pencil"></i>Modifier</a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('formations.destroy', $formation->id) }}"
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
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Operateur-->
        <!-- Edit Operateur Module -->
        @foreach ($operateur->operateurmodules as $operateurmodule)
            <div class="modal fade" id="EditOperateurmoduleModal{{ $operateurmodule->id }}" tabindex="-1"
                role="dialog" aria-labelledby="EditOperateurmoduleModalLabel{{ $operateurmodule->id }}"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {{-- <form method="POST" action="#">
                            @csrf --}}
                        <form method="post" action="{{ route('operateurmodules.update', $operateurmodule->id) }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('patch')
                            <div class="modal-header" id="EditOperateurmoduleModalLabel{{ $operateurmodule->id }}">
                                <h5 class="modal-title"><i class="bi bi-pencil" title="Ajouter"></i> Modifier module
                                    opérateur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $operateurmodule->id }}">
                                <div class="form-floating mb-3">
                                    <input type="text" name="module"
                                        value="{{ $operateurmodule?->module ?? old('module') }}"
                                        class="form-control form-control-sm @error('module') is-invalid @enderror"
                                        placeholder="Module" autofocus>
                                    @error('module')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    <label for="floatingInput">Module</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="niveau_qualification"
                                        value="{{ $operateurmodule->niveau_qualification ?? old('niveau_qualification') }}"
                                        class="form-control form-control-sm @error('niveau_qualification') is-invalid @enderror"
                                        id="niveau_qualification" placeholder="Niveau qualification">
                                    @error('niveau_qualification')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    <label for="floatingInput">Niveau qualification</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="domaine"
                                        value="{{ $operateurmodule->domaine ?? old('domaine') }}"
                                        class="form-control form-control-sm @error('domaine') is-invalid @enderror"
                                        id="domaine" placeholder="Domaine">
                                    @error('domaine')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    <label for="floatingInput">Domaine</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                    Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- End Edit Operateur Module-->
        <!-- The Modal Delete -->
        @foreach ($operateur->operateurmodules as $operateurmodule)
            <div class="modal" id="myModal{{ $operateurmodule->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmation</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Êtes-vous sûre de bien vouloir supprimer ?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form method="post" action="{{ route('operateurmodules.destroy', $operateurmodule->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Non</button>
                                    <button class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Oui
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach ($operateur->operateurmodules as $operateurmodule)
            <div class="modal fade" id="AddRegionModal{{ $operateurmodule->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {{-- <form method="POST" action="{{ route('addRegion') }}">
                        @csrf --}}
                        <form method="post"
                            action="{{ route('validation-operateur-modules.destroy', $operateurmodule->id) }}"
                            enctype="multipart/form-data" class="row">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Rejet module</h5>
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
        @endforeach
    </section>

@endsection
{{-- @push('scripts')
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="modules[' + i +
                '][module]" placeholder="Entrer module" class="form-control" /></td> <td><input type="text" name="niveau_qualifications[' + i +
                '][niveau_qualification]" placeholder="Entrer niveau de qualification" class="form-control" /></td><td><input type="text" name="domaines[' + i +
                '][domaine]" placeholder="Entrer domaine" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr"><i class="bi bi-trash"></i></button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush --}}
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
