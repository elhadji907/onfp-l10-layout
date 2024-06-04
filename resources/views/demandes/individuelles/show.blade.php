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

                        <div class="row">
                            <div class="col-sm-12 pt-0">
                                <span class="d-flex mt-2 align-items-baseline"><a href="{{ url('/profil') }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Détails</p>
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title">N° dossier: </h5>
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
                                    <tr>
                                        <td><a href="" class="text-primary fw-bold"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <!-- End demande -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
