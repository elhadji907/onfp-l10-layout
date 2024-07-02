@extends('layout.user-layout')
@section('title', 'ajouter dans la formation')
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
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert"><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 pt-0">
                                <span class="d-flex mt-0 align-items-baseline"><a
                                        href="{{ route('operateurs.index') }}" class="btn btn-success btn-sm"
                                        title="retour"><i class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Liste de tous les opérateurs</p>
                                </span>
                            </div>
                        </div>
                        <h5><u><b>MODULE</b>:</u> {{ $module->name }}</h5>
                        <h5><u><b>REGION</b>:</u> {{ $localite->nom }}</h5>
                        <form method="post"
                            action="{{ url('formationoperateurs', ['$idformation' => $formation->id, '$idmodule' => $formation->module->id, '$idlocalite' => $formation->departement->id]) }}"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                {{-- <div class="form-check col-md-2 pt-5">
                                    <label for="#">Choisir tout</label>
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                </div> --}}
                                <div class="form-check col-md-12 pt-5">
                                    <table class="table datatables align-middle" id="table-individuelles">
                                        <thead>
                                            <tr>
                                                <th>N° agrément</th>
                                                <th>Opérateurs</th>
                                                <th>Sigle</th>
                                                <th class="text-center">Modules</th>
                                                <th class="text-center">Formations</th>
                                                <th><i class="bi bi-gear"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($operateurs as $operateur)
                                                @isset($operateur?->numero_agrement)
                                                    <tr>
                                                        <td>
                                                            <input type="radio" name="operateur" value="{{ $operateur->id }}"
                                                                {{ in_array($operateur->id, $operateurFormation) ? 'checked' : '' }}
                                                                class="form-check-input @error('operateur') is-invalid @enderror">
                                                            @error('operateur')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <div>{{ $message }}</div>
                                                                </span>
                                                                @enderror{{ $operateur?->numero_agrement }}
                                                            </td>
                                                            <td>{{ $operateur?->name }}</td>
                                                            <td>{{ $operateur?->sigle }}</td>
                                                            <td style="text-align: center;">
                                                                @foreach ($operateur->operateurmodules as $operateurmodule)
                                                                    @if ($loop->last)
                                                                        <a href="#"><span
                                                                                class="badge bg-info">{{ $loop->count }}</span></a>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                <span class="d-flex align-items-baseline"><a
                                                                        href="{{ route('operateurs.show', $operateur->id) }}"
                                                                        class="btn btn-primary btn-sm" title="voir détails"><i
                                                                            class="bi bi-eye"></i></a>
                                                                    <div class="filter">
                                                                        <a class="icon" href="#"
                                                                            data-bs-toggle="dropdown"><i
                                                                                class="bi bi-three-dots"></i></a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li>
                                                                                <button type="button"
                                                                                    class="dropdown-item btn btn-sm mx-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#EditOperateurModal{{ $operateur->id }}">
                                                                                    <i class="bi bi-pencil" title="Modifier"></i>
                                                                                    Modifier
                                                                                </button>
                                                                            </li>
                                                                            {{-- <li>
                                                                                <form
                                                                                    action="{{ route('operateurs.destroy', $operateur->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="dropdown-item show_confirm"
                                                                                        title="Supprimer"><i
                                                                                            class="bi bi-trash"></i>Supprimer</button>
                                                                                </form>
                                                                            </li> --}}
                                                                        </ul>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endisset
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
