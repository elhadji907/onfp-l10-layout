@extends('layout.user-layout')
@section('title', 'ONFP - courriers arrivés')
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
                        <div class="pt-5">
                            <a href="{{ route('arrives.create') }}" class="btn btn-primary float-end btn-rounded"><i
                                    class="fas fa-plus"></i>
                                <i class="bi bi-person-plus" title="Ajouter"></i> </a>
                        </div>
                        <h5 class="card-title">Courriers arrivés</h5>
                        <p>Le tableau des courriers arrivés</p>
                        <!-- Table with stripped rows -->
                        <table class="table datatables align-middle" id="table-arrives">
                            <thead>
                                <tr>
                                    <th>Date arr.</th>
                                    <th>Date cor.</th>
                                    <th>N° courrier</th>
                                    <th>Expéditeur</th>
                                    <th>Objet</th>
                                    <th>Responsable</th>
                                    <th>Imputation</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($arrives as $arrive)
                                    <tr>
                                        <td>{{ $arrive->courrier->date_recep->format('d/m/Y') }}</td>
                                        <td>{{ $arrive->courrier->date_cores->format('d/m/Y') }}</td>
                                        <td class="text-center">{{ $arrive->numero }}</td>
                                        <td>{{ $arrive->courrier->expediteur }}</td>
                                        <td>{{ $arrive->courrier->objet }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="d-flex mt-2 align-items-baseline"><a
                                                    href="{{ route('arrives.edit', $arrive->id) }}"
                                                    class="btn btn-success btn-sm mx-1" title="Modifier"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <form action="{{ route('arrives.destroy', $arrive->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                        title="Supprimer"><i class="bi bi-trash"></i></button>
                                                </form>
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
        new DataTable('#table-arrives', {
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
