@extends('layout.user-layout')
@section('title', 'Mon dossier de demandes operateurs')
@section('space-work')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                @if ($message = Session::get('status'))
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" region="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        region="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="d-flex mt-2 align-items-baseline"><a href="{{ url('/profil') }}"
                                    class="btn btn-success btn-sm" title="retour"><i
                                        class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                <p> | Profil</p>
                            </span>
                            <button type="button" class="btn btn-info btn-sm">
                                <span class="badge bg-white text-info">{{ $operateur_total }}/1</span>
                            </button>
                            {{-- @isset(Auth::user()->cin) --}}
                            <button type="button" class="btn btn-primary btn-sm float-end btn-rounded"
                                data-bs-toggle="modal" data-bs-target="#AddoperateurModal">
                                <i class="bi bi-plus" title="Ajouter demande"></i>
                            </button>
                            {{-- @endisset --}}
                        </div>

                        @if (isset(Auth::user()->cin))
                            <h5 class="card-title">Aucune demande operateur pour le moment !</h5>
                        @else
                            <h5 class="card-title">Informations personnelles : <a href="{{ route('profil') }}"><span
                                        class="badge bg-warning text-white">Incomplètes</span></a>, cliquez <a
                                    href="{{ route('profil') }}">ici</a> pour modifier votre profil</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Ajouter un autre choix --}}
        <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12 d-flex flex-column align-items-center justify-content-center">
            <div class="modal fade" id="AddoperateurModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="post" action="{{ route('operateurs.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i>Ajouter une demande d'agrément</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    {{-- <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                        <label for="name" class="form-label">Raison sociale opérateur<span
                                                class="text-danger mx-1">*</span></label>
                                        <textarea name="name" id="name" rows="1"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            placeholder="La raison sociale de l'opérateur">{{ old('name') }}</textarea>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
                                    </div> --}}

                                    {{-- <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
                                    </div> --}}

                                    {{-- <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="email1" class="form-label">Email<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="email" name="email1" value="{{ old('email1') }}"
                                            class="form-control form-control-sm @error('email1') is-invalid @enderror"
                                            id="email1" placeholder="Adresse email">
                                        @error('email1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="fixe" class="form-label">Téléphone fixe<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="number" min="0" name="fixe" value="{{ old('fixe') }}"
                                            class="form-control form-control-sm @error('fixe') is-invalid @enderror"
                                            id="fixe" placeholder="3xxxxxxxx">
                                        @error('fixe')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="telephone1" class="form-label">Téléphone<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="number" min="0" name="telephone1"
                                            value="{{ old('telephone1') }}"
                                            class="form-control form-control-sm @error('telephone1') is-invalid @enderror"
                                            id="telephone1" placeholder="7xxxxxxxx">
                                        @error('telephone1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    {{-- Type de structure --}}
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="departement" class="form-label">Siège social<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="departement"
                                            class="form-select form-select-sm @error('departement') is-invalid @enderror"
                                            aria-label="Select" id="select-field-departement_op"
                                            data-placeholder="Choisir">
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
                                    
                                    {{-- <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="categorie" class="form-label">Catégorie<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="categorie"
                                            class="form-select  @error('categorie') is-invalid @enderror"
                                            aria-label="Select" id="select-field_categorie_op"
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
                                    </div> --}}

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="statut" class="form-label">Statut juridique<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="statut" class="form-select  @error('statut') is-invalid @enderror"
                                            aria-label="Select" id="select-field-statut_op"
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    {{-- <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="registre_commerce" class="form-label">RCCM / Ninea<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="registre_commerce"
                                            class="form-select form-select-sm @error('registre_commerce') is-invalid @enderror"
                                            aria-label="Select" id="select-field-registre_op" data-placeholder="Choisir">
                                            <option value="{{ old('registre_commerce') }}">
                                                {{ old('registre_commerce') }}
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="ninea" class="form-label">N° RCCM / Ninea<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="ninea" value="{{ old('ninea') }}"
                                            class="form-control form-control-sm @error('ninea') is-invalid @enderror"
                                            id="ninea" placeholder="Votre ninéa / Numéro RCCM">
                                        @error('ninea')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="quitus" class="form-label">N° quitus fiscal<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="quitus" value="{{ old('quitus') }}"
                                            class="form-control form-control-sm @error('quitus') is-invalid @enderror"
                                            id="quitus" placeholder="N° quitus fiscal">
                                        @error('quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="type_demande" class="form-label">Type demande<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="type_demande"
                                            class="form-select form-select-sm @error('type_demande') is-invalid @enderror"
                                            aria-label="Select" id="select-field_type_demande"
                                            data-placeholder="Choisir type de demande">
                                            <option value="{{ old('type_demande') }}">
                                                {{ old('type_demande') }}
                                            </option>
                                            <option value="new">
                                                Nouvelle
                                            </option>
                                            <option value="renew">
                                                Renouvellement
                                            </option>
                                        </select>
                                        @error('type_demande')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
{{-- 
                                    <hr class="dropdown-divider mt-3">

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="telephone2" class="form-label">Téléphone responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="number" min="0" name="telephone2"
                                            value="{{ old('telephone2') }}"
                                            class="form-control form-control-sm @error('telephone2') is-invalid @enderror"
                                            id="telephone2" placeholder="7xxxxxxxx">
                                        @error('telephone2')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
                                    </div> --}}
                                </div>
                                <div class="modal-footer mt-5">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i>
                                        Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @foreach ($operateurs as $operateur)
            <div class="modal fade" id="EditOperateurModal{{ $operateur->id }}" tabindex="-1" role="dialog"
                aria-labelledby="EditOperateurModalLabel{{ $operateur->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="post" action="{{ route('operateurs.update', $operateur->id) }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('patch')
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Modification opérateur
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $operateur->id }}">
                                <div class="row g-3">
                                    <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                        <label for="name" class="form-label">Raison sociale opérateur<span
                                                class="text-danger mx-1">*</span></label>
                                        <textarea name="name" id="name" rows="1"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            placeholder="La raison sociale de l'opérateur">{{ $operateur->name ?? old('name') }}</textarea>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="email1" class="form-label">Email<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="email1"
                                            value="{{ $operateur->email1 ?? old('email1') }}"
                                            class="form-control form-control-sm @error('email1') is-invalid @enderror"
                                            id="email1" placeholder="Adresse email">
                                        @error('email1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="fixe" class="form-label">Téléphone fixe<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="number" min="0" name="fixe"
                                            value="{{ $operateur->fixe ?? old('fixe') }}"
                                            class="form-control form-control-sm @error('fixe') is-invalid @enderror"
                                            id="fixe" placeholder="3xxxxxxxx">
                                        @error('fixe')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="telephone1" class="form-label">Téléphone<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="number" min="0" name="telephone1"
                                            value="{{ $operateur->telephone1 ?? old('telephone1') }}"
                                            class="form-control form-control-sm @error('telephone1') is-invalid @enderror"
                                            id="telephone1" placeholder="7xxxxxxxx">
                                        @error('telephone1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="bp" class="form-label">Boite postal</label>
                                        <input type="text" name="bp" value="{{ $operateur?->bp ?? old('bp') }}"
                                            class="form-control form-control-sm @error('bp') is-invalid @enderror"
                                            id="bp" placeholder="Boite postal">
                                        @error('bp')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="categorie" class="form-label">Catégorie<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="categorie"
                                            class="form-select form-select-sm @error('categorie') is-invalid @enderror"
                                            aria-label="Select" id="select-field-categorie_op"
                                            data-placeholder="Choisir">
                                            <option value="{{ $operateur?->categorie }}">
                                                {{ $operateur?->categorie ?? old('categorie') }}
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="statut" class="form-label">Statut juridique<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="statut"
                                            class="form-select form-select-sm @error('statut') is-invalid @enderror"
                                            aria-label="Select" id="select-field-juridique" data-placeholder="Choisir">
                                            <option value="{{ $operateur?->statut }}">
                                                {{ $operateur?->statut ?? old('statut') }}
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                        <label for="adresse" class="form-label">Adresse<span
                                                class="text-danger mx-1">*</span></label>
                                        <textarea name="adresse" id="adresse" rows="1"
                                            class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                            placeholder="Adresse exacte opérateur">{{ $operateur->adresse ?? old('adresse') }}</textarea>
                                        @error('adresse')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="ninea" class="form-label">Numéro RCCM / Ninéa<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="text" name="ninea"
                                            value="{{ $operateur?->ninea ?? old('ninea') }}"
                                            class="form-control form-control-sm @error('ninea') is-invalid @enderror"
                                            id="ninea" placeholder="Votre ninéa / Numéro RCCM">
                                        @error('ninea')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="type_demande" class="form-label">Type demande<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="type_demande"
                                            class="form-select form-select-sm @error('type_demande') is-invalid @enderror"
                                            aria-label="Select" id="select-field-registre" data-placeholder="Choisir">
                                            <option value="{{ $operateur?->type_demande }}">
                                                {{ $operateur?->type_demande ?? old('type_demande') }}
                                            </option>
                                            <option value="new">
                                                Nouvelle
                                            </option>
                                            <option value="renew">
                                                Renouvellement
                                            </option>
                                        </select>
                                        @error('type_demande')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <hr class="dropdown-divider mt-3">

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="civilite" class="form-label">Civilité responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="civilite"
                                            class="form-select form-select-sm @error('civilite') is-invalid @enderror"
                                            aria-label="Select" id="select-field-civilite-update"
                                            data-placeholder="Choisir civilité">
                                            <option value="{{ $operateur?->civilite_responsable }}">
                                                {{ $operateur?->civilite_responsable ?? old('civilite') }}
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
                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
                                        <label for="telephone2" class="form-label">Téléphone responsable<span
                                                class="text-danger mx-1">*</span></label>
                                        <input type="number" min="0" name="telephone2"
                                            value="{{ $operateur?->telephone2 ?? old('telephone2') }}"
                                            class="form-control form-control-sm @error('telephone2') is-invalid @enderror"
                                            id="telephone2" placeholder="7xxxxxxxx">
                                        @error('telephone2')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 col-sm-12 col-xs-12 col-xxl-4">
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
        @endforeach --}}
    </section>
@endsection
