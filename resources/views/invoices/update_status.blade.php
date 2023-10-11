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
                        <h4 class="content-title mb-0 my-auto">Ajouter</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                            invoice</span>
                    </div>
                </div>

            </div>
            <!-- breadcrumb -->
         
            <!-- row -->
            <div class="row">

                <div class="col-lg col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{URL::route('status_update',['id'=>$var_invoices->id])}}"  method="POST" enctype="multipart/form-data" autocomplete="off">
                                {{method_field('post')}}
                                {{csrf_field()}}
                                <!--Row 1-->
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Numéro de facture</label>
                                        <input type="text" class="form-control" id="inputName" name="invoice_number"  value="{{$var_invoices->invoice_number}}" readonly>
                                        <input type="hidden"  name="invoices_id" value="{{$var_invoices->id}}" >

                                    </div>
                                    <div class="col">
                                        <label  class="main-content-label tx-11 tx-medium tx-gray-600">Date de la facture</label>
                                        <input class="form-control fc-datepicker" id="invoice_Date" name="invoice_Date"  value="{{$var_invoices->invoice_Date}}"  readonly>
                                    </div>
                                    <div class="col">
                                        <label  class="main-content-label tx-11 tx-medium tx-gray-600">Date d'échéance</label> 
                                       <input class="form-control fc-datepicker" id="Due_date" name="Due_date"  value="{{$var_invoices->Due_date}}" readonly>
                                    </div>
                                </div>
                                <!-- end Row 1 -->
                                 <br>
                                <!-- Row 2 -->
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">Section</label>
                                        <select class="form-control" name="section" id="exampleFormControlSelect1" readonly>
                                            <option   value="{{$var_invoices->invoice_number}}"> {{$var_invoices->sectione->section_nom}}</option>    
                                          </select>
                                    </div>
                                    <div class="col">
                                        <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600"">Produit</label>
                                        <select class="form-control" id="produit" name="produit" id="exampleFormControlSelect1" readonly>
                                          <option  value="{{$var_invoices->invoice_number}}"> {{$var_invoices->produit}}</option>
                                          </select>
                                    </div>
                                    <div class="col">
                                        <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Montant de la collecte</label>
                                        
                                        <input type="text" class="form-control" id="Amount_collection" name="Amount_collection" readonly  value="{{$var_invoices->Amount_collection}}" required>
                                    </div>
                                   
                                </div>

                                <!-- END ROW 2-->
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">Montant de la commission</label>
                                        <input type="text" class="form-control" id="Amount_Commission" name="Amount_Commission"   value="{{$var_invoices->Amount_Commission}}"readonly  >
                                    </div>
                           
                                    <div class="col">
                                        <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">Remise</label>
                                         <input type="number" class="form-control" id="Discount"   name="Discount"   value="{{$var_invoices->Discount}}" readonly >
                                    </div>
                                    <div class="col">
                                        <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">taux de TVA</label>
                                        <select  class="form-control " name="Value_VAT"  id="Value_VAT"  readonly  >
                                             <option  value="{{$var_invoices->Value_VAT}}" readonly> {{$var_invoices->Value_VAT}}</option>                                              
                                        </select>
                                    </div>
                                       
                                </div>
                                <!-- END ROW 3-->
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Valeur TVA</label>
                                        <input type="text" class="form-control" id="Rate_VAT" name="Rate_VAT"  value="{{$var_invoices->Rate_VAT}}" readonly>
                                  </div>
                                  <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Total TTC</label>
                                    <input type="text" class="form-control" id="Total" name="Total"   value="{{$var_invoices->Total}}"readonly>
                                </div>
                             </div>
                             <!--END ROW 4 -->
                             <br>
                             <div class="row">
                                 <div class="col">
                                    <label for="exampleTextarea "  class="main-content-label tx-11 tx-medium tx-gray-600">Remarques</label>
                                    <textarea class="form-control" name="note" id="" cols="30" rows="3" readonly> {{$var_invoices->note}}
                                    </textarea> 
                                </div>
                                <br>                
                            </div>
                            <br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Statut du paiement</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option selected="true" disabled="disabled">--sélectionnez l'état du paiement--</option>
                                    <option value="paid">payé</option>
                                    <option value="Partiellement Payé">Partiellement Payé</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Date de paiement</label>
                                    <input class="form-control fc-datepicker" id="Payment_Date" name="Payment_Date" placeholder="dd-mm-yy" required>
                            </div>
                        </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Mettre à jour le statut du paiement</button>                            </div>
                        </form>
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


    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-y'
        }).val();
    </script>

     

    @endsection
