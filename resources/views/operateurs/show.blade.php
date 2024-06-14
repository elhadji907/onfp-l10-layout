@extends('layout.user-layout')
@section('title', 'ONFP - demandes operateurs')
@section('space-work')

    <section
        class="section profile min-vh-0 d-flex flex-column align-items-center justify-content-center py-0 section profile">
        <div class="container">
            <div class="pagetitle">
                {{-- <h1>Data Tables</h1> --}}
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">Opérateurs</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
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
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview"><i class="bi bi-eye"></i> Opérateur</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#responsable-overview"><i
                                            class="bi bi-person"></i> Représentant</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#module-overview">Modules
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#foration-overview">Formations</button>
                                </li>

                            </ul>
                            {{-- <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="d-flex mt-2 align-items-baseline"><a
                                    href="{{ route('operateurs.index', $operateur->id) }}" class="btn btn-secondary btn-sm"
                                    title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                <p> | Détails</p>
                            </span>
                            <button type="button" class="btn btn-primary float-end btn-rounded" data-bs-toggle="modal"
                                data-bs-target="#AddOperateurModal">
                                <i class="bi bi-person-plus" title="Ajouter"></i>
                            </button>
                        </div> --}}
                            {{-- Détail opérateur --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Opérateur</h5>
                                        <div class="col-12 col-md-9 col-lg-9 mb-0">
                                            <div class="label">Raison sociale</div>
                                            <div>{{ $operateur?->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Sigle</div>
                                            <div>{{ $operateur?->sigle }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Numéro agrément</div>
                                            <div>{{ $operateur?->numero_agrement }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Adresse email</div>
                                            <div>{{ $operateur?->email1 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone fixe</div>
                                            <div>{{ $operateur?->fixe }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone portable</div>
                                            <div>{{ $operateur?->telephone1 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Boite postale</div>
                                            <div>{{ $operateur?->user?->bp }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Catégorie</div>
                                            <div>{{ $operateur?->categorie }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Statut juridique</div>
                                            <div>{{ $operateur?->statut }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Autre statut</div>
                                            <div>{{ $operateur?->autre_statut }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Siège</div>
                                            <div>{{ $operateur?->departement?->nom }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Adrese</div>
                                            <div>{{ $operateur?->adresse }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">RCCM/Ninea</div>
                                            <div>{{ $operateur?->rccm }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">N° RCCM/Ninea</div>
                                            <div>{{ $operateur?->ninea }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Quitus</div>
                                            <div>{{ $operateur?->quitus }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Date délivrance quitus</div>
                                            <div>{{ $operateur?->debut_quitus?->diffForHumans() }}</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Détail représentant --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="responsable-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Représentant</h5>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Civilité</div>
                                            <div>{{ $operateur?->user?->civilite }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Prénom</div>
                                            <div>{{ $operateur->prenom_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Nom</div>
                                            <div>{{ $operateur->nom_responsable }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Email</div>
                                            <div>{{ $operateur->email2 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Téléphone</div>
                                            <div>{{ $operateur->telephone2 }}</div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 mb-0">
                                            <div class="label">Fonction responsable</div>
                                            <div>{{ $operateur->fonction_responsable }}</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Détail Modules --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="module-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">Modules</h5>
                                    </form>
                                </div>
                            </div>
                            {{-- Détail Formations --}}
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview pt-3" id="foration-overview">
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
    </section>

@endsection
