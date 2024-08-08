@extends('layout.user-layout')
@section('title', 'ONFP - ' . $projet?->name)
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
                        <li class="breadcrumb-item active">Projet {{ $projet?->sigle }}</li>
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
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Projet
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#modules-overview">Modules</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"><a
                                            href="{{ route('showLocalites', ['id' => $projet->id]) }}" target="_blank"
                                            rel="noopener noreferrer">Localités</a>

                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane fade profile-overview" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">À propos</h5>
                                        <p class="fst-italic">{{ $projet?->description }}</p>

                                        <h5 class="card-title">Détails projet</h5>

                                        <div class="row col-12 col-md-12 col-lg-12 mb-2">
                                            <div class="label">Intitulé projet / programme</div>
                                            <div>{{ $projet?->name }}</div>
                                        </div>

                                        <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                            <div class="label">Sigle projet / programme</div>
                                            <div>{{ $projet?->sigle }}</div>
                                        </div>

                                        <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                            <div class="label">Date signature</div>
                                            <div>{{ $projet?->date_signature?->format('d/m/Y') }}</div>
                                        </div>
                                        @isset($projet->budjet)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Budjet</div>
                                                <div>{{ number_format($projet?->budjet, 2, ',', ' ') }}</div>
                                            </div>
                                        @endisset
                                        @isset($projet?->duree)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Durée</div>
                                                <div>{{ $projet?->duree }}</div>
                                            </div>
                                        @endisset
                                        @isset($projet?->debut)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Date début</div>
                                                <div>{{ $projet?->debut?->format('d/m/Y') }}</div>
                                            </div>
                                        @endisset
                                        @isset($projet?->fin)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Date fin</div>
                                                <div>{{ $projet?->fin?->format('d/m/Y') }}</div>
                                            </div>
                                        @endisset
                                    </form>
                                </div>
                                <div class="tab-pane fade show active profile-overview" id="modules-overview">
                                    <form method="post" action="{{ url('projetmodules') }}" enctype="multipart/form-data"
                                        class="row g-3">
                                        @csrf
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <h5 class="card-title">Ajouter nouveau module</h5>
                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                <tr>
                                                    <th>Modules<span class="text-danger mx-1">*</span></th>
                                                    <th>Domaines<span class="text-danger mx-1">*</span></th>
                                                    <th>Effectif<span class="text-danger mx-1">*</span></th>
                                                </tr>
                                                <tr>
                                                    <input type="hidden" name="projet" value="{{ $projet->id }}">
                                                    <td>
                                                        <input type="text" name="module" id="module_name"
                                                            class="form-control form-control-sm"
                                                            placeholder="Enter module" />
                                                        <div id="countryList"></div>
                                                        {{ csrf_field() }}
                                                    </td>
                                                    <td><input type="text" name="domaine" placeholder="Entrer un domaine"
                                                            class="form-control form-control-sm" /></td>
                                                    <td><input type="text" name="effectif" placeholder="Entrer effectif"
                                                            class="form-control form-control-sm" /></td>
                                                </tr>
                                            </table>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-outline-success btn-sm"><i
                                                        class="bi bi-printer"></i> Enregistrer</button>
                                            </div>
                                        </div>
                                    </form><!-- End module -->
                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <h5 class="card-title">Modules</h5>
                                            <h5 class="card-title">Effectif total: {{ $projet?->effectif }}</h5>
                                        </div>
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
                                                        <th scope="col">Domaines</th>
                                                        <th scope="col">Effectif</th>
                                                        <th class="col"><i class="bi bi-gear"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($projet->projetmodules as $projetmodule)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td>{{ $projetmodule->module }}</td>
                                                            <td>{{ $projetmodule->domaine }}</td>
                                                            <td>{{ $projetmodule->effectif }}</td>
                                                            <td>
                                                                <span class="d-flex align-items-baseline">
                                                                    <a href="{{ route('projetmodules.show', $projetmodule->id) }}"
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
                                                                                data-bs-target="#EditprojetmoduleModal{{ $projetmodule->id }}">Modifier
                                                                            </button>
                                                                            {{-- <form
                                                                                action="{{ route('validation-projet-modules.update', $projetmodule->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button
                                                                                    class="show_confirm_valider dropdown-item btn btn-sm mx-1">Agréer</button>
                                                                            </form> --}}
                                                                            <button class="dropdown-item btn btn-sm mx-1"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#AddRegionModal{{ $projetmodule->id }}">Rejeter
                                                                            </button>
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
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($projet->projetmodules as $projetmodule)
                <div class="modal fade" id="EditprojetmoduleModal{{ $projetmodule->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="EditprojetmoduleModalLabel{{ $projetmodule->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {{-- <form method="POST" action="#">
                            @csrf --}}
                            <form method="post" action="{{ route('projetmodules.update', $projetmodule->id) }}"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('patch')
                                <div class="modal-header" id="EditprojetmoduleModalLabel{{ $projetmodule->id }}">
                                    <h5 class="modal-title"><i class="bi bi-pencil" title="Ajouter"></i> Modifier module
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $projetmodule->id }}">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="module"
                                            value="{{ $projetmodule?->module ?? old('module') }}"
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
                                        <input type="text" name="domaine"
                                            value="{{ $projetmodule->domaine ?? old('domaine') }}"
                                            class="form-control form-control-sm @error('domaine') is-invalid @enderror"
                                            id="domaine" placeholder="Domaine">
                                        @error('domaine')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                        <label for="floatingInput">Domaine</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" name="effectif" min="0" step="1"
                                            value="{{ $projetmodule->effectif ?? old('effectif') }}"
                                            class="form-control form-control-sm @error('effectif') is-invalid @enderror"
                                            id="effectif" placeholder="effectif">
                                        @error('effectif')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                        <label for="floatingInput">effectif</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                        Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
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
