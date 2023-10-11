@extends('layout.master')
@section('title')
invoices
    
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
                        <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Empty</span>
                    </div>
                </div>
                
            </div>
            <!-- breadcrumb -->

            <!-- row -->
            <div class="row">

                <div class="col-xl-12">
                    <div class="card mg-b-20">
            
            
                        <div class="card-header pb-0">
            
                            <form action="/Search_invoices" method="POST" role="search" autocomplete="off">
                                {{ csrf_field() }}
            
            
                                <div class="col-lg-3">
                                    <label class="rdiobox">
                                        <input checked name="rdio" type="radio" value="1" id="type_div"> <span>type de recherche
                                            Facture</span></label>
                                </div>
            
            
                                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                    <label class="rdiobox"><input name="rdio" value="2" type="radio"><span>Recherche par numéro de facture
                                        </span></label>
                                </div><br><br>
            
                                <div class="row">
            
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                        <p class="mg-b-10">Sélectionnez le type de facture</p>
                                        <select class="form-control select2" name="type"  required>
                                            <option value="{{ $type ?? 'Sélectionnez le type de facture' }}" selected>
                                                {{ $type ?? 'Sélectionnez le type de facture' }}
                                            </option>
            
                                            <option value="paid"> Factures paid</option>
                                            <option value="Factures impayées">Factures impayées</option>
                                            <option value="Partiellement Payé">Factures Partiellement Payées</option>
                                        </select>
                                    </div><!-- col-4 -->
            
            
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                        <p class="mg-b-10">Recherche par numéro de facture</p>
                                        <input type="text" class="form-control" id="invoice_number" name="invoice_number"  
                                        value="{{$var_invoices ?? ''}}">
            
                                    </div><!-- col-4 -->
            
                                    <div class="col-lg-3" id="start_at">
                                        <label for="exampleFormControlSelect1">À partir de la date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                                name="start_at" placeholder="YYYY-MM-DD" >
                                        </div><!-- input-group -->
                                    </div>
            
                                    <div class="col-lg-3" id="end_at">
                                        <label for="exampleFormControlSelect1">À ce jour</label>
                                           <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                            <input class="form-control fc-datepicker" name="end_at" value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" >
                                        </div><!-- input-group -->
                                    </div>
                                </div><br>
            
                                <div class="row">
                                    <div class="col-sm-1 col-md-1">
                                        <button class="btn btn-primary btn-block">بحث</button>
                                    </div>
                                </div>
                            </form>
            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (isset($details))
                                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                        <thead>
                                            <tr>
                                               <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Numéro de facture</th>
                                                <th class="border-bottom-0">Date frontière</th>
                                                <th class="border-bottom-0">Date d'échéance</th>
                                                <th class="border-bottom-0">Produit</th>
                                                <th class="border-bottom-0">section</th>
                                                <th class="border-bottom-0">Réduction</th>
                                                <th class="border-bottom-0">Taux de taxe</th>
                                                <th class="border-bottom-0">Montant de la taxe</th>
                                                <th class="border-bottom-0">total</th>
                                                <th class="border-bottom-0">Statut</th>
                                                <th class="border-bottom-0">Remarques</th>
            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($details as $invoice)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $invoice->invoice_number }} </td>
                                                    <td>{{ $invoice->invoice_Date }}</td>
                                                    <td>{{ $invoice->Due_date }}</td>
                                                    <td>{{ $invoice->produit }}</td>
                                                    <td>{{ $invoice->sectione->section_nom  }}
                                                    </td>
                                                    <td>{{ $invoice->Discount }}</td>
                                                    <td>{{ $invoice->Rate_VAT }}</td>
                                                    <td>{{ $invoice->Value_VAT }}</td>
                                                    <td>{{ $invoice->Total }}</td>
                                                    <td>
                                                        @if ($invoice->Value_Status == 1)
                                                            <span class="text-success">{{ $invoice->Status }}</span>
                                                        @elseif($invoice->Value_Status == 2)
                                                            <span class="text-danger">{{ $invoice->Status }}</span>
                                                        @else
                                                            <span class="text-warning">{{ $invoice->Status }}</span>
                                                        @endif
            
                                                    </td>
            
                                                    <td>{{ $invoice->note }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
            
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
  <!-- Internal Select2 js-->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!--Internal Fileuploads js-->
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

  <script>
        var date = $('.fc-datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
}).val();
  </script>

<script>
    $(document).ready(function() {
        $('#invoice_number').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });
</script>   
    
@endsection