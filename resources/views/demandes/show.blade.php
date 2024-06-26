@extends('layout.user-layout')
@section('title', 'Détails')
@section('space-work')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-12">
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
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="d-flex mt-2 align-items-baseline"><a href="{{ url('/profil') }}"
                                    class="btn btn-success btn-sm" title="retour"><i
                                        class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                <p> | Détails</p>
                            </span>
                            @if (isset($demandeur->numero_dossier))
                                <button type="button" class="btn btn-info btn-sm">
                                    <span class="badge bg-white text-info">{{ $demandes_total }}/5</span>
                                </button>
                            @endif
                            {{-- <span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i>
                                {{ $demandes_total }}/5</span> --}}
                            @if (isset($demandeur->numero_dossier))
                                <button type="button" class="btn btn-primary float-end btn-rounded" data-bs-toggle="modal"
                                    data-bs-target="#AddIndividuelleModal">
                                    <i class="bi bi-person-plus" title="Ajouter"></i>
                                </button>
                            @endif
                        </div>
                        @if (isset($demandeur->numero_dossier))
                            <h5 class="card-title">N° dossier : {{ $demandeur?->numero_dossier }}</h5>
                            <!-- demande -->
                            <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">N° demande</th>
                                            <th scope="col">CIN</th>
                                            <th scope="col">Prénom & Nom</th>
                                            <th scope="col">Module</th>
                                            <th scope="col">Localité</th>
                                            <th scope="col">Statut</th>
                                            <th class="col"><i class="bi bi-gear"></i> Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Auth::user()->individuelles as $individuelle)
                                            <tr>
                                                <td>{{ $individuelle->numero }}</td>
                                                <td>{{ $individuelle->demandeur->user?->cin }}</td>
                                                <td>{{ $individuelle->demandeur->user?->firstname . ' ' . $individuelle->demandeur->user?->name }}
                                                </td>
                                                <td>{{ $individuelle->module->name }}</td>
                                                <td>{{ $individuelle->departement->nom }}</td>
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
                                                    <span class="d-flex align-items-baseline">
                                                        {{--  <a class="btn btn-success btn-sm"
                                                            href="{{ route('individuelles.edit', $individuelle->id) }}"
                                                            class="mx-1" title="Modifier"><i class="bi bi-pencil"></i></a> --}}

                                                        <a href="{{ route('individuelles.show', $individuelle->id) }}"
                                                            class="btn btn-success btn-sm" title="voir détails"><i
                                                                class="bi bi-eye"></i></a>
                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li><a class="dropdown-item btn btn-sm"
                                                                        href="{{ route('individuelles.edit', $individuelle->id) }}"
                                                                        class="mx-1" title="Modifier"><i
                                                                            class="bi bi-pencil"></i>Modifier</a>
                                                                </li>
                                                                {{-- <li>
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
                                                                </li> --}}
                                                            </ul>
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        @else
                            <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
                                @foreach ($demandeur->individuelles as $individuelle)
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ route('individuelles.edit', $individuelle->id) }}">Cliquez ici pour
                                        compléter votre première demande</a>
                                @endforeach
                                {{-- <span class="badge bg-secondary">
                                <h6>Informations personnelles</h6>
                            </span> --}}
                                {{-- <h5 class="card-title">Aucune demande pour le moment !!!</h5> --}}
                            </div>
                        @endif
                        <!-- End demande -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">
            <div class="modal fade" id="AddIndividuelleModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        {{-- <form method="POST" action="{{ route('addRegion') }}">
                        @csrf --}}
                        <form method="post" action="{{ route('individuelles.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-plus" title="Ajouter"></i> Ajouter une nouvelle
                                    demande
                                    individuelle</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="module" class="form-label">Formation sollicitée<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="module" class="form-select  @error('module') is-invalid @enderror"
                                            aria-label="Select" id="select-field-module"
                                            data-placeholder="Choisir formation">
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
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="autre_module" class="form-label">Si autre formation ? précisez</label>
                                        <input type="text" name="autre_module" value="{{ old('autre_module') }}"
                                            class="form-control form-control-sm @error('autre_module') is-invalid @enderror"
                                            id="autre_module" placeholder="autre diplôme académique">
                                        @error('autre_module')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="departement" class="form-label">Lieu de formation<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="departement"
                                            class="form-select  @error('departement') is-invalid @enderror"
                                            aria-label="Select" id="select-field-departement"
                                            data-placeholder="Choisir la localité">
                                            <option value="{{ Auth::user()->demandeur?->departement?->id }}">
                                                {{ Auth::user()->demandeur?->departement?->nom }}</option>
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
                                        <label for="Niveau étude" class="form-label">Niveau étude<span
                                                class="text-danger mx-1">*</span></label>
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

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="diplome_academique" class="form-label">Diplôme académique<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="diplome_academique"
                                            class="form-select  @error('diplome_academique') is-invalid @enderror"
                                            aria-label="Select" id="select-field-diplome_academique"
                                            data-placeholder="Choisir diplôme académique">
                                            <option value="{{ old('diplome_academique') }}">
                                                {{ old('diplome_academique') }}
                                            </option>
                                            <option value="Aucun">
                                                Aucun
                                            </option>
                                            <option value="Arabe">
                                                Arabe
                                            </option>
                                            <option value="CFEE">
                                                CFEE
                                            </option>
                                            <option value="BFEM">
                                                BFEM
                                            </option>
                                            <option value="BAC">
                                                BAC
                                            </option>
                                            <option value="Licence">
                                                Licence
                                            </option>
                                            <option value="Master 2">
                                                Master 2
                                            </option>
                                            <option value="Doctorat">
                                                Doctorat
                                            </option>
                                            <option value="Autre">
                                                Autre
                                            </option>
                                        </select>
                                        @error('diplome_academique')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="autre_diplome_academique" class="form-label">Si autre ?
                                            précisez</label>
                                        <input type="text" name="autre_diplome_academique"
                                            value="{{ old('autre_diplome_academique') }}"
                                            class="form-control form-control-sm @error('autre_diplome_academique') is-invalid @enderror"
                                            id="autre_diplome_academique" placeholder="autre diplôme académique">
                                        @error('autre_diplome_academique')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="option_diplome_academique" class="form-label">Option du
                                            diplôme</label>
                                        <input type="text" name="option_diplome_academique"
                                            value="{{ old('option_diplome_academique') }}"
                                            class="form-control form-control-sm @error('option_diplome_academique') is-invalid @enderror"
                                            id="option_diplome_academique" placeholder="Ex: Mathématiques">
                                        @error('option_diplome_academique')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="etablissement_academique" class="form-label">Etablissement
                                            académique</label>
                                        <input type="text" name="etablissement_academique"
                                            value="{{ old('etablissement_academique') }}"
                                            class="form-control form-control-sm @error('etablissement_academique') is-invalid @enderror"
                                            id="etablissement_academique" placeholder="Etablissement obtention">
                                        @error('etablissement_academique')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="diplome_pro" class="form-label">Diplôme professionnel<span
                                                class="text-danger mx-1">*</span></label>
                                        <select name="diplome_professionnel"
                                            class="form-select  @error('diplome_professionnel') is-invalid @enderror"
                                            aria-label="Select" id="select-field-diplome_professionnel"
                                            data-placeholder="Choisir diplôme professionnel">
                                            <option value="{{ old('diplome_professionnel') }}">
                                                {{ old('diplome_professionnel') }}
                                            </option>
                                            <option value="Aucun">
                                                Aucun
                                            </option>
                                            <option value="CAP">
                                                CAP
                                            </option>
                                            <option value="BEP">
                                                BEP
                                            </option>
                                            <option value="BT">
                                                BT
                                            </option>
                                            <option value="BTS">
                                                BTS
                                            </option>
                                            <option value="CPS">
                                                CPS
                                            </option>
                                            <option value="L3 Pro">
                                                L3 Pro
                                            </option>
                                            <option value="DTS">
                                                DTS
                                            </option>
                                            <option value="Autre">
                                                Autre
                                            </option>
                                        </select>
                                        @error('diplome_professionnel')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="autre_diplome_professionnel" class="form-label">Si autre ?
                                            précisez</label>
                                        <input type="text" name="autre_diplome_professionnel"
                                            value="{{ old('autre_diplome_professionnel') }}"
                                            class="form-control form-control-sm @error('autre_diplome_professionnel') is-invalid @enderror"
                                            id="autre_diplome_professionnel"
                                            placeholder="autre diplôme professionnel ou attestations">
                                        @error('autre_diplome_professionnel')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="etablissement_professionnel" class="form-label">Etablissement
                                            professionnel</label>
                                        <input type="text" name="etablissement_professionnel"
                                            value="{{ old('etablissement_professionnel') }}"
                                            class="form-control form-control-sm @error('etablissement_professionnel') is-invalid @enderror"
                                            id="etablissement_professionnel" placeholder="Etablissement obtention">
                                        @error('etablissement_professionnel')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 mb-0">
                                        <label for="specialite_diplome_professionnel"
                                            class="form-label">Spécialité</label>
                                        <input type="text" name="specialite_diplome_professionnel"
                                            value="{{ old('specialite_diplome_professionnel') }}"
                                            class="form-control form-control-sm @error('specialite_diplome_professionnel') is-invalid @enderror"
                                            id="specialite_diplome_professionnel" placeholder="Ex: électricité">
                                        @error('specialite_diplome_professionnel')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="projet_poste_formation" class="form-label">Votre projet après la
                                            formation<span class="text-danger mx-1">*</span></label>
                                        <select name="projet_poste_formation"
                                            class="form-select  @error('projet_poste_formation') is-invalid @enderror"
                                            aria-label="Select" id="select-field-projet_poste_formation"
                                            data-placeholder="Choisir projet">
                                            <option value="{{ old('projet_poste_formation') }}">
                                                {{ old('projet_poste_formation') }}
                                            </option>
                                            <option value="Poursuivre mes études">
                                                Poursuivre mes études
                                            </option>
                                            <option value="Chercher un emploi">
                                                Chercher un emploi
                                            </option>
                                            <option value="Lancer mon entreprise">
                                                Lancer mon entreprise
                                            </option>
                                            <option value="Retourner dans mon entreprise">
                                                Retourner dans mon entreprise
                                            </option>
                                            <option value="Aucun de ces projets">
                                                Aucun de ces projets
                                            </option>
                                        </select>
                                        @error('projet_poste_formation')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="qualification" class="form-label">Qualification et autres
                                            diplômes</label>
                                        <textarea name="qualification" id="qualification" rows="1"
                                            class="form-control form-control-sm @error('qualification') is-invalid @enderror"
                                            placeholder="Qualification et autres diplômes">{{ old('qualification') }}</textarea>
                                        @error('qualification')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12 mb-0">
                                        <label for="experience" class="form-label">Expériences et stages</label>
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
                                        <label for="projetprofessionnel" class="form-label">Informations complémentaires
                                            sur
                                            le projet
                                            professionnel</label>
                                        <textarea name="projetprofessionnel" id="projetprofessionnel" rows="2"
                                            class="form-control form-control-sm @error('projetprofessionnel') is-invalid @enderror"
                                            placeholder="Si vous disposez déjà d'un projet professionnel, merci d'écrire son résumé en quelques lignes">{{ old('projetprofessionnel') }}</textarea>
                                        @error('projetprofessionnel')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
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
