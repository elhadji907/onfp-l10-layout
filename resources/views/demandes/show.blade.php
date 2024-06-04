@extends('layout.user-layout')
@section('title', 'Détails')
@section('space-work')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-12">
                @if ($message = Session::get('status'))
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
                                                <td>{{ $individuelle->numero }}</td>
                                                <td>{{ $individuelle->module->name }}</td>
                                                <td>{{ $individuelle->departement->nom }}</td>
                                                <td>{{ $individuelle->statut }}</td>
                                                <td></td>
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
