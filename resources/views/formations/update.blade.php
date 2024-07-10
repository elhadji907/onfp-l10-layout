@extends('layout.user-layout')
@section('title', 'modification formation')
@section('space-work')
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
                <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 pt-2">
                                    <span class="d-flex mt-2 align-items-baseline"><a
                                            href="{{ route('formations.index') }}"
                                            class="btn btn-success btn-sm" title="retour"><i
                                                class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                        <p> | Formations</p>
                                    </span>
                                </div>
                            </div>
                            <form method="post" action="{{ url('formations/' . $formation->id) }}"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')

                                <div class="col-12 col-md-12 col-lg-12 mb-0">
                                    <label for="name" class="form-label">Intitulé formation<span
                                            class="text-danger mx-1">*</span></label>
                                    <textarea name="name" id="name" rows="1"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Intitulé formation">{{ $formation->name ?? old('name') }}</textarea>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="departement" class="form-label">Département<span
                                            class="text-danger mx-1">*</span></label>
                                    <select name="departement"
                                        class="form-select  @error('departement') is-invalid @enderror" aria-label="Select"
                                        id="select-field-departement-update" data-placeholder="Choisir localité">
                                        <option value="{{ $formation?->departement?->id }}">
                                            {{ $formation?->departement?->nom }}</option>
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
                                    <label for="lieu" class="form-label">Lieu exact<span
                                            class="text-danger mx-1">*</span></label>
                                    <input type="text" name="lieu" value="{{ $formation?->lieu ?? old('lieu') }}"
                                        class="form-control form-control-sm @error('lieu') is-invalid @enderror"
                                        id="lieu" placeholder="Lieu exact">
                                    @error('lieu')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="module" class="form-label">Module<span
                                            class="text-danger mx-1">*</span></label>
                                    <select name="module" class="form-select  @error('module') is-invalid @enderror"
                                        aria-label="Select" id="select-field-module-modal"
                                        data-placeholder="Choisir module">
                                        <option value="">
                                            {{ old('module') }}
                                        </option>
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}">
                                                {{ $module->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('module')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div> --}}

                                {{--  <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="operateur" class="form-label">Opérateur<span
                                            class="text-danger mx-1">*</span></label>
                                    <select name="operateur"
                                        class="form-select  @error('operateur') is-invalid @enderror"
                                        aria-label="Select" id="select-field-operateur"
                                        data-placeholder="Choisir operateur">
                                        <option value="">
                                            {{ old('operateur') }}
                                        </option>
                                        @foreach ($operateurs as $operateur)
                                            <option value="{{ $operateur->id }}">
                                                {{ $operateur->sigle }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('operateur')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div> --}}

                                <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="types_formation" class="form-label">Type formation<span
                                            class="text-danger mx-1">*</span></label>
                                    <select name="types_formation"
                                        class="form-select  @error('types_formation') is-invalid @enderror"
                                        aria-label="Select" id="select-field-types_formation_update"
                                        data-placeholder="Choisir type formation">
                                        <option value="{{ $formation->types_formation->id }}">
                                            {{ $formation->types_formation->name ?? old('types_formation') }}
                                        </option>
                                        @foreach ($types_formations as $types_formation)
                                            <option value="{{ $types_formation->id }}">
                                                {{ $types_formation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('types_formation')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="niveau_qualification" class="form-label">Niveau qualification<span
                                            class="text-danger mx-1">*</span></label>
                                    <select name="niveau_qualification"
                                        class="form-select  @error('niveau_qualification') is-invalid @enderror"
                                        aria-label="Select" id="select-field-niveau_qualification_update"
                                        data-placeholder="Choisir niveau de qualification">
                                        <option value="{{ $formation->niveau_qualification }}">
                                            {{ $formation->niveau_qualification ?? old('niveau_qualification') }}
                                        </option>
                                        <option value="{{ old('c') }}">
                                            {{ old('niveau_qualification') }}
                                        </option>
                                        <option value="Titre qualification">
                                            Titre qualification
                                        </option>
                                        <option value="Renforcement capacité">
                                            Renforcement capacité
                                        </option>
                                    </select>
                                    @error('niveau_qualification')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="date_debut" class="form-label">Date début</label>
                                    <input type="date" name="date_debut"
                                        value="{{ $formation->date_debut->format('Y-m-d') ?? old('date_debut') }}"
                                        class="form-control form-control-sm @error('date_debut') is-invalid @enderror"
                                        id="date_debut" placeholder="Date début">
                                    @error('date_debut')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4 mb-0">
                                    <label for="date_fin" class="form-label">Date fin</label>
                                    <input type="date" name="date_fin"
                                        value="{{ $formation?->date_fin?->format('Y-m-d') ?? old('date_fin') }}"
                                        class="form-control form-control-sm @error('date_fin') is-invalid @enderror"
                                        id="date_fin" placeholder="Date début">
                                    @error('date_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-12 col-lg-12 mb-0">
                                    <label for="titre" class="form-label">Titre (convention)</label>
                                    <input type="text" name="titre" value="{{ $formation->titre ?? old('titre') }}"
                                        class="form-control form-control-sm @error('titre') is-invalid @enderror"
                                        id="titre" placeholder="Ex: 4ème catégorie de la convention collective ...">
                                    @error('titre')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>

                        </div>

                        <div class="text-center p-3">
                            <button type="submit" class="btn btn-primary"><i
                                    class="bi bi-printer"></i>&nbsp;Modifier</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
