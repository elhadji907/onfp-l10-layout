@extends('layout.user-layout')
@section('title', 'Détails département')
@section('space-work')
    {{-- <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($message = Session::get('status'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        region="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12 pt-0">
                                <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('departements.index') }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Liste des départements</p>
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title">Détail département de : {{ $departement->nom }}, région de
                            {{ $departement->region->nom }}</h5>
                        <!-- departement -->
                        <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                            <div class="row mb-3 col-12 col-md-6 col-lg-6 pt-1">
                                <div class="form-floating mb-3">
                                    <ol>
                                        @foreach ($departement->arrondissements as $arrondissement)
                                            <li> Arondissement de : {{ $arrondissement->nom }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </form><!-- End departement -->
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pt-1">
                            <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('departements.index') }}"
                                    class="btn btn-success btn-sm" title="retour"><i
                                        class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                <p> | Liste des localités</p>
                            </span>
                        </div>
                        <table class="table datatables align-middle" id="table-individuelles">
                            <thead>
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-center">CIN</th>
                                    <th>Prénom et NOM</th>
                                    <th>Date et lieu de naissance</th>
                                    <th>Module</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($departement->individuelles as $individuelle)
                                    @isset($individuelle?->numero)
                                        <tr>
                                            <td><span class="badge bg-default text-dark">{{ $individuelle?->numero }}</span>
                                            </td>
                                            <td>{{ $individuelle->demandeur->user?->cin }}</td>
                                            <td>{{ $individuelle->demandeur->user?->firstname . ' ' . $individuelle->demandeur->user?->name }}
                                            </td>
                                            <td>{{ $individuelle->demandeur->user->date_naissance?->format('d/m/Y') . ' à ' . $individuelle->demandeur->user->lieu_naissance }}
                                            </td>
                                            <td>{{ $individuelle->module?->name }}</td>
                                            <td>
                                                @isset($individuelle?->statut)
                                                    @if ($individuelle?->statut == 'Attente')
                                                    <span class="badge bg-secondary text-white">{{ $individuelle?->statut }}
                                                        </span>
                                                    @endif
                                                    @if ($individuelle?->statut == 'Validée')
                                                        <span class="badge bg-success text-white">{{ $individuelle?->statut }}
                                                        </span>
                                                    @endif
                                                    @if ($individuelle?->statut == 'Rejetée')
                                                        <span class="badge bg-danger text-white">{{ $individuelle?->statut }}
                                                        </span>
                                                    @endif
                                                @endisset
                                            </td>
                                            <td>
                                                <span class="d-flex align-items-baseline"><a
                                                        href="{{ route('individuelles.show', $individuelle->id) }}"
                                                        class="btn btn-primary btn-sm" title="voir détails"><i
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
                                                            <li>
                                                                <form
                                                                    action="{{ route('individuelles.destroy', $individuelle->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item show_confirm"
                                                                        title="Supprimer"><i
                                                                            class="bi bi-trash"></i>Supprimer</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endisset
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
