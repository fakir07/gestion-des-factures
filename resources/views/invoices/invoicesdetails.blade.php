@extends('layout.master')
@section('title')
    invoices deatils

@endsection
@section('css')
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
    <!-- main-content -->
    <div class="main-content app-content">
        <!-- container -->
        <div class="container-fluid">

            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">Invoice</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                            Deatils</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->

            <!-- row -->

            <div class="col-xl-12">
                <!-- div -->
                <div class="card mg-b-20" id="tabs-style3">
                    <div class="card-body">

                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab4" class="nav-link active" data-toggle="tab">Détails de
                                                facturation</a></li>
                                        <li><a href="#tab5" class="nav-link" data-toggle="tab"> Statut de paiement</a>
                                        </li>
                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">Pièces jointes</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab4">
                                        <div class="table-responsive mt-15">

                                            <table class="table table-striped" style="text-align:center">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Invoice number</th>
                                                        <td>{{ $var_invoices->invoice_number }}</td>
                                                        <th scope="row">nvoice Date</th>
                                                        <td>{{ $var_invoices->invoice_Date }}</td>
                                                        <th scope="row">Due date</th>
                                                        <td>{{ $var_invoices->Due_date }}</td>
                                                        <th scope="row">Produit</th>
                                                        <td> {{ $var_invoices->produit }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th> Section</th>
                                                        <td>{{ $var_invoices->sectione->section_nom }}</td>
                                                        <th>Amount collection</th>
                                                        <td>{{ $var_invoices->Amount_collection }}</td>
                                                        <th>Amount_Commission </th>
                                                        <td>{{ $var_invoices->Amount_Commission }}</td>
                                                        <th>Discount </th>
                                                        <td>{{ $var_invoices->Discount }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Value VAT</th>
                                                        <td>{{ $var_invoices->Value_VAT }}</td>
                                                        <th scope="row">Rate_VAT</th>
                                                        <td>{{ $var_invoices->Rate_VAT }}</td>
                                                        <th scope="row">Total</th>
                                                        <td>{{ $var_invoices->Total }}</td>
                                                        <th scope="row">Status</th>
                                                        @if ($var_invoices->Value_Status == 1)
                                                            <td>
                                                                <span
                                                                    class="badge badge-pill badge-success">{{ $var_invoices->Status }}</span>
                                                            </td>
                                                        @elseif($var_invoices->Value_Status ==2)
                                                            <td><span
                                                                    class="badge badge-pill badge-danger">{{ $var_invoices->Status }}</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="badge badge-pill badge-warning">{{ $var_invoices->Status }}</span>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th>description </th>
                                                        <td>{{ $var_invoices->note }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <div class="table-responsive mt-15">
                                            <table class="table table-striped" style="text-align:center">
                                                <thead>
                                                    <tr class="text-darck">
                                                        <th>Invoice numbre</th>
                                                        <th> Produit</th>
                                                        <th>section</th>
                                                        <th>status</th>
                                                        <th>date ajoutée</th>
                                                        <th>description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($var_deatiles as $var_deatile)
                                                        <tr>
                                                            <td>{{ $var_deatile->invoice_numbre }}</td>
                                                            <td>{{ $var_deatile->poduit }}</td>
                                                            <td>{{ $var_invoices->sectione->section_nom }}</td>
                                                            @if ($var_deatile->Value_Status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $var_deatile->Status }}</span>
                                                                    </td>
                                                                @elseif($var_deatile->Value_Status ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $var_deatile->Status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $var_deatile->Status }}</span>
                                                                    </td>
                                                                @endif 
                                                            <td>{{ $var_deatile->created_at }}</td>
                                                            <td>{{ $var_deatile->note}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="table-responsive mt-15">
                                            <table class="table table-striped" >
                                                <thead> 
                                                    <tr class="text-darck">
                                                    <th> name file</th>
                                                    <th>Invoice number </th>
                                                    <th>Créé le</th>
                                                    <th>créé à</th>
                                                    <th>Opérations</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($var_files as $var_file)
                                                    <tr>
                                                        <td>{{$var_file->file_name}}</td>
                                                        {{-- <td><img  style="width: 90px" src="{{asset('/invoices_file'.'/'.$var_file->invoice_number.'/'. $var_file->file_name)}}" alt=""></td> --}}
                                                        <td>{{$var_file->invoice_number}}</td>
                                                        <td>{{$var_file->Created_by}}</td>
                                                        <td>{{$var_file->created_at}}</td>
                                                        
                                                            <td  class="d-flex justify-content-start">
                                                         <a class="btn btn-outline-success btn-sm mx-2"
                                                         href="{{url('view_file')}}/{{$var_invoices->invoice_number}}/{{$var_file->file_name}}"
                                                          role="button"><i class="fas fa-eye"></i></a>

                                                        <a class="btn btn-outline-info btn-sm mx-2" 
                                                        href="{{url('telecharger_file')}}/{{$var_invoices->invoice_number}}/{{$var_file->file_name}}"
                                                        role="button"><i class="fas fa-download"></i></a>

                                                        <a class="btn btn-outline-danger btn-sm mx-2" 
                                                        data-file_name="{{ $var_file->file_name }}"
                                                        data-invoice_number="{{ $var_file->invoice_number }}"
                                                        data-id_file="{{ $var_file->id }}"
                                                        data-target="#delete_file"                                                         
                                                        data-toggle="modal"
                                                        ><i class="las la-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- ajouter file --}}
                                        <div class="card-body">
                                            <p class="text-danger">* Format de pièce jointe pdf, jpeg, .jpg, png </p>
                                            <h5 class="card-title">Ajouter des pièces jointes</h5>
                                            <form method="post" action="{{ url('/invoicesAttachments') }}"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div>
                                                   {{-- <input type="file" class="custom-file-input" id="customFile"
                                                        name="file_name" required>  --}}
                                                    <input class="dropify"  type="file" name="file_name" 
                                                    accept="image/*,.pdf"
                                                    multiple>

                                                    <input type="hidden" id="customFile" name="invoice_number"
                                                    value="{{ $var_invoices->invoice_number }}"
                                                       >
                                                    <input type="hidden" id="invoice_id" name="invoice_id"
                                                    value=" {{$var_invoices->id }}" >
                                                    {{-- <label class="custom-file-label" for="customFile">Ajouter des pièces jointes</label> --}}
                                                </div>
                                                    <br><br>
                                                <button type="submit" class="btn btn-primary btn-sm "
                                                    name="uploadedFile">Confirmer</button>
                                            </form>
                                        </div>
                                                    
                                        </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!--model delete-->
                         <!-- Modal -->
            <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <form  action="{{route('delete_file')}}" method="POST">
                        {{--{{method_field('delete')}}--}}
                            {{-- fach kndiro ddelte bi model  mqkndirouch method delete {{method_field('delete')}} --}}
                            {{csrf_field()}}
                        
                            <div class="modal-body">
                                <div class="modal-body">                        
                                    <input type="hidden" name="file_name" id="file_name" value="">
                                    <input type="hidden" name="invoice_number" id="invoice_number" value="">
                                    <input type="hidden" name="id_file" id="id_file" value="">
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
    </div>
    <!-- /div -->
    <!-- row closed -->
  

@endsection
@section('js')
<script>
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
</script>

<script>   
 $('#delete_file').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_file = button.data('id_file')
      var file_name = button.data('file_name')
      var invoice_number = button.data('invoice_number')
      console.log(file_name);
      var modal = $(this)
      modal.find('.modal-body #id_file').val(id_file);
      modal.find('.modal-body #invoice_number').val(invoice_number);
      modal.find('.modal-body #file_name').val(file_name);
      modal.find('.modal-body .strng_setion').html(file_name);


  });

</script>
@endsection
