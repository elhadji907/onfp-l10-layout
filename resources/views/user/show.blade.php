@extends('layout.user-layout')
@section('title', 'Détails utilisateur')
@section('space-work')

    <section class="section profile">
        <div class="row">
            @if ($message = Session::get('status'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('users.index') }}" class="btn btn-success btn-sm"
                    title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                <p> | retour, liste des utilisateurs</p>
            </span>
            <div class="col-xl-4">
                <div class="card border-info mb-3">
                    <div class="card-header text-center">
                        AUDIT
                    </div>
                    <div class="card-body profile-card pt-1 d-flex flex-column">
                        <h5 class="card-title">Informations complémentaires</h5>
                        <p>Créé le {{ $user->created_at->format('d/m/Y à H:i:s') }} par, <br> <span
                                class="fst-italic fw-bolder">
                                {{-- {{ $user_create->firstname }}
                                {{ $user_create->name }} --}}
                            </span></label></p>
                        <p>Modifié le {{ $user->updated_at->format('d/m/Y à H:i:s') }} par, <br>
                            <span class="fst-italic fw-bolder">
                                {{--  {{ $user_create->firstname }}
                                {{ $user_create->name }} --}}
                            </span></label>
                        </p>
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
                                    data-bs-target="#profile-overview">Utilisateur</button>
                            </li>

                            {{-- <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-edit">Imputer</button>
                            </li> --}}

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#"><a
                                        class="dropdown-item btn btn-sm mx-1" href="{{ route('users.edit', $user->id) }}"
                                        class="mx-1"><i class="bi bi-pencil mx-1"></i>Modifier</a></button>
                            </li>

                        </ul>
                        <div class="tab-content pt-0">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                {{-- <h5 class="card-title">Objet</h5>
                                <p class="small fst-italic"></p> --}}

                                <h5 class="card-title">Détails</h5>

                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-3 label ">Prénom</div>
                                    <div class="col-6 col-md-4 col-lg-3">{{ $user->firstname }}
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3 label">Nom</div>
                                    <div class="col-6 col-md-4 col-lg-3">{{ $user->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-3 label ">Email</div>
                                    <div class="col-6 col-md-4 col-lg-3">{{ $user->email }}</div>
                                    <div class="col-6 col-md-4 col-lg-3 label">Téléphone</div>
                                    <div class="col-6 col-md-4 col-lg-3">{{ $user->telephone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-3 label ">Adresse</div>
                                    <div class="col-6 col-md-4 col-lg-3">{{ $user->adresse }}</div>
                                    @if (isset($user->roles) && $user->roles != '[]')
                                        <div class="col-6 col-md-4 col-lg-3 label">Roles</div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }} |
                                            @endforeach
                                        </div>
                                    @endif
                                    {{--  @isset($user->roles)
                                    @endisset --}}
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form>

                                    {{-- <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address"
                                                value="A108 Adam Street, New York, NY 535022">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="(436) 486-3538 x29071">
                                        </div>
                                    </div> --}}

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Imputer</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
