@extends('layout.user-layout')
@section('title', 'ONFP - demandes operateurs')
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
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview"><i class="bi bi-eye"></i> Opérateur</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#responsable-overview"><i
                                            class="bi bi-person"></i> Représentant</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#module-overview">Modules
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#foration-overview">Formations</button>
                                </li>

                            </ul>
                            <div class="d-flex justify-content-between align-items-center mt-0">
                                {{-- <span class="d-flex mt-2 align-items-baseline"><a
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
                                <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
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
                                            <div>{{ $operateur?->email1 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone fixe</div>
                                            <div>{{ $operateur?->fixe }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone portable</div>
                                            <div>{{ $operateur?->telephone1 }}</div>
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
                                            <div>{{ $operateur->email2 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone</div>
                                            <div>{{ $operateur->telephone2 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Fonction responsable</div>
                                            <div>{{ $operateur->fonction_responsable }}</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Détail Modules --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="module-overview">
                                    <form method="post" action="{{ url('operateurmodules') }}"
                                        enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <h5 class="card-title">Ajouter nouveau module</h5>
                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                <tr>
                                                    <th>modules<span class="text-danger mx-1">*</span></th>
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
                                                class="table datatables align-middle justify-content-center table-borderless">
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
                                                            <td></td>
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

                                                                    <a href="{{ route('operateurmodules.show', $operateurmodule->id) }}"
                                                                        class="btn btn-success btn-sm"
                                                                        title="voir détails"><i class="bi bi-eye"></i></a>
                                                                    <div class="filter">
                                                                        <a class="icon" href="#"
                                                                            data-bs-toggle="dropdown"><i
                                                                                class="bi bi-three-dots"></i></a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li><a class="dropdown-item btn btn-sm"
                                                                                    href="{{ route('operateurmodules.edit', $operateurmodule->id) }}"
                                                                                    class="mx-1" title="Modifier"><i
                                                                                        class="bi bi-pencil"></i>Modifier</a>
                                                                            </li>
                                                                            <li>
                                                                                <form
                                                                                    action="{{ route('operateurmodules.destroy', $operateurmodule->id) }}"
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
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- Détail Formations --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="foration-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Formations</h5>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Operateur-->
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
