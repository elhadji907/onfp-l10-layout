@extends('layout.user-layout')
@section('title', 'Détails courrier arrivé')
@section('space-work')

    <section class="section profile">
        <div class="row">
            @if ($message = Session::get('status'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('arrives.index') }}"
                    class="btn btn-success btn-sm" title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                <p> | Liste des courriers arrivés</p>
            </span>
            <div class="col-xl-4">
                <div class="card border-info mb-3">
                    <div class="card-header text-center">
                        AUDIT
                    </div>
                    <div class="card-body profile-card pt-1 d-flex flex-column">
                        <h5 class="card-title">Informations complémentaires</h5>
                        <p>créé par <b>{{ $user_create_name }}</b>, {{ $courrier->created_at->diffForHumans() }}</p>
                        <p>modifié par <b>{{ $user_update_name }}</b>, {{ $courrier->updated_at->diffForHumans() }}</p>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card border-info mb-3">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Courrier</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link"><a class="dropdown-item btn btn-sm mx-1"
                                        href="{{ route('arrives.edit', $arrive->id) }}" class="mx-1"><i
                                            class="bi bi-pencil mx-1"></i>Modifier</a></button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link"><a class="dropdown-item btn btn-sm mx-1"
                                        href="{{ url('arrive-imputations', ['id' => $arrive->id]) }}" class="mx-1"><i
                                            class="bi bi-recycle mx-1"></i>Imputer</a></button>
                            </li>
                        </ul>
                        
                        <div class="tab-content pt-0">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Objet</h5>
                                <p class="small fst-italic">{{ $arrive->courrier->objet }}.</p>

                                <h5 class="card-title">Détails</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Date arrivé</div>
                                    <div class="col-lg-3 col-md-4">{{ $arrive->courrier->date_recep->format('d/m/Y') }}
                                    </div>
                                    <div class="col-lg-3 col-md-4 label">Date correspondance</div>
                                    <div class="col-lg-3 col-md-4">{{ $arrive->courrier->date_cores->format('d/m/Y') }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">N° correspondance</div>
                                    <div class="col-lg-3 col-md-4">{{ $arrive->courrier->numero }}</div>
                                    <div class="col-lg-3 col-md-4 label">Année</div>
                                    <div class="col-lg-3 col-md-4">{{ $arrive->courrier->annee }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Expéditeur</div>
                                    <div class="col-lg-3 col-md-4">{{ $arrive->courrier->expediteur }}</div>
                                    <div class="col-lg-3 col-md-4 label">Référence</div>
                                    <div class="col-lg-3 col-md-4">{{ $arrive->courrier->reference }}</div>
                                </div>

                                @isset($arrive->courrier->numero_reponse)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">N° réponse</div>
                                        <div class="col-lg-3 col-md-4">{{ $arrive->courrier->numero_reponse }}</div>
                                        <div class="col-lg-3 col-md-4 label">Date réponse</div>
                                        <div class="col-lg-3 col-md-4">{{ $arrive->courrier->date_reponse->format('d/m/Y') }}
                                        </div>
                                    </div>
                                @endisset

                                @isset($arrive->courrier->observation)
                                    <h5 class="card-title">Observations</h5>
                                    <p class="small fst-italic">{{ $arrive->courrier->observation }}.</p>
                                @endisset

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection