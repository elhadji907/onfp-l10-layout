@extends('layout.user-layout')
@section('title', 'ONFP - toutes les validations')
@section('space-work')

    <div class="pagetitle">
        {{-- <h1>Data Tables</h1> --}}
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Accueil</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Validations</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @foreach ($individuelle->validationindividuelles as $count => $validationindividuelle)
        {{-- <i class="bi bi-exclamation-circle text-warning"></i> --}}
            <img src="{{ asset($validationindividuelle->user->getImage()) }}" alt="" class="rounded-circle w-20" width="40" height="auto">
            <div>
                <h4>{{ $validationindividuelle->user->firstname . ' ' . $validationindividuelle->user->name }}
                </h4>
                <p>
                    @if ($validationindividuelle->action == 'Attente')
                        <span class="badge rounded-pill bg-warning">{{ $validationindividuelle->action }}</span>
                    @endif
                    @if ($validationindividuelle->action == 'Validée')
                        <span class="badge rounded-pill bg-info">{{ $validationindividuelle->action }}</span>
                    @endif
                    @if ($validationindividuelle->action == 'Rejetée')
                        <span class="badge rounded-pill bg-danger">{{ $validationindividuelle->action }}</span>
                        <p>{!! $validationindividuelle?->motif !!}</p>
                    @endif
                    {{-- {{ $validationindividuelle->action }} --}}
                </p>
                <p>{!! $validationindividuelle->created_at->diffForHumans() !!}</p>
            </div>
        <hr class="dropdown-divider">
    @endforeach
@endsection
