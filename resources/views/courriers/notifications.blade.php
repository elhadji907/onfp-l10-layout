@extends('layout.user-layout')
@section('title', 'ONFP - toutes les notifications')
@section('space-work')

    <div class="pagetitle">
        {{-- <h1>Data Tables</h1> --}}
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Notifications</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @foreach (auth()->user()->unReadNotifications as $notification)
                    <a class="dropdown-item d-flex align-items-centers"
                        href="{{ route('courriers.showFromNotification', ['courrier' => $notification->data['courrierId'], 'notification' => $notification->id]) }}">
                        {{-- <li class="notification-item"> --}}
                            {{-- <i class="bi bi-check-circle text-success"></i> --}}
                            <div>
                                <h4>{!! $notification->data['firstname'] !!}&nbsp;{!! $notification->data['name'] !!}</h4>
                                <p>{!! $notification->data['courrierTitle'] !!}</p>
                                <p>{!! $notification->created_at->diffForHumans() !!}</p>
                            </div>
                        {{-- </li> --}}
                    </a>
                    <hr>
                @endforeach
                
            </div>
        </div>
    </section>
@endsection
