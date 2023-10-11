@extends('layout.master')
@section('title')

Produits
@stop
@section('css')
@section('css')
<!-- Internal Data table css -->
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@stop

@section('content')
<div class="main-content app-content">
    <!-- container -->

    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Produits</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                        List</span>
                </div>
            </div>

        </div>
        <!-- breadcrumb -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
            <span class="alert-inner--text"><strong>{{ session()->get('Add') }}!</strong> </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        @if (session()->has('EDIT'))

        <div class="alert alert-info" role="alert">
            <span class="alert-inner--icon"><i class="ti-bell"></i></span>
            <span class="alert-inner--text"><strong>{{ session()->get('EDIT') }}!</strong> </span>
        </div>
        @endif
        @if (session()->has('supprimer'))

        <div class="alert alert-primary" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-check-square"></i></span>
            <span class="alert-inner--text"><strong>{{ session()->get('supprimer') }}</strong></span>
        </div>
        @endif

        @if (session()->has('ERROR'))

        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
            <span class="alert-inner--text"><strong>{{ session()->get('ERROR') }}</strong> </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif


        <div class="row row-sm">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <a class="modal-effect btn btn-outline-primary btn-lg" data-effect="effect-scale"
                                data-toggle="modal" href="#modaldemo8">Ajouter Sectione </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Section Nom</th>
                                        <th class="wd-15p border-bottom-0">Description</th>
                                        <th class="wd-15p border-bottom-0">créé le</th>
                                        <th class="wd-15p border-bottom-0">Action</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($var_sectiones as $var_sectione)
                                    <tr>
                                        {{-- <td>{{$var_sectione->section_nom ?? ""}}</td> --}}
                                        <td>{!! $var_sectione->section_nom ? $var_sectione->section_nom : '<small>Aucun
                                                nom du section !!</small>' !!}</td>
                                        <td>{!! $var_sectione->description ? $var_sectione->description : '<small>Aucun
                                                description !!</small>' !!}</td>
                                        <td>{!! $var_sectione->créé_par ? $var_sectione->créé_par : '<small
                                                class="text-danger">Aucun utilisateur créé cette section !!</small>' !!}
                                        </td>
                                        {{-- <td>{{$var_sectione->description ?? ""}}</td>
                                        <td>{{$var_sectione->créé_par ?? ""}}</td> --}}
                                        <td>

                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $var_sectione->id }}"
                                                data-section_nom="{{ $var_sectione->section_nom }}"
                                                data-description="{{ $var_sectione->description }}" data-toggle="modal"
                                                href="#exampleModal2" title="edit"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $var_sectione->id }}"
                                                data-section_nom="{{ $var_sectione->section_nom }}" data-toggle="modal"
                                                href="#modaldemo9" title="delet"><i class="las la-trash"></i></a>

                                            {{-- SHOW --}}
                                            <a class="btn btn-sm btn-danger"
                                                href="{{ route('sectiones.show', $var_sectione->id)}}" title="delet"><i
                                                    class="las la-eye"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ajouters -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ajouter Sectione </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <form action="{{ route('sectiones.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control" name="section_nom" id="section_nom"
                                    placeholder="Section Nom" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="description" id="description"
                                    placeholder="Description" type="text">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary btn-sm" type="submit">Confirmer</button>
                            <button class="btn ripple btn-secondary btn-sm" data-dismiss="modal"
                                type="button">fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- fin ajouter->
             <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Sectione </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form  action="sectiones/update" method="post" autocomplete="off">
                            {{method_field('patch')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label">Section Nom</label>
                                <input class="form-control" name="section_nom" id="section_nom" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">supprimer la section</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="sectiones/destroy" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <div class="modal-body">                        
                                <input type="hidden" name="id" id="id" value="">
                                <p>Êtes-vous sûr du processus de suppression ? <strong class="strng_setion"> </strong></p>                          <!--  <input class="form-control" name="section_name" id="section_name" type="text" readonly>-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                            <button type="submit" class="btn btn-danger">Confirmer</button>
                        </div>
                </div>
                </form>
            </div>
        </div>



        <!-- row closed -->
    </div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>

<!--Internal  Datatable js -->
<script src="{{ asset('assets/js/table-data.js') }}"></script>
<script src="{{ asset('assets/js/modal.js') }}"></script>

<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_nom = button.data('section_nom')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_nom').val(section_nom);
            modal.find('.modal-body #description').val(description);
        });

</script>


<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_nom = button.data('section_nom')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body .strng_setion').html(section_nom);
    })
</script>



@endsection