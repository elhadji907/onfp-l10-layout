@extends('layout.user-layout')
@section('title', 'ONFP - Liste membres')
@section('space-work')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-12">
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
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <span class="nav-link"><a
                                    href="{{ route('collectives.show', $collectivemodule->collective->id) }}"
                                    class="btn btn-secondary btn-sm" title="retour"><i
                                        class="bi bi-arrow-counterclockwise"></i></a>
                            </span>
                        </li>
                    </ul>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary float-end btn-rounded" data-bs-toggle="modal"
                            data-bs-target="#AddIndividuelModal">
                            <i class="bi bi-plus" title="Ajouter"></i>
                        </button>
                        <h5 class="card-title">Modules: {{ $collectivemodule->module }}</h5>
                        <table class="table datatables align-middle justify-content-center" id="table-modules">
                            <thead>
                                <tr>
                                    <th scope="col">CIN</th>
                                    <th scope="col">Civilité</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Date naissance</th>
                                    <th scope="col">Lieu naissance</th>
                                    <th scope="col">Niveau étude</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Statut</th>
                                    <th class="col"><i class="bi bi-gear"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($collectivemodule->listecollectives as $listecollective)
                                    <tr>
                                        <td>{{ $listecollective?->cin }}</td>
                                        <td>{{ $listecollective?->civilite }}</td>
                                        <td>{{ $listecollective?->prenom }}</td>
                                        <td>{{ $listecollective?->nom }}</td>
                                        <td>{{ $listecollective?->date_naissance->format('d/m/Y') }}
                                        </td>
                                        <td>{{ $listecollective?->lieu_naissance }}</td>
                                        <td>{{ $listecollective?->niveau_etude }}</td>
                                        <td>{{ $listecollective?->collectivemodule?->module }}</td>
                                        <td>
                                            <span
                                                class="{{ $listecollective?->statut }}">{{ $listecollective?->statut }}</span>
                                        </td>
                                        <td>
                                            <span class="d-flex align-items-baseline">
                                                {{-- {{ route('listecollectives.show', $listecollective?->id) }} --}}
                                                <a href="#"
                                                    class="btn btn-primary btn-sm" title="voir détails"><i
                                                        class="bi bi-eye"></i></a>
                                                <div class="filter">
                                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                            class="bi bi-three-dots"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                        <li><a class="dropdown-item btn btn-sm"
                                                                href="{{ route('listecollectives.edit', $listecollective->id) }}"
                                                                class="mx-1" title="Modifier"><i
                                                                    class="bi bi-pencil"></i>Modifier</a>
                                                        </li>
                                                        <form
                                                            action="{{ route('listecollectives.destroy', $listecollective->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item show_confirm"
                                                                title="Supprimer"><i
                                                                    class="bi bi-trash"></i>Supprimer</button>
                                                        </form>
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
            </div>
        </div>

        {{-- Add member --}}
        <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
            <div class="modal fade" id="AddIndividuelModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="post" action="{{ route('listecollectives.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Ajouter un membre</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <input type="hidden" name="collective"
                                        value="{{ $collectivemodule->collective->id }}">
                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="cin" class="form-label">CIN<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="cin" value="{{ old('cin') }}"
                                            class="form-control form-control-sm @error('cin') is-invalid @enderror"
                                            id="cin" placeholder="CIN">
                                        @error('cin')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="civilite" class="form-label">Civilité<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="civilite"
                                            class="form-select form-select-sm @error('civilite') is-invalid @enderror"
                                            aria-label="Select" id="select-field-civilite"
                                            data-placeholder="Choisir civilité">
                                            <option value="{{ old('civilite') }}">
                                                {{ old('civilite') }}
                                            </option>
                                            <option value="Monsieur">
                                                Monsieur
                                            </option>
                                            <option value="Madame">
                                                Madame
                                            </option>
                                        </select>
                                        @error('civilite')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="firstname" class="form-label">Prénom<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="firstname" value="{{ old('firstname') }}"
                                            class="form-control form-control-sm @error('firstname') is-invalid @enderror"
                                            id="firstname" placeholder="prénom">
                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="name" class="form-label">Nom<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            id="name" placeholder="nom">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="date_naissance" class="form-label">Date naissance<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="date" name="date_naissance" value="{{ old('date_naissance') }}"
                                            class="form-control form-control-sm @error('date_naissance') is-invalid @enderror"
                                            id="date_naissance" placeholder="Date naissance">
                                        @error('date_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="name" class="form-label">Lieu naissance<span
                                                class="text-danger mx-1">*</span></label>
                                        <input name="lieu_naissance" type="text"
                                            class="form-control form-control-sm @error('lieu_naissance') is-invalid @enderror"
                                            id="lieu_naissance" value="{{ old('lieu_naissance') }}"
                                            autocomplete="lieu_naissance" placeholder="Lieu naissance">
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="module" value="{{ $collectivemodule->id }}">

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="number" min="0" name="telephone" value="{{ old('telephone') }}"
                                            class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                            id="telephone" placeholder="7xxxxxxxx">
                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="Niveau étude" class="form-label">Niveau étude</label>
                                        <select name="niveau_etude"
                                            class="form-select  @error('niveau_etude') is-invalid @enderror"
                                            aria-label="Select" id="select-field-niveau_etude"
                                            data-placeholder="Choisir niveau étude">
                                            <option value="{{ old('niveau_etude') }}">
                                                {{ old('niveau_etude') }}
                                            </option>
                                            <option value="Aucun">
                                                Aucun
                                            </option>
                                            <option value="Arabe">
                                                Arabe
                                            </option>
                                            <option value="Elementaire">
                                                Elementaire
                                            </option>
                                            <option value="Secondaire">
                                                Secondaire
                                            </option>
                                            <option value="Moyen">
                                                Moyen
                                            </option>
                                            <option value="Supérieur">
                                                Supérieur
                                            </option>
                                        </select>
                                        @error('niveau_etude')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="experience" class="form-label">Expériences</label>
                                        <textarea name="experience" id="experience" rows="1"
                                            class="form-control form-control-sm @error('experience') is-invalid @enderror"
                                            placeholder="Expériences ou stages">{{ old('experience') }}</textarea>
                                        @error('experience')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="autre_experience" class="form-label">Autres expériences</label>
                                        <textarea name="autre_experience" id="autre_experience" rows="1"
                                            class="form-control form-control-sm @error('autre_experience') is-invalid @enderror"
                                            placeholder="Autres expériences">{{ old('autre_experience') }}</textarea>
                                        @error('autre_experience')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="details" class="form-label">Commentaires</label>
                                        <textarea name="details" id="details" rows="1"
                                            class="form-control form-control-sm @error('details') is-invalid @enderror" placeholder="Autres expériences">{{ old('details') }}</textarea>
                                        @error('details')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>
                                            Enregistrer</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        new DataTable('#table-modules', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                }
            },
            "order": [
                [2, 'desc']
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
