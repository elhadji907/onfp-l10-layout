@extends('layout.user-layout')
@section('space-work')
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xl-2 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Roles</h6>
                                    </li>
                                    {{-- @foreach ($roles as $role) --}}
                                    {{-- <li><a class="dropdown-item" href="{{ url('roles/' . $role->name . '/get-users') }}">{{ $role->name }}</a></li> --}}
                                    <li><a class="dropdown-item" href="#">
                                            @foreach (Auth::user()->roles as $role)
                                                <div>{{ $role->name }}</div>
                                            @endforeach
                                        </a></li>
                                    {{-- @endforeach --}}
                                </ul>
                            </div>

                            <a href="{{ url('/user') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Utilisateurs <span>| Tous</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-plus-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $total_user }}</h6>
                                            {{--  <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span> --}}

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Sales Card -->
                    <div class="col-xl-2 col-md-6">
                        <div class="card info-card sales-card">

                            <a href="{{ url('/arrives') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Courriers <span>| Arrivés</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-envelope-open"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $total_arrive }}</h6>
                                            {{--  <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span> --}}

                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div><!-- End Sales Card -->
                    <div class="col-xl-2 col-md-6">
                        <div class="card info-card sales-card">

                            <a href="{{ url('/departs') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Courriers <span>| Départs</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $total_depart }}</h6>
                                            {{--  <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span> --}}

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Sales Card -->
                    <div class="col-xl-2 col-md-6">
                        <div class="card info-card sales-card">

                            <a href="{{ url('/departs') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Demandes <span>| Individuelles</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-folder"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $total_individuelle }}</h6>
                                            {{--  <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span> --}}

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Sales Card -->
                </div>
            </div>
        </div>
    </section>
@endsection
