@extends('layout.user-layout')
@section('title', $title)
@section('space-work')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                @can('user-view')
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                @endcan
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Générer des rapports</li>
            </ol>
        </nav>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
            </div>
        @endforeach
    @endif
    {{--  <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('formations.index') }}"
                class="btn btn-success btn-sm" title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
            <p> | retour</p>
        </span>
    </div> --}}
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                @isset($formations)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('formations.index') }}" class="btn btn-success btn-sm"
                                    title="retour"><i class="bi bi-arrow-counterclockwise"></i></a> | {{ $title }}</h5>
                            <div class="table-responsive">
                                <table class="table datatables align-middle" id="table-formations">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle;">Region</th>
                                            <th rowspan="2" style="vertical-align: middle;">Lieux</th>
                                            <th rowspan="2" style="vertical-align: middle;">Modules</th>
                                            <th rowspan="2" style="vertical-align: middle;">Bénéficiaires</th>
                                            <th rowspan="2" style="vertical-align: middle;">N° LM et DATE</th>
                                            <th colspan="3" class="text-center">Effectif prévus</th>
                                            <th colspan="6" class="text-center">Effectif formés</th>
                                            <th rowspan="2" style="vertical-align: middle;">REF CONV.</th>
                                            <th rowspan="2" style="vertical-align: middle;">FRAIS OPERA.</th>
                                            <th rowspan="2" style="vertical-align: middle;">FRAIS ADDIT.</th>
                                            <th rowspan="2" style="vertical-align: middle;">AUTRES FRAIS</th>
                                            <th rowspan="2" style="vertical-align: middle;">BUDGET TOTAL</th>
                                            <th rowspan="2" style="vertical-align: middle;">NIVEAU QUALIF.</th>
                                            <th rowspan="2" style="vertical-align: middle;">OPERATEUR</th>
                                            <th rowspan="2" style="vertical-align: middle;">SUIVI DOSSIER</th>
                                        </tr>
                                        <tr>
                                            <th>H</th>
                                            <th>F</th>
                                            <th>T</th>
                                            <th>H</th>
                                            <th>F</th>
                                            <th>J</th>
                                            <th>T</th>
                                            <th>Début</th>
                                            <th>Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($formations as $formation)
                                            @if (!empty($formation->code))
                                                <tr>
                                                    <td>{{ $formation?->departement?->region?->nom }}</td>
                                                    <td>{{ $formation?->lieu }}</td>
                                                    <td>
                                                        @isset($formation?->module?->name)
                                                            {{ $formation?->module?->name }}
                                                        @endisset
                                                        @isset($formation?->collectivemodule?->module)
                                                            {{ $formation?->collectivemodule?->module }}
                                                        @endisset
                                                    </td>
                                                    <td>{{ $formation?->name }}</td>
                                                    <td>{{ $formation?->lettre_mission }}</td>
                                                    <td>{{ $formation?->prevue_h }}</td>
                                                    <td>{{ $formation?->prevue_f }}</td>
                                                    <td>{{ $formation?->effectif_prevu }}</td>
                                                    <td>{{ $formation?->forme_h }}</td>
                                                    <td>{{ $formation?->forme_f }}</td>
                                                    <td></td>
                                                    <td>{{ $formation?->total }}</td>
                                                    <td>{{ date_format(date_create($formation?->date_debut), 'd/m/Y') }}</td>
                                                    <td>{{ date_format(date_create($formation?->date_fin), 'd/m/Y') }}</td>
                                                    <td>{{ $formation?->numero_convention }}</td>
                                                    <td>{{ $formation?->frais_operateurs }}</td>
                                                    <td>{{ $formation?->frais_add }}</td>
                                                    <td>{{ $formation?->autes_frais }}</td>
                                                    <td>{{ $formation?->frais_operateurs + $formation?->frais_add + $formation?->autes_frais }}
                                                    </td>
                                                    <td>{{ $formation?->niveau_qualification }}</td>
                                                    <td>{{ $formation?->operateur?->user?->username }}</td>
                                                    <td>{{ $formation?->ingenieur?->initiale }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
        <div class="modal fade" id="generate_rapport" tabindex="-1" role="dialog" aria-labelledby="generate_rapportLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Générer rapport demandes formations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('formations.rapport') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                    <div class="row">

                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                            <div class="form-group">
                                                <label>De</label>
                                                <input type="date" name="from_date"
                                                    class="form-control form-control-sm @error('from_date') is-invalid @enderror from_date">
                                            </div>
                                            @error('from_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 col-xxl-12">
                                            <div class="form-group">
                                                <label>À</label>
                                                <input type="date" name="to_date"
                                                    class="form-control form-control-sm @error('to_date') is-invalid @enderror to_date">
                                            </div>
                                            @error('to_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Fermer</button>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-primary btn-block submit_rapport btn-sm">Envoyer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        new DataTable('#table-formations', {
            layout: {
                topStart: {
                    buttons: ['csv', 'excel'],
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
