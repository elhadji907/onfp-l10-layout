@extends('layout.user-layout')
@section('title', 'accorder permission')
@section('space-work')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-12">
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
                                <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('roles.index') }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Liste des roles</p>
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title">Role : {{ $role->name }}</h5>
                        <!-- role -->
                        <form method="post" action="{{ url('roles/' . $role->id . '/give-permissions') }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="form-check col-md-2">
                                    <label for="#">Choisir tout</label>
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                </div>
                                <div></div>
                                @foreach ($permissions as $permission)
                                    <div class="form-check col-md-2">
                                        <label>
                                            <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                class="form-check-input @error('permissions') is-invalid @enderror">
                                            {{ $permission->name }}
                                            @error('permissions')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form><!-- End role -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection