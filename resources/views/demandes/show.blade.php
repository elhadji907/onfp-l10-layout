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
                                <button type="button" class="btn btn-info">
                                    <span class="badge bg-white text-info">{{ $demandes_total }}/5</span>
                                </button>
                            @endif
                            {{-- <span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i>
                                {{ $demandes_total }}/5</span> --}}
                            @if (isset($demandeur->numero_dossier))
                                <a href="{{ route('individuelles.create') }}"
                                    class="btn btn-primary float-end btn-rounded"><i class="fas fa-plus"></i>
                                    <i class="bi bi-person-plus" title="Ajouter"></i> </a>
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
                                            <th scope="col">Module</th>
                                            <th scope="col">Localité</th>
                                            <th scope="col">Statut</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Auth::user()->individuelles as $individuelle)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('individuelles.show', $individuelle->id) }}"><b>{{ $individuelle->numero }}</b></a>
                                                </td>
                                                <td>{{ $individuelle->module->name }}</td>
                                                <td>{{ $individuelle->departement->nom }}</td>
                                                <td><span
                                                        class="badge bg-info text-dark">{{ $individuelle->statut }}</span>
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
    </section>
@endsection
