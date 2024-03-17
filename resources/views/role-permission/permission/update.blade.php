@extends('layout.user-layout')
@section('title', 'Modification permission')
@section('space-work')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if ($message = Session::get('status'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 pt-5">
                                <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('permissions.index') }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Liste des permissions</p>
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title">Modification permission</h5>
                        <!-- Permission -->
                        <form method="post" action="{{ url('permissions/' . $permission->id) }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="form-label"></label>
                                <input type="text" name="name" value="{{ $permission->name ?? old('name') }}"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                                    placeholder="Nom permission">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form><!-- End Permission -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
