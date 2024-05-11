@extends('layout.user-layout')
@section('title', 'Enregistrement decret')
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
                                <span class="d-flex mt-2 align-items-baseline"><a href="{{ route('decrets.index') }}"
                                        class="btn btn-success btn-sm" title="retour"><i
                                            class="bi bi-arrow-counterclockwise"></i></a>&nbsp;
                                    <p> | Liste des decrets</p>
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title">Création decret</h5>
                        <!-- decret -->
                        <form method="post" action="{{ url('decrets') }}" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Decrets<span class="text-danger mx-1">*</span></th>
                                    <th width="15%">Action</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="decrets[0][name]" placeholder="Entrer une decret"
                                            class="form-control form-control-sm" autofocus/></td>
                                    <td><button type="button" name="add" id="add-btn" class="btn btn-success"
                                            title="Ajouter une ligne">Ajouter</button>
                                    </td>
                                </tr>
                            </table>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2">
                                <button type="submit" class="btn btn-outline-success"><i
                                        class="far fa-save"></i>&nbsp;Sauvegarder</button>
                            </div>

                        </form><!-- End decret -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="decrets[' + i +
                '][name]" placeholder="Entrer une autre decret" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Supprimer</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
