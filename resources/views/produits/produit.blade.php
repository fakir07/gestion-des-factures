@extends('layout.master')
@section('title')
invoices

@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- main-content -->
<div class="main-content app-content">



    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                        Empty</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
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


        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <a class="modal-effect btn btn-outline-primary btn-lg" data-effect="effect-scale"
                                data-toggle="modal" href="#modaldemo1">Ajouter Produit </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Nom Produit</th>
                                        <th class="wd-15p border-bottom-0">Nom Sections</th>
                                        <th class="wd-20p border-bottom-0"> Description</th>
                                        <th class="wd-20p border-bottom-0"> Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($var_produits as $var_produit)

                                    <tr>
                                        <td>{!! $var_produit->nom_produit ? $var_produit->nom_produit : '<small>Aucun
                                                nom du Produit !!</small>' !!} </td>
                                        <td>{!! $var_produit->section ? $var_produit->section->section_nom :
                                            '<small>Aucun nom du section !!</small>' !!}</td>
                                        <td>{!! $var_produit->description_produit ? $var_produit->description_produit :
                                            '<small>Aucun nom du description !!</small>' !!}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $var_produit->id }}"
                                                data-produit_nom="{{ $var_produit->nom_produit }}"
                                                data-section="{{ $var_produit->section_id }}"
                                                data-description="{{ $var_produit->description_produit }}"
                                                data-toggle="modal" href="#exampleModal2" title="edit">
                                                <i class="las la-pen"></i>
                                            </a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $var_produit->id }}"
                                                data-produit_nom="{{ $var_produit->nom_produit }}" data-toggle="modal"
                                                href="#modaldemo9" title="delet">
                                                <i class="las la-trash"></i>
                                            </a>

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
        <!-- row closed -->
        <!-- ajouters -->
        <div class="modal" id="modaldemo1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ajouter produit </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <form action="{{ route('produits.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nome Produit</label>
                                <input class="form-control" name="nom_produit" id="nom_produit"
                                    placeholder="Section Nom" type="text">
                            </div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nom Section </label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled> sectines</option>
                                    @foreach ($var_sectiones as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Description</label>
                                <input class="form-control" name="description_produit" id="description_produit"
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

        <!-- Button trigger modal -->
       
        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="produits/update" method="post" autocomplete="off">
                            {{method_field('patch')}}
                            {{csrf_field()}}
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nome Produit</label>
                                <input class="form-control" name="nom_produit" id="nom_produit" placeholder="Section Nom"
                                    type="text">
                            </div>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="" selected disabled> Choisir le section</option>
                                @foreach ($var_sectiones as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_nom }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Description</label>
                                <input class="form-control" name="description_produit" id="description_produit"
                                    placeholder="Description" type="text">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- fin ajouter->


            <!--delete-->
            <!-- Button trigger modal -->
           
            
            <!-- Modal -->
            <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <form action="produits/destroy" method="POST">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                        
                            <div class="modal-body">
                                <div class="modal-body">                        
                                    <input type="hidden" name="id" id="id" value="">
                                    <p>Êtes-vous sûr du processus de suppression ? <strong class="strng_setion"></strong></p>                          <!--  <input class="form-control" name="section_name" id="section_name" type="text" readonly>-->
                                </div>                        
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        

    </div>
    
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

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
            var nom_produit = button.data('produit_nom')
            var sec_id = button.data('section')
            var description_produit = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nom_produit').val(nom_produit);
            modal.find('.modal-body #section_id').val(sec_id);
            modal.find('.modal-body #description_produit').val(description_produit);
        });

    </script>


<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var nom_produit = button.data('produit_nom')
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body .strng_setion').html(nom_produit);
  });

</script>
    @endsection