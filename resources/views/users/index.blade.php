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
<div class="main-content app-content">
    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto"> Utilisateurs</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                        List</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <a href="{{route('users.create')}}"  class="modal-effect btn btn-outline-primary btn-sm" data-effect="effect-scale"
                        >Ajouter user </a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">Nom d'utilisateur</th>
                                        <th class="wd-20p border-bottom-0">E-mail</th>
                                        <th class="wd-15p border-bottom-0">État de l'utilisateur</th>
                                        <th class="wd-15p border-bottom-0">Type d'utilisateur</th>
                                        <th class="wd-10p border-bottom-0">Opérations</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   @php
                                       $var_i= 1;
                                   @endphp

                                    @foreach ($data as $var_invoice)
                                    <tr>
                                        <td>{{ $var_i++}}</td>    
                                        <td>{{ $var_invoice->name}}</td>    
                                        <td>{{ $var_invoice->email}}</td>    
                                        <td>
                                        @if ($var_invoice->Status == 'active')
                                        <span  class="badge badge-pill badge-success">{{ $var_invoice->Status }}</span>
                                        @elseif($var_invoice->Value_Status ==2)
                                            <span class="badge badge-pill badge-danger">{{ $var_invoice->Status }}</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">{{ $var_invoice->Status }}</span>
                                        @endif 
                                    </td>  
                                        <td>

                                            @if ($var_invoice->roles_name == 'admin')
                                            <span  class=" text-success">{{ $var_invoice->roles_name }}</span>
                                            @elseif($var_invoice->Value_Status ==2)
                                                <span class="badge badge-pill badge-danger">{{ $var_invoice->roles_name }}</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">{{ $var_invoice->roles_name }}</span>
                                            @endif 
                                        
                                        </td>     
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-id="{{ $var_invoice->id }}"
                                            data-toggle="modal"
                                            href="#exampleModal2" title="edit"><i class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $var_invoice->id }}"
                                            data-toggle="modal"
                                            href="#modaldemo9" title="delet"><i class="las la-trash"></i></a>
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
                         <!--model delete-->
                         <!-- Modal -->
                     


                      
            
            
    </div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>

<!--Internal  Datatable js -->
<script src="{{asset('assets/js/table-data.js')}}"></script>

{{-- <script>
    $('#delete_invoice').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_invoice = button.data('id')
      var invoice_number = button.data('invoice_number')
      var modal = $(this)
     
      modal.find('.modal-body #invoice_id').val(id_invoice);
      modal.find('.modal-body .varsup').html(invoice_number);


  });
</script>
 --}}


    
@endsection