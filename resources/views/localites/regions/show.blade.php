@extends('layout.user-layout')
@section('title', 'Détails région')
@section('space-work')
    <section class="section">
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
                                <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('regions.index') }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Liste des régions</p>
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title">Détail région de : {{ $region->nom }}</h5>
                        <!-- region -->
                        <form method="post" action="#" enctype="multipart/form-data" class="row g-3">
                            <div class="row mb-3 col-12 col-md-6 col-lg-6 pt-1">
                                <div class="form-floating mb-3">
                                    <ol>
                                        @foreach ($region->departements as $departement)
                                            <li> Département de : {{ $departement->nom }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                        </form><!-- End region -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
