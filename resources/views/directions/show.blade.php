@extends('layout.user-layout')
@section('title', 'ONFP - Détails')
@section('space-work')

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Données</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $direction->name.' ('.$direction->sigle.')'}}</h5>
                        <p>Liste de employés</p>
                        <!-- Table with stripped rows -->
                        <table class="table datatables align-middle" id="table-directions">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Matricule</th>
                                    <th>Prénom & Nom</th>
                                    <th>Contact</th>
                                    <th>Fonction</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($direction->employees as $employe)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $employe->matricule }}</td>
                                        <td>{{ $employe->user->civilite.' '.$employe->user->firtname.' '.$employe->user->name }}</td>
                                        <td>{{ $employe->user->telephone }}</td>
                                        <td>{{ $employe->user->fonction }}</td>
                                        <td>
                                            <span class="d-flex mt-2 align-items-baseline"><a
                                                    href="{{ url('employes/' . $employe->id) }}"
                                                    class="btn btn-warning btn-sm mx-1" title="Donner permission"><i
                                                        class="bi bi-eye"></i></a>
                                                <div class="filter">
                                                    <a class="icon" href="" data-bs-toggle="dropdown"><i
                                                            class="bi bi-three-dots"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                        <li><a class="dropdown-item btn btn-sm mx-1"
                                                                href="{{ url('employes/' . $employe->id . '/edit') }}"
                                                                class="mx-1"><i class="bi bi-pencil"></i> Modifier</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ url('employes', $employe->id) }}" method="post">
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
        new DataTable('#table-directions', {
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
