@extends('layout.user-layout')
@section('space-work')

<div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Données</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Utilisateurs</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N°</b>
                                    </th>
                                    <th>Prénom et Nom</th>
                                    <th>E-mail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($user_liste as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td></td>
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
