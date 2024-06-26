@extends('layout.user-layout')
@section('title', 'Détails module')
@section('space-work')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pt-1">
                            <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('modules.index') }}"
                                    class="btn btn-success btn-sm" title="retour"><i
                                        class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                <p> | Liste des module</p>
                            </span>
                        </div>
                        <h5 class="card-title">Module : {{ $module?->name }}</h5>

                        <table class="table datatables align-middle" id="table-individuelles">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>CIN</th>
                                    <th>Prénom et NOM</th>
                                    <th>Date et lieu de naissance</th>
                                    <th>Localité</th>
                                    <th>Statut</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($module->individuelles as $individuelle)
                                    @isset($individuelle?->numero)
                                        <tr>
                                            <td>{{ $individuelle?->numero }}
                                            </td>
                                            <td>{{ $individuelle->demandeur->user?->cin }}</td>
                                            <td>{{ $individuelle->demandeur->user?->firstname . ' ' . $individuelle->demandeur->user?->name }}
                                            </td>
                                            <td>{{ $individuelle->demandeur->user->date_naissance?->format('d/m/Y') . ' à ' . $individuelle->demandeur->user->lieu_naissance }}
                                            </td>
                                            <td><a
                                                    href="{{ url('modulelocalite', ['$idlocalite' => $individuelle->departement->id, '$idmodule' => $module?->id]) }}">{{ $individuelle->departement->nom }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('modulestatut', ['$statut' => $individuelle->statut, '$idmodule' => $module?->id]) }}">
                                                    @isset($individuelle?->statut)
                                                        @if ($individuelle?->statut == 'Attente')
                                                            {{ $individuelle?->statut }}
                                                        @endif
                                                        @if ($individuelle?->statut == 'Validée')
                                                            {{ $individuelle?->statut }}
                                                        @endif
                                                        @if ($individuelle?->statut == 'Rejetée')
                                                            {{ $individuelle?->statut }}
                                                        @endif
                                                    @endisset
                                                </a>
                                            </td>
                                            <td>
                                                <span class="d-flex align-items-baseline"><a
                                                        href="{{ route('individuelles.show', $individuelle->id) }}"
                                                        class="btn btn-primary btn-sm" title="voir détails"><i
                                                            class="bi bi-eye"></i></a>
                                                    <div class="filter">
                                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                class="bi bi-three-dots"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                            <li><a class="dropdown-item btn btn-sm"
                                                                    href="{{ route('individuelles.edit', $individuelle->id) }}"
                                                                    class="mx-1" title="Modifier"><i
                                                                        class="bi bi-pencil"></i>Modifier</a>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('individuelles.destroy', $individuelle->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item show_confirm"
                                                                        title="Supprimer"><i
                                                                            class="bi bi-trash"></i>Supprimer</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endisset
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
