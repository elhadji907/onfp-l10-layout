@extends('layout.user-layout')
@section('title', 'modification opérateur ' . $operateur->sigle)
@section('space-work')
    @can('operateur-update')
        <section class="section min-vh-0 d-flex flex-column align-items-center justify-content-center py-0">
            <div class="container">
                <div class="row justify-content-center">
                    @if ($message = Session::get('status'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div
                        class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 pt-2">
                                        <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('operateurs.index') }}"
                                                class="btn btn-success btn-sm" title="retour"><i
                                                    class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                            <p> | Dossier personnel</p>
                                        </span>
                                    </div>
                                </div>
                                <form method="post" action="{{ route('operateurs.update', $operateur->id) }}"
                                    enctype="multipart/form-data" class="row g-3">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $operateur->id }}">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                            <label for="operateur" class="form-label">Raison sociale opérateur<span
                                                    class="text-danger mx-1">*</span></label>
                                            <textarea name="operateur" id="operateur" rows="1"
                                                class="form-control form-control-sm @error('operateur') is-invalid @enderror"
                                                placeholder="La raison sociale de l'opérateur">{{ $operateur?->user?->operateur ?? old('operateur') }}</textarea>
                                            @error('operateur')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="username" class="form-label">Sigle<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="username"
                                                value="{{ $operateur?->user?->username ?? old('username') }}"
                                                class="form-control form-control-sm @error('username') is-invalid @enderror"
                                                id="username" placeholder="username">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="numero_agrement" class="form-label">Numéro agrément</label>
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

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="email" class="form-label">Email<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="email"
                                                value="{{ $operateur?->user?->email ?? old('email') }}"
                                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                                id="email" placeholder="Adresse email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="fixe" class="form-label">Téléphone fixe<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="number" min="0" name="fixe"
                                                value="{{ $operateur?->user?->fixe ?? old('fixe') }}"
                                                class="form-control form-control-sm @error('fixe') is-invalid @enderror"
                                                id="fixe" placeholder="3xxxxxxxx">
                                            @error('fixe')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="telephone" class="form-label">Téléphone<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="number" min="0" name="telephone"
                                                value="{{ $operateur?->user?->telephone ?? old('telephone') }}"
                                                class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                                id="telephone" placeholder="7xxxxxxxx">
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
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
                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="categorie" class="form-label">Catégorie<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="categorie" class="form-select selectpicker"
                                                data-live-search="true @error('categorie') is-invalid @enderror"
                                                aria-label="Select" id="select-field-categorie-update"
                                                data-placeholder="Choisir categorie">
                                                <option value="{{ $operateur?->user?->categorie }}">
                                                    {{ $operateur?->user?->categorie ?? old('categorie') }}
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

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="statut" class="form-label">Statut juridique<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="statut" class="form-select  @error('statut') is-invalid @enderror"
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

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
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
                                            {{-- <input type="text" name="adresse"
                                                value="{{ $operateur?->adresse ?? old('adresse') }}"
                                                class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                                id="adresse" placeholder="adresse"> --}}
                                            <textarea name="adresse" id="adresse" rows="1"
                                                class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                                placeholder="Adresse exacte opérateur">{{ $operateur->user->adresse ?? old('adresse') }}</textarea>
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
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

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="registre_commerce" class="form-label">RCCM / Ninéa<span
                                                    class="text-danger mx-1">*</span></label>
                                            <select name="registre_commerce"
                                                class="form-select form-select-sm @error('registre_commerce') is-invalid @enderror"
                                                aria-label="Select" id="select-field-registre-update"
                                                data-placeholder="Choisir">
                                                <option value="{{ $operateur?->user?->rccm }}">
                                                    {{ $operateur?->user?->rccm ?? old('registre_commerce') }}
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

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="ninea" class="form-label">Numéro RCCM / Ninéa<span
                                                    class="text-danger mx-1">*</span></label>
                                            <input type="text" name="ninea"
                                                value="{{ $operateur?->user?->ninea ?? old('ninea') }}"
                                                class="form-control form-control-sm @error('ninea') is-invalid @enderror"
                                                id="ninea" placeholder="Votre ninéa / Numéro RCCM">
                                            @error('ninea')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-3 col-sm-12 col-xs-12 col-xxl-3">
                                            <label for="quitus" class="form-label">N° quitus fiscal<span
                                                    class="text-danger mx-1">*</span></label>

                                            <input type="file" name="quitus" id="quitus"
                                                class="form-control @error('quitus') is-invalid @enderror btn btn-outline-primary btn-sm">
                                            @error('quitus')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            {{-- <input type="text" name="quitus"
                                        value="{{ $operateur?->quitus ?? old('quitus') }}"
                                        class="form-control form-control-sm @error('quitus') is-invalid @enderror"
                                        id="quitus" placeholder="Quitus fiscal">
                                    @error('quitus')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror --}}
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-1 col-sm-12 col-xs-12 col-xxl-1">
                                            <label for="file_convention" class="form-label">Fichier</label>
                                            @if(!empty($operateur?->quitus))
                                                <div>
                                                    <a class="btn btn-outline-secondary btn-sm" title="Convention"
                                                        target="_blank" href="{{ asset($operateur?->getQuitus()) }}">
                                                        <i class="bi bi-file-earmark-image"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="badge bg-warning">Aucun</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
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

                                        <div class="col-12 col-md-6 col-lg-4 col-sm-12 col-xs-12 col-xxl-4">
                                            <label for="type_demande" class="form-label">TYPE<span
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
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-sm">Enregister
                                            modifications</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endcan
@endsection
