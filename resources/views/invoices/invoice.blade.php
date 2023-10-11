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
<!--- Internal Select2 css-->
<link href="{{asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('content')
<div class="main-content app-content">
    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Invoice</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
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
                        {{-- <div class="d-flex justify-content-between"> --}}

                            <a href="invoices/create"  class="modal-effect btn btn-outline-primary btn-sm m-2" data-effect="effect-scale"
                            > <i class="fas fa-plus "></i> Ajouter invoices </a>
                            <a   href="{{url('Export_invoice')}}"  class="modal-effect btn btn-outline-primary btn-sm m-2" data-effect="effect-scale"
                            > <i class="fas fa-download"></i> export invoices </a>
 
                            <a 
                             class="modal-effect btn btn-outline-primary btn-sm m-2"
                             data-effect="effect-scale"
                             data-toggle="modal"
                             href="#import_invoice" title="delet"
                            > <i class="fas fa-upload"></i> import files  </a>
                          
                                    
                        {{-- </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Numéro facture</th>
                                        <th class="wd-15p border-bottom-0">Date facture</th>
                                        <th class="wd-20p border-bottom-0"> Date d'échéance</th>
                                        <th class="wd-10p border-bottom-0">Section</th>
                                        <th class="wd-10p border-bottom-0"> status</th>
                                        <th class="wd-25p border-bottom-0">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($var_invoices as $var_invoice)
                                    <tr>
                                        <td>{!! $var_invoice->invoice_number ? $var_invoice->invoice_number : ' <small>Aucun nom du section !!</small>' !!}</td>  
                                        <td>{!! $var_invoice->invoice_Date ? $var_invoice->invoice_Date : ' <small>Aucun nom du section !!</small>' !!}</td>  
                                        <td>{!! $var_invoice->Due_date ? $var_invoice->Due_date : ' <small>Aucun nom du section !!</small>' !!}</td>  
                                        <td>{!! $var_invoice->sectione ? $var_invoice->sectione->section_nom : ' <small>Aucun nom du section !!</small>' !!}</td>  
                                       <td>
                                        @if ($var_invoice->Value_Status == 1)
                                        <span  class="badge badge-pill badge-success">{{ $var_invoice->Status }}</span>
                                        @elseif($var_invoice->Value_Status ==2)
                                            <span class="badge badge-pill badge-danger">{{ $var_invoice->Status }}</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">{{ $var_invoice->Status }}</span>
                                        @endif 
                                       </td>
                                       

                                       <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                type="button">Opérations<i class="fas fa-caret-down ml-1"></i></button>                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                   href="{{url('edit_invoice')}}/{{$var_invoice->id}}"> <i class="fas fa-pen"></i>
                                                   &nbsp;&nbsp;Modifier
                                                     facture</a>

                                                <a class=" dropdown-item" title="choix details"
                                                     href="{{url('invoicedetails')}}/{{$var_invoice->id}}" title="voir"><i
                                                     class="las la-eye"></i>&nbsp;&nbsp; Voir details
                                                </a>

                                                <a class="dropdown-item"  data-effect="effect-scale"
                                                    data-id="{{$var_invoice->id}}"
                                                    data-invoice_number="{{$var_invoice->invoice_number}}" data-toggle="modal"
                                                    href="#delete_invoice" title="delet"><i
                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;Supprimer
                                                    facture</a>

                                                <a class="dropdown-item"
                                                    title="choix details"
                                                   href="{{URL::route('show_upadte_status',[$var_invoice->id])}}" title="voir"><i
                                                        class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;modifier
                                                        Statut du paiement</a>
                                                 
                                                 <a class="dropdown-item"  data-effect="effect-scale"
                                                    data-id="{{$var_invoice->id}}"
                                                    data-invoice_number="{{$var_invoice->invoice_number}}" data-toggle="modal"
                                                    href="#archive_invoice" title="delet"><i
                                                    class="text-danger fas fa-archive"></i>&nbsp;&nbsp; archive 
                                                    facture</a>  
                                                    
                                                    <a class="dropdown-item"  
                                                    href="{{URL('Print_invoice')}}/{{$var_invoice->id}}" title=""><i
                                                    class="text-success fas fa-print"></i>&nbsp;&nbsp;Print 
                                                    facture</a>  

                                               

                                            </div>
                                        </div>
                                       </td>
                                        {{-- <td>
                                            <a class="btn btn-sm btn-warning " title="upadte invoice"
                                                href="{{url('edit_invoice')}}/{{$var_invoice->id}}" title="upadte">
                                                <i class="fas fa-pen"></i>
                                            </a> 

                                            <a class="btn btn-sm btn-info mx-2 " title="choix details"
                                                href="{{url('invoicedetails')}}/{{$var_invoice->id}}" title="voir"><i
                                                class="las la-eye"></i>
                                            </a>
                                
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{$var_invoice->id}}"
                                                    data-invoice_number="{{$var_invoice->invoice_number}}" data-toggle="modal"
                                                    href="#delete_invoice" title="delet">
                                                    <i class="las la-trash"></i>
                                            </a>  

                                             <a class="btn btn-sm btn-secondary mx-2 " title="choix details"
                                                href="{{URL::route('show_upadte_status',[$var_invoice->id])}}" title="voir"><i
                                                 
                                                class="las la-eye"></i>
                                            </a> 
                                        </td> --}}
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
                         <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">supprime  invoice</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form  action="{{route('invoices.destroy','test')}}" method="POST">
                                    {{method_field('delete')}} 
                                        {{csrf_field()}}
                                    {{-- fach kndiro ddelte bi model  mqkndirouch method delete {{method_field('delete')}} --}}

                                        <div class="modal-body">
                                            <div class="modal-body">                        
                                                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                                                <p>Êtes-vous sûr du processus de suppression invoices ? <strong class="varsup"></strong></p>                          <!--  <input class="form-control" name="section_name" id="section_name" type="text" readonly>-->
                                            </div>                        
                                        </div>
            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                            <button type="submit" class="btn btn-primary">confermer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                         <!--------------------------------------------------model archive-------------------------------------- -->
                         <!-- Modal -->
                         <div class="modal fade" id="archive_invoice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Archive  invoice</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form  action="{{route('invoices.destroy','test')}}" method="POST">
                                    {{method_field('delete')}} 
                                        {{csrf_field()}}
                                    {{-- fach kndiro ddelte bi model  mqkndirouch method delete {{method_field('delete')}} --}}

                                        <div class="modal-body">
                                            <div class="modal-body">                        
                                                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                                                <input type="hidden" name="id_page" id="id_page" value="2">
                                                <p>Êtes-vous sûr du processus de Archive invoices ? <strong class="varsup"></strong></p>                          <!--  <input class="form-control" name="section_name" id="section_name" type="text" readonly>-->
                                            </div>                        
                                        </div>
            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                            <button type="submit" class="btn btn-primary">confermer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                         <!--------------------------------------------------model import files -------------------------------------- -->
                         <!-- Modal -->
                         <div class="modal fade" id="import_invoice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">import files </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form  action="{{URL::route('import_files')}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    {{-- fach kndiro ddelte bi model  mqkndirouch method delete {{method_field('delete')}} --}}

                                        <div class="modal-body">
                                            <div class="modal-body">                        
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="file" name='files' class="dropify" data-height="80"  
                                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"                                                    />
                                                </div>
                                                <br>
                                                <p>Êtes-vous sûr du processus de Archive invoices ? <strong class="varsup"></strong></p>                          <!--  <input class="form-control" name="section_name" id="section_name" type="text" readonly>-->
                                            </div>                        
                                        </div>
            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                            <button type="submit" class="btn btn-primary">confermer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            
            
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



<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<!--Internal  Datatable js -->
<script src="{{asset('assets/js/table-data.js')}}"></script>

<script>
    $('#delete_invoice').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_invoice = button.data('id')
      var invoice_number = button.data('invoice_number')
      var modal = $(this)
     
      modal.find('.modal-body #invoice_id').val(id_invoice);
      modal.find('.modal-body .varsup').html(invoice_number);


  });
</script>


<script>
    $('#archive_invoice').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_invoice = button.data('id')
      var invoice_number = button.data('invoice_number')
      var modal = $(this)
     
      modal.find('.modal-body #invoice_id').val(id_invoice);
      modal.find('.modal-body .varsup').html(invoice_number);


  });
</script>

    
@endsection