@extends('layout.user-layout')
@section('title', 'ONFP - Formations')
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
                        <li class="breadcrumb-item active">Formations</li>
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

                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                            <div class="tab-content pt-0">
                                <div class="tab-pane fade profile-overview pt-3" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Détails formation</h5>
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <div class="label">Intitulé formation</div>
                                            <div>{{ $formation?->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Code</div>
                                            <div>{{ $formation?->code }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Module</div>
                                            <div>{{ $formation?->module?->name }}</div>
                                        </div>
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
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Date début</div>
                                            <div>{{ $formation?->date_debut }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Date fin</div>
                                            <div>{{ $formation?->date_fin }}</div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            {{-- Détail --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="responsable-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">
                                            <a
                                                href="#">{{ $formation?->operateur?->name . '(' . $formation?->operateur?->sigle . ')' }}</a>
                                        </h5>



                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <h5 class="card-title">Liste des formations</h5>
                                            <div class="row g-3">
                                                <table
                                                    class="table datatables align-middle justify-content-center table-borderless"
                                                    id="table-operateurFormations">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>CIN</th>
                                                            <th>Prénom et NOM</th>
                                                            <th>Date et lieu de naissance</th>
                                                            <th>Module</th>
                                                            <th class="text-center">Statut</th>
                                                            <th class="col"><i class="bi bi-gear"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($formation->individuelles as $individuelle)
                                                            @isset($formation->individuelle?->numero)
                                                                <tr>
                                                                    <td>{{ $individuelle?->numero }}
                                                                    </td>
                                                                    <td>{{ $individuelle->demandeur->user?->cin }}</td>
                                                                    <td>{{ $individuelle->demandeur->user?->firstname . ' ' . $individuelle->demandeur->user?->name }}
                                                                    </td>
                                                                    <td>{{ $individuelle->demandeur->user->date_naissance?->format('d/m/Y') . ' à ' . $individuelle->demandeur->user->lieu_naissance }}
                                                                    </td>
                                                                    <td>{{ $individuelle->module?->name }}</td>
                                                                    <td>
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
                                                                    </td>
                                                                    <td>
                                                                        <span class="d-flex align-items-baseline"><a
                                                                                href="{{ route('individuelles.show', $individuelle->id) }}"
                                                                                class="btn btn-primary btn-sm"
                                                                                title="voir détails"><i
                                                                                    class="bi bi-eye"></i></a>
                                                                            <div class="filter">
                                                                                <a class="icon" href="#"
                                                                                    data-bs-toggle="dropdown"><i
                                                                                        class="bi bi-three-dots"></i></a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                    <li><a class="dropdown-item btn btn-sm"
                                                                                            href="{{ route('individuelles.edit', $individuelle->id) }}"
                                                                                            class="mx-1" title="Modifier"><i
                                                                                                class="bi bi-pencil"></i>Modifier</a>
                                                                                    </li>
                                                                                    <li>
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
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endisset
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-content pt-0">
                                <div class="tab-pane fade show active profile-overview" id="beneficiaires-overview">
                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <div class="pt-1">
                                            <a href="{{ url('formationdemandeurs', ['$idformation' => $formation->id, '$idmodule' => $formation->module->id, '$idlocalite' => $formation->departement->id]) }}"
                                                class="btn btn-primary float-end btn-rounded"><i class="fas fa-plus"></i>
                                                <i class="bi bi-person-plus" title="Ajouter"></i> </a>
                                        </div>
                                        <h5 class="card-title">Liste des bénéficiaires</h5>
                                        <div class="row g-3">
                                            <table
                                                class="table datatables align-middle justify-content-center table-borderless"
                                                id="table-operateurModules">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Numéro</th>
                                                        <th>Civilité</th>
                                                        <th>CIN</th>
                                                        <th>Prénom</th>
                                                        <th>NOM</th>
                                                        <th>Date naissance</th>
                                                        <th>Lieu de naissance</th>
                                                        <th>Adresse</th>
                                                        <th class="col"><i class="bi bi-backspace-reverse"></i></th>
                                                        <th class="col"><i class="bi bi-gear"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($formation->individuelles as $individuelle)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $individuelle?->numero }}</td>
                                                            <td>{{ $individuelle->demandeur->user?->civilite }}</td>
                                                            <td>{{ $individuelle->demandeur->user?->cin }}</td>
                                                            <td>{{ $individuelle->demandeur->user?->firstname }}</td>
                                                            <td>{{ $individuelle->demandeur->user?->name }}</td>
                                                            <td>{{ $individuelle->demandeur->user->date_naissance?->format('d/m/Y') }}
                                                            </td>
                                                            <td>{{ $individuelle->demandeur->user->lieu_naissance }}</td>
                                                            <td>{{ $individuelle->demandeur->user->adresse }}</td>
                                                            <td>
                                                                <a class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#indiponibleModal" title="retirer"><i
                                                                    class="bi bi-arrow-right-circle"></i>
                                                                </a>
                                                                {{-- <a href="#" title="retirer">
                                                                    <span class="badge bg-info text-white"><i
                                                                            class="bi bi-arrow-right-circle"></i></span>
                                                                </a> --}}
                                                            </td>
                                                            <td>
                                                                <span class="d-flex align-items-baseline"><a
                                                                        href="{{ route('individuelles.show', $individuelle->id) }}"
                                                                        class="btn btn-primary btn-sm"
                                                                        title="voir détails"><i class="bi bi-eye"></i></a>
                                                                    {{-- <div class="filter">
                                                                            <a class="icon" href="#"
                                                                                data-bs-toggle="dropdown"><i
                                                                                    class="bi bi-three-dots"></i></a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                <li><a class="dropdown-item btn btn-sm"
                                                                                        href="{{ route('individuelles.edit', $individuelle->id) }}"
                                                                                        class="mx-1" title="Modifier"><i
                                                                                            class="bi bi-pencil"></i>Modifier</a>
                                                                                </li>
                                                                                <li>
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
                                                                                </li>
                                                                            </ul>
                                                                        </div> --}}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Détail Formations --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade module-overview pt-3" id="module-overview">
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
        <div class="modal fade" id="indiponibleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ url('indisponibles', ['$idformation' => $formation->id, '$idindividuelle' => $individuelle->id]) }}"
                        enctype="multipart/form-data" class="row">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Retirer demandeur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-arrow-right-circle"></i>
                                Retirer</button>
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
