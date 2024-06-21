@extends('layout.user-layout')
@section('title', 'ONFP - Liste des régions')
@section('space-work')

    <section class="section register">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-10">
                <div class="pagetitle">
                    {{-- <h1>Data Tables</h1> --}}
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active">Données</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->
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
                <div class="card">
                    <div class="card-body">
                        {{-- @can('role-create') --}}
                        <div class="pt-1">
                            {{-- <a href="{{ route('regions.create') }}" class="btn btn-primary float-end btn-rounded"><i
                                    class="fas fa-plus"></i>
                                <i class="bi bi-person-plus" title="Ajouter"></i> </a> --}}

                            <button type="button" class="btn btn-primary float-end btn-rounded" data-bs-toggle="modal"
                                data-bs-target="#AddRegionModal">
                                <i class="bi bi-person-plus" title="Ajouter"></i>
                            </button>
                        </div>
                        {{-- @endcan --}}
                        <h5 class="card-title">Régions</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatables align-middle justify-content-center" id="table-regions">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">N°</th>
                                    <th>Régions</th>
                                    <th>Code</th>
                                    <th class="text-center" scope="col">Départements</th>
                                    <th class="text-center" scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($regions as $region)
                                    <tr>
                                        <td style="text-align: center;">{{ $i++ }}</td>
                                        <td>{{ $region->nom }}</td>
                                        <td>{{ $region->sigle }}</td>
                                        <td style="text-align: center;">
                                            @foreach ($region->departements as $departement)
                                                @if ($loop->last)
                                                    <span class="badge bg-info">{{ $loop->count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="d-flex mt-2 align-items-baseline"><a
                                                    href="{{ route('regions.show', $region->id) }}"
                                                    class="btn btn-warning btn-sm mx-1" title="Voir détails">
                                                    <i class="bi bi-eye"></i></a>
                                                <div class="filter">
                                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                            class="bi bi-three-dots"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                        <li>
                                                            {{-- <a class="dropdown-item btn btn-sm mx-1"
                                                                href="{{ url('regions/' . $region->id . '/edit') }}"
                                                                class="mx-1"><i class="bi bi-pencil"></i> Modifier</a> --}}
                                                            <button type="button" class="dropdown-item btn btn-sm mx-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#EditRegionModal{{ $region->id }}">
                                                                <i class="bi bi-pencil" title="Modifier"></i> Modifier
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <form action="{{ url('regions', $region->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item show_confirm"><i
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
        <!-- Add Region -->
        <div class="modal fade" id="AddRegionModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- <form method="POST" action="{{ route('addRegion') }}">
                        @csrf --}}
                    <form method="post" action="{{ url('regions') }}" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Ajouter une nouvelle
                                région</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" name="region" value="{{ old('region') }}"
                                    class="form-control form-control-sm @error('region') is-invalid @enderror"
                                    id="region" placeholder="Nom region" autofocus>
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                <label for="floatingInput">Région</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="sigle" value="{{ old('sigle') }}"
                                    class="form-control form-control-sm @error('sigle') is-invalid @enderror"
                                    id="sigle" placeholder="Code region">
                                @error('sigle')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                <label for="floatingInput">Code région</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Add Region-->

        <!-- Edit Region -->
        @foreach ($regions as $region)
            <div class="modal fade" id="EditRegionModal{{ $region->id }}" tabindex="-1" role="dialog"
                aria-labelledby="EditRegionModalLabel{{ $region->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {{-- <form method="POST" action="{{ route('updateRegion') }}">
                            @csrf --}}
                        <form method="post" action="{{ route('regions.update', $region->id) }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('patch')
                            <div class="modal-header" id="EditRegionModalLabel{{ $region->id }}">
                                <h5 class="modal-title"><i class="bi bi-pencil" title="Ajouter"></i> Modifier région</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $region->id }}">
                                <div class="form-floating mb-3">
                                    <input type="text" name="nom" value="{{ $region->nom ?? old('nom') }}"
                                        class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                        id="nom" placeholder="Nom region" autofocus>
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    <label for="floatingInput">Région</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="sigle" value="{{ $region->sigle ?? old('sigle') }}"
                                        class="form-control form-control-sm @error('sigle') is-invalid @enderror"
                                        id="sigle" placeholder="Code region">
                                    @error('sigle')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    <label for="floatingInput">Code région</label>
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
        <!-- End Add Region-->
    </section>

@endsection
@push('scripts')
    <script>
        new DataTable('#table-regions', {
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
