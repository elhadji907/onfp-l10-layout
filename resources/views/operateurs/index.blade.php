@extends('layout.user-layout')
@section('title', 'ONFP - demandes operateurs')
@section('space-work')

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
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
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
                        <div class="pt-1">
                            <button type="button" class="btn btn-primary float-end btn-rounded" data-bs-toggle="modal"
                                data-bs-target="#AddOperateurModal">
                                <i class="bi bi-person-plus" title="Ajouter"></i>
                            </button>
                        </div>
                        <h5 class="card-title">Liste des opérateurs</h5>
                        <table class="table datatables align-middle table-striped" id="table-operateurs">
                            <thead>
                                <tr>
                                    <th class="text-center">N° agrément</th>
                                    <th class="text-center">Opérateur</th>
                                    <th>Sigle</th>
                                    <th>Modules</th>
                                    <th>Formations</th>
                                    <th class="text-center"><i class="bi bi-gear"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($operateurs as $operateur)
                                    @isset($operateur?->numero_agrement)
                                        <tr>
                                            <td>{{ $operateur?->numero_agrement }}</td>
                                            <td>{{ $operateur?->name }}</td>
                                            <td>{{ $operateur?->sigle }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <span class="d-flex align-items-baseline"><a
                                                        href="{{ route('operateurs.show', $operateur->id) }}"
                                                        class="btn btn-primary btn-sm" title="voir détails"><i
                                                            class="bi bi-eye"></i></a>
                                                    <div class="filter">
                                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                class="bi bi-three-dots"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                            <li>
                                                                {{-- <a class="dropdown-item btn btn-sm"
                                                                    href="{{ route('operateurs.edit', $operateur->id) }}"
                                                                    class="mx-1" title="Modifier"><i
                                                                        class="bi bi-pencil"></i>Modifier</a> --}}

                                                                <button type="button" class="dropdown-item btn btn-sm mx-1"
                                                                    data-bs-toggle="modal" data-bs-target="#EditOperateurModal{{ $operateur->id }}">
                                                                    <i class="bi bi-pencil" title="Modifier"></i> Modifier
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('operateurs.destroy', $operateur->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item show_confirm"
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
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
            <div class="modal fade" id="AddOperateurModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="post" action="{{ route('operateurs.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Ajouter un nouveau
                                    opérateur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="name" class="form-label">Raison sociale opérateur<span
                                                class="text-danger mx-1">*</span></label>
                                        <textarea name="name" id="name" rows="2"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            placeholder="La raison sociale de l'opérateur">{{ old('name') }}</textarea>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="sigle" class="form-label">Sigle<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="sigle" value="{{ old('sigle') }}"
                                            class="form-control form-control-sm @error('sigle') is-invalid @enderror"
                                            id="sigle" placeholder="Sigle">
                                        @error('sigle')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="numero_agrement" class="form-label">Numéro agrément<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="numero_agrement"
                                            value="{{ old('numero_agrement') }}"
                                            class="form-control form-control-sm @error('numero_agrement') is-invalid @enderror"
                                            id="numero_agrement" placeholder="Numéro agrément">
                                        @error('numero_agrement')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="email1" class="form-label">Email<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="email1" value="{{ old('email1') }}"
                                            class="form-control form-control-sm @error('email1') is-invalid @enderror"
                                            id="email1" placeholder="Ex: Mathématiques">
                                        @error('email1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="fixe" class="form-label">Téléphone fixe<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="fixe" value="{{ old('fixe') }}"
                                            class="form-control form-control-sm @error('fixe') is-invalid @enderror"
                                            id="fixe" placeholder="Téléphone fixe">
                                        @error('fixe')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="telephone1" class="form-label">Téléphone<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="telephone1" value="{{ old('telephone1') }}"
                                            class="form-control form-control-sm @error('telephone1') is-invalid @enderror"
                                            id="telephone1" placeholder="Téléphone portable">
                                        @error('telephone1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="bp" class="form-label">Boite postal</label>
                                        <input type="text" name="bp" value="{{ old('bp') }}"
                                            class="form-control form-control-sm @error('bp') is-invalid @enderror"
                                            id="bp" placeholder="Boite postal">
                                        @error('bp')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Type de structure --}}
                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="categorie" class="form-label">Catégorie<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="categorie"
                                            class="form-select  @error('categorie') is-invalid @enderror"
                                            aria-label="Select" id="select-field-categorie"
                                            data-placeholder="Choisir diplôme professionnel">
                                            <option value="{{ old('categorie') }}">
                                                {{ old('categorie') }}
                                            </option>
                                            <option value="Publique">
                                                Publique
                                            </option>
                                            <option value="Privé">
                                                Privé
                                            </option>
                                            <option value="Autre">
                                                Autre
                                            </option>
                                        </select>
                                        @error('categorie')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="statut" class="form-label">Statut juridique<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="statut" class="form-select  @error('statut') is-invalid @enderror"
                                            aria-label="Select" id="select-field-statut"
                                            data-placeholder="Choisir statut">
                                            <option value="{{ old('statut') }}">
                                                {{ old('statut') }}
                                            </option>
                                            <option value="GIE">
                                                GIE
                                            </option>
                                            <option value="Association">
                                                Association
                                            </option>
                                            <option value="Entreprise">
                                                Entreprise
                                            </option>
                                            <option value="Institution">
                                                Institution
                                            </option>
                                            <option value="Autre">
                                                Autre
                                            </option>
                                        </select>
                                        @error('statut')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="autre_statut" class="form-label">Si autre ?
                                            précisez</label>
                                        <input type="text" name="autre_statut" value="{{ old('autre_statut') }}"
                                            class="form-control form-control-sm @error('autre_statut') is-invalid @enderror"
                                            id="autre_statut" placeholder="autre statut juridique">
                                        @error('autre_statut')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="departement" class="form-label">Siège social<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="departement"
                                            class="form-select form-select-sm @error('departement') is-invalid @enderror"
                                            aria-label="Select" id="select-field-departement" data-placeholder="Choisir">
                                            <option value=""></option>
                                            @foreach ($departements as $departement)
                                                <option value="{{ $departement->id }}">
                                                    {{ $departement->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('departement')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="adresse" class="form-label">Adresse<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="adresse" value="{{ old('adresse') }}"
                                            class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                            id="adresse" placeholder="adresse">
                                        @error('adresse')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="registre_commerce" class="form-label">RCCM / Ninea<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="registre_commerce"
                                            class="form-select form-select-sm @error('registre_commerce') is-invalid @enderror"
                                            aria-label="Select" id="select-field-registre" data-placeholder="Choisir">
                                            <option value="">
                                                {{ old('registre_commerce') }}
                                            </option>
                                            <option value="Registre de commerce">
                                                Registre de commerce
                                            </option>
                                            <option value="Quitus fiscal">
                                                Quitus fiscal
                                            </option>
                                        </select>
                                        @error('registre_commerce')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="ninea" class="form-label">Numéro RCCM / Ninea<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="ninea" value="{{ old('ninea') }}"
                                            class="form-control form-control-sm @error('ninea') is-invalid @enderror"
                                            id="ninea" placeholder="Votre ninéa">
                                        @error('ninea')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="quitus" class="form-label">Quitus fiscal<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="quitus" value="{{ old('quitus') }}"
                                            class="form-control form-control-sm @error('quitus') is-invalid @enderror"
                                            id="quitus" placeholder="Quitus fiscal">
                                        @error('quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="date_quitus" class="form-label">Date délivrance<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="date" name="date_quitus" value="{{ old('date_quitus') }}"
                                            class="form-control form-control-sm @error('date_quitus') is-invalid @enderror"
                                            id="date_quitus" placeholder="Date quitus">
                                        @error('date_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <hr class="dropdown-divider mt-5">

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="civilite" class="form-label">Civilité<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="civilite"
                                            class="form-select form-select-sm @error('civilite') is-invalid @enderror"
                                            aria-label="Select" id="select-field-civilite"
                                            data-placeholder="Choisir civilité">
                                            <option value="">
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
                                        <label for="prenom" class="form-label">Prénom responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="prenom" value="{{ old('prenom') }}"
                                            class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                            id="prenom" placeholder="Prénom responsable">
                                        @error('prenom')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="nom" class="form-label">Nom responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="nom" value="{{ old('nom') }}"
                                            class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                            id="nom" placeholder="Nom responsable">
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="email2" class="form-label">Adresse e-mail<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="email" name="email2" value="{{ old('email2') }}"
                                            class="form-control form-control-sm @error('email2') is-invalid @enderror"
                                            id="email2" placeholder="Adresse email responsable">
                                        @error('email2')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="telephone2" class="form-label">Téléphone responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="telephone2" value="{{ old('telephone2') }}"
                                            class="form-control form-control-sm @error('telephone2') is-invalid @enderror"
                                            id="telephone2" placeholder="Telephone responsable">
                                        @error('telephone2')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="fonction_responsable" class="form-label">Fonction responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="fonction_responsable"
                                            value="{{ old('fonction_responsable') }}"
                                            class="form-control form-control-sm @error('fonction_responsable') is-invalid @enderror"
                                            id="fonction_responsable" placeholder="Fonction responsable">
                                        @error('fonction_responsable')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer mt-5">
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
            @foreach ($operateurs as $operateur)
                <!-- Edit Operateur -->
                <div class="modal fade" id="EditOperateurModal{{ $operateur->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="EditOperateurModalLabel{{ $operateur->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            {{-- <form method="post" action="{{ route('operateurs.store') }}" enctype="multipart/form-data">
                                @csrf --}}
                            <form method="post" action="{{ route('operateurs.update', $operateur->id) }}"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('patch')
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Ajouter un nouveau
                                        opérateur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $operateur->id }}">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-12 col-lg-12 mb-0">
                                            <label for="name" class="form-label">Raison sociale opérateur<span
                                                    class="text-danger mx-1">*</span></label>
                                            <textarea name="name" id="name" rows="2"
                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                placeholder="La raison sociale de l'opérateur">{{ $operateur->name ?? old('name') }}</textarea>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="sigle" class="form-label">Sigle<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="sigle"
                                                value="{{ $operateur->sigle ?? old('sigle') }}"
                                                class="form-control form-control-sm @error('sigle') is-invalid @enderror"
                                                id="sigle" placeholder="Sigle">
                                            @error('sigle')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="numero_agrement" class="form-label">Numéro agrément<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="numero_agrement"
                                                value="{{ $operateur->numero_agrement ?? old('numero_agrement') }}"
                                                class="form-control form-control-sm @error('numero_agrement') is-invalid @enderror"
                                                id="numero_agrement" placeholder="Numéro agrément">
                                            @error('numero_agrement')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="email1" class="form-label">Email<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="email1"
                                                value="{{ $operateur->email1 ?? old('email1') }}"
                                                class="form-control form-control-sm @error('email1') is-invalid @enderror"
                                                id="email1" placeholder="Ex: Mathématiques">
                                            @error('email1')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="fixe" class="form-label">Téléphone fixe<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="fixe"
                                                value="{{ $operateur->fixe ?? old('fixe') }}"
                                                class="form-control form-control-sm @error('fixe') is-invalid @enderror"
                                                id="fixe" placeholder="Téléphone fixe">
                                            @error('fixe')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="telephone1" class="form-label">Téléphone<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="telephone1"
                                                value="{{ $operateur->telephone1 ?? old('telephone1') }}"
                                                class="form-control form-control-sm @error('telephone1') is-invalid @enderror"
                                                id="telephone1" placeholder="Téléphone portable">
                                            @error('telephone1')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="bp" class="form-label">Boite postal</label>
                                            <input type="text" name="bp"
                                                value="{{ $operateur->user?->bp ?? old('bp') }}"
                                                class="form-control form-control-sm @error('bp') is-invalid @enderror"
                                                id="bp" placeholder="Boite postal">
                                            @error('bp')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- Type de structure --}}
                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="categorie" class="form-label">Catégorie<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="categorie"
                                                class="form-select selectpicker" data-live-search="true @error('categorie') is-invalid @enderror"
                                                aria-label="Select" id="select-field-categorie-update"
                                                data-placeholder="Choisir categorie">
                                                <option value="{{ $operateur->categorie }}">
                                                    {{ $operateur->categorie ?? old('categorie') }}
                                                </option>
                                                <option value="Publique">
                                                    Publique
                                                </option>
                                                <option value="Privé">
                                                    Privé
                                                </option>
                                                <option value="Autre">
                                                    Autre
                                                </option>
                                            </select>
                                            @error('categorie')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="statut" class="form-label">Statut juridique<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="statut"
                                                class="form-select  @error('statut') is-invalid @enderror"
                                                aria-label="Select" id="select-field-statut-update"
                                                data-placeholder="Choisir statut">
                                                <option value="{{ $operateur->statut }}">
                                                    {{ $operateur->statut ?? old('statut') }}
                                                </option>
                                                <option value="GIE">
                                                    GIE
                                                </option>
                                                <option value="Association">
                                                    Association
                                                </option>
                                                <option value="Entreprise">
                                                    Entreprise
                                                </option>
                                                <option value="Institution">
                                                    Institution
                                                </option>
                                                <option value="Autre">
                                                    Autre
                                                </option>
                                            </select>
                                            @error('statut')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="autre_statut" class="form-label">Si autre ?
                                                précisez</label>
                                            <input type="text" name="autre_statut"
                                                value="{{ $operateur?->autre_statut ?? old('autre_statut') }}"
                                                class="form-control form-control-sm @error('autre_statut') is-invalid @enderror"
                                                id="autre_statut" placeholder="autre statut juridique">
                                            @error('autre_statut')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="departement" class="form-label">Siège social<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="departement"
                                                class="form-select form-select-sm @error('departement') is-invalid @enderror"
                                                aria-label="Select" id="select-field-departement-update"
                                                data-placeholder="Choisir">
                                                <option value="{{ $operateur->departement?->id }}">
                                                    {{ $operateur->departement?->nom ?? old('departement') }}
                                                </option>
                                                @foreach ($departements as $departement)
                                                    <option value="{{ $departement->id }}">
                                                        {{ $departement->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('departement')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="adresse" class="form-label">Adresse<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="adresse"
                                                value="{{ $operateur?->adresse ?? old('adresse') }}"
                                                class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                                id="adresse" placeholder="adresse">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="registre_commerce" class="form-label">RCCM / Ninéa<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="registre_commerce"
                                                class="form-select form-select-sm @error('registre_commerce') is-invalid @enderror"
                                                aria-label="Select" id="select-field-registre-update"
                                                data-placeholder="Choisir">
                                                <option value="{{ $operateur->rccm }}">
                                                    {{ $operateur->rccm ?? old('registre_commerce') }}
                                                </option>
                                                <option value="Registre de commerce">
                                                    Registre de commerce
                                                </option>
                                                <option value="Ninea">
                                                    Ninea
                                                </option>
                                            </select>
                                            @error('registre_commerce')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="ninea" class="form-label">Numéro RCCM / Ninéa<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="ninea"
                                                value="{{ $operateur?->ninea ?? old('ninea') }}"
                                                class="form-control form-control-sm @error('ninea') is-invalid @enderror"
                                                id="ninea" placeholder="Votre ninéa">
                                            @error('ninea')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="quitus" class="form-label">Quitus fiscal<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="quitus"
                                                value="{{ $operateur?->quitus ?? old('quitus') }}"
                                                class="form-control form-control-sm @error('quitus') is-invalid @enderror"
                                                id="quitus" placeholder="Quitus fiscal">
                                            @error('quitus')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="date_quitus" class="form-label">Date délivrance<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="date" name="date_quitus"
                                                value="{{ $operateur?->debut_quitus?->format('Y-m-d') ?? old('date_quitus') }}"
                                                class="form-control form-control-sm @error('date_quitus') is-invalid @enderror"
                                                id="date_quitus" placeholder="Date quitus">
                                            @error('date_quitus')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <hr class="dropdown-divider mt-3">

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="civilite" class="form-label">Civilité<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="civilite"
                                                class="form-select form-select-sm @error('civilite') is-invalid @enderror"
                                                aria-label="Select" id="select-field-civilite-update"
                                                data-placeholder="Choisir civilité">
                                                <option value="{{ $operateur->user?->civilite }}">
                                                    {{ $operateur->user?->civilite ?? old('civilite') }}
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
                                            <label for="prenom" class="form-label">Prénom responsable<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="prenom"
                                                value="{{ $operateur?->prenom_responsable ?? old('prenom') }}"
                                                class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                                id="prenom" placeholder="Prénom responsable">
                                            @error('prenom')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="nom" class="form-label">Nom responsable<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="nom"
                                                value="{{ $operateur?->nom_responsable ?? old('nom') }}"
                                                class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                                id="nom" placeholder="Nom responsable">
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="email2" class="form-label">Adresse e-mail<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="email" name="email2"
                                                value="{{ $operateur?->email2 ?? old('email2') }}"
                                                class="form-control form-control-sm @error('email2') is-invalid @enderror"
                                                id="email2" placeholder="Adresse email responsable">
                                            @error('email2')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="telephone2" class="form-label">Téléphone responsable<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="telephone2"
                                                value="{{ $operateur?->telephone2 ?? old('telephone2') }}"
                                                class="form-control form-control-sm @error('telephone2') is-invalid @enderror"
                                                id="telephone2" placeholder="Telephone responsable">
                                            @error('telephone2')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-0">
                                            <label for="fonction_responsable" class="form-label">Fonction responsable<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="fonction_responsable"
                                                value="{{ $operateur?->fonction_responsable ?? old('fonction_responsable') }}"
                                                class="form-control form-control-sm @error('fonction_responsable') is-invalid @enderror"
                                                id="fonction_responsable" placeholder="Fonction responsable">
                                            @error('fonction_responsable')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-3">
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
            @endforeach
            <!-- End Edit Operateur-->
    </section>

@endsection
@push('scripts')
    <script>
        new DataTable('#table-operateurs', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                }
            },
            "order": [
                [0, 'desc']
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
