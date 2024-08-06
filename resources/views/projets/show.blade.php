@extends('layout.user-layout')
@section('title', 'ONFP - ' . $projet?->name)
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
                        <li class="breadcrumb-item active">Projet {{ $projet?->sigle }}</li>
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
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Projet
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#modules-overview">Modules</button>
                                </li>

                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="card-title">À propos</h5>
                                        <p class="fst-italic">{{ $projet?->description }}</p>

                                        <h5 class="card-title">Détails projet</h5>

                                        <div class="row col-12 col-md-12 col-lg-12 mb-2">
                                            <div class="label">Intitulé projet / programme</div>
                                            <div>{{ $projet?->name }}</div>
                                        </div>

                                        <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                            <div class="label">Sigle projet / programme</div>
                                            <div>{{ $projet?->sigle }}</div>
                                        </div>

                                        <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                            <div class="label">Date signature</div>
                                            <div>{{ $projet?->date_signature?->format('d/m/Y') }}</div>
                                        </div>
                                        @isset($projet->budjet)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Budjet</div>
                                                <div>{{ number_format($projet?->budjet, 2, ',', ' ') }}</div>
                                            </div>
                                        @endisset
                                        @isset($projet?->duree)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Durée</div>
                                                <div>{{ $projet?->duree }}</div>
                                            </div>
                                        @endisset
                                        @isset($projet?->debut)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Date début</div>
                                                <div>{{ $projet?->debut?->format('d/m/Y') }}</div>
                                            </div>
                                        @endisset
                                        @isset($projet?->fin)
                                            <div class="row col-12 col-md-3 col-lg-3 mb-2">
                                                <div class="label">Date fin</div>
                                                <div>{{ $projet?->fin?->format('d/m/Y') }}</div>
                                            </div>
                                        @endisset
                                    </form>
                                </div>

                                <div class="tab-pane fade show profile-overview" id="modules-overview">

                                </div>

                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
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
