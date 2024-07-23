@extends('layout.user-layout')
@section('title', 'Demande collective - Détails')
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
                                    <span class="nav-link"><a href="{{ route('collectives.index', $collective->id) }}"
                                            class="btn btn-secondary btn-sm" title="retour"><i
                                                class="bi bi-arrow-counterclockwise"></i></a>
                                    </span>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Détails
                                        demande</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#module-overview">Module
                                    </button>
                                </li>

                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                            <div class="tab-content pt-0">
                                <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5>Détails formation 
                                            {{-- : <span class="{{ $collective?->statut_demande }}">
                                                {{ $collective?->statut_demande }}</span> --}}
                                        </h5>
                                        <div class="col-12 col-md-9 col-lg-9 mb-0">
                                            <div class="label">Nom structure</div>
                                            <div>{{ $collective?->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Sigle</div>
                                            <div>{{ $collective?->sigle }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Numéro dossier</div>
                                            <div>{{ $collective?->numero }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Statut juridique</div>
                                            <div>{{ $collective?->statut_juridique }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Région</div>
                                            <div>{{ $collective?->departement->region->nom }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Département</div>
                                            <div>{{ $collective->departement->nom }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Adresse exacte</div>
                                            <div>{{ $collective?->adresse }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone</div>
                                            <div>{{ $collective?->telephone }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Fixe</div>
                                            <div>{{ $collective?->fixe }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Email</div>
                                            <div>{{ $collective?->email1 }}</div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <div class="label">Projet professionnel</div>
                                            <div>{{ $collective?->projetprofessionnel }}</div>
                                        </div>
                                        <hr>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Civilité responsable</div>
                                            <div>{{ $collective?->civilite_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Prénom responsable</div>
                                            <div>{{ $collective?->prenom_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Nom responsable</div>
                                            <div>{{ $collective?->nom_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone responsable</div>
                                            <div>{{ $collective?->telephone_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Email responsable</div>
                                            <div>{{ $collective?->email_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Fonction responsable</div>
                                            <div>{{ $collective?->fonction_responsable }}</div>
                                        </div>
                                    </form>

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
                                                <a href="{{ url('formationmodules', ['$idformation' => $collective->id, '$idlocalite' => $collective->departement->region->id]) }}"
                                                    class="btn btn-primary float-end btn-sm">
                                                    <i class="bi bi-pencil" title="Changer module"></i> </a>
                                            </h5>
                                        </div>
                                    @else
                                        <div class="pt-1">
                                            <a href="{{ url('moduleformations', ['$idformation' => $collective->id, '$idlocalite' => $collective->departement->region->id]) }}"
                                                class="btn btn-primary float-end btn-sm">
                                                <i class="bi bi-person-plus-fill" title="Ajouter module"></i> </a>
                                        </div>
                                    @endif
                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        @isset($operateur)
                                            <div class="card-header">
                                                <i class="bi bi-table"></i>
                                                Liste des formations
                                            </div>
                                            <div class="row g-3">
                                                <table class="table datatables" id="table-formations">
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
                                                        @foreach ($module?->formations as $collective)
                                                            <tr>
                                                                <td>{{ $collective?->code }}</td>
                                                                <td><a
                                                                        href="#">{{ $collective->types_formation?->name }}</a>
                                                                </td>
                                                                <td>{{ $collective?->name }}</td>
                                                                <td>{{ $collective->departement?->region?->nom }}</td>
                                                                {{-- <td>{{ $collective->module?->name }}</td> --}}
                                                                {{-- <td>{{ $collective->niveau_qualification }}</td> --}}
                                                                <td class="text-center">
                                                                    @foreach ($collective->collectives as $collective)
                                                                        @if ($loop->last)
                                                                            <a class="text-primary fw-bold"
                                                                                href="{{ route('formations.show', $collective->id) }}">{!! $loop->count ?? '0' !!}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td><a href="#"><span
                                                                            class="{{ $collective?->statut }}">{{ $collective?->statut }}</span></a>
                                                                </td>
                                                                <td>
                                                                    <span class="d-flex align-items-baseline"><a
                                                                            href="{{ route('formations.show', $collective->id) }}"
                                                                            class="btn btn-primary btn-sm"
                                                                            title="voir détails"><i class="bi bi-eye"></i></a>
                                                                        <div class="filter">
                                                                            <a class="icon" href="#"
                                                                                data-bs-toggle="dropdown"><i
                                                                                    class="bi bi-three-dots"></i></a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                                <li><a class="dropdown-item btn btn-sm"
                                                                                        href="{{ route('formations.edit', $collective->id) }}"
                                                                                        class="mx-1" title="Modifier"><i
                                                                                            class="bi bi-pencil"></i>Modifier</a>
                                                                                </li>
                                                                                <li>
                                                                                    <form
                                                                                        action="{{ route('formations.destroy', $collective->id) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Operateur-->
        <div class="modal fade" id="indiponibleModal{{ $collective->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ url('indisponibles', ['$idformation' => $collective->id]) }}"
                        enctype="multipart/form-data" class="row">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Retirer demandeur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="collectiveid" value="{{ $collective->id }}">
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
