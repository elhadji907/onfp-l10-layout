@extends('layout.user-layout')
@section('title', 'ONFP - courriers départs')
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
                <div class="card">
                    <div class="card-body">
                        <div class="pt-1">
                            <a href="{{ route('departs.create') }}" class="btn btn-primary float-end btn-rounded"><i
                                    class="fas fa-plus"></i>
                                <i class="bi bi-person-plus" title="Ajouter"></i> </a>
                        </div>
                        <h5 class="card-title">Liste des courriers départs</h5>
                        {{-- <p>Le tableau des courriers départs</p> --}}
                        <!-- Table with stripped rows -->
                        <table class="table datatables align-middle" id="table-departs">
                            <thead>
                                <tr>
                                    <th>Date et n° départ</th>
                                    <th>Date et n° correspondance</th>
                                    <th>Destinataire</th>
                                    <th>Objet</th>
                                    <th>Service expéditeur</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($departs as $depart)
                                    <tr>
                                        <td>{{ $depart->courrier->date_depart?->format('d/m/Y') }} <br>
                                            <span style="color: rgb(255, 0, 0);">{{ ' n° ' . $depart?->numero }}</span> </td>
                                        <td>{{ $depart->courrier->date_cores?->format('d/m/Y') }} <br>
                                            <span style="color: rgb(255, 0, 0);">{{ ' n° ' . $depart?->courrier->numero }}</span> </td>
                                        <td>{{ $depart?->destinataire }}</td>
                                        <td>{{ $depart->courrier?->objet }}</td>
                                        <td>{{ $depart->courrier?->reference }}</td>
                                        <td>
                                            <span class="d-flex mt-2 align-items-baseline"><a
                                                    href="{{ route('departs.show', $depart->id) }}"
                                                    class="btn btn-success btn-sm mx-1" title="voir détails"><i
                                                        class="bi bi-eye"></i></a>
                                                <div class="filter">
                                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                            class="bi bi-three-dots"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                        <li><a class="dropdown-item btn btn-sm mx-1"
                                                                href="{{ route('departs.edit', $depart->id) }}"
                                                                class="mx-1"><i class="bi bi-pencil"></i> Modifier</a>
                                                        </li>
                                                        <li><a class="dropdown-item btn btn-sm mx-1"
                                                                href="{{ url('depart-imputations', ['id' => $depart->id]) }}"
                                                                class="mx-1"><i class="bi bi-recycle"></i> Imputer</a>
                                                        </li>
                                                        <li><a class="dropdown-item btn btn-sm mx-1"
                                                                href="{!! url('coupon-depart', ['$id' => $depart->id]) !!}" class="mx-1"
                                                                target="_blank"><i
                                                                    class="bi bi-file-earmark-arrow-down"></i> Coupon</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('departs.destroy', $depart->id) }}"
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
    </section>

@endsection
@push('scripts')
    <script>
        new DataTable('#table-departs', {
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
