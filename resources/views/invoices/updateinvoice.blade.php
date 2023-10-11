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
                    <h4 class="content-title mb-0 my-auto">upadte</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
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
                        {{-- <form action="{{url('invoices/update/{{$var_invoices->id}}}')}}"  method="POST" enctype="multipart/form-data" autocomplete="off"> --}}
                        <form action="{{url('invoices/update')}}"  method="POST" enctype="multipart/form-data" autocomplete="off">
                           {{method_field('patch')}}
                           {{csrf_field()}}
                            <!--Row 1-->
                            <div class="row">
                                <div class="col">
                                    <label for="inputName"   class="main-content-label tx-11 tx-medium tx-gray-600">Numéro de facture</label>
                                     <input type="hidden" value="{{$var_invoices->id}}"  name="invoice_id" id="">
                                    <input type="text" class="form-control" id="inputName" name="invoice_number"  value="{{$var_invoices->invoice_number}}" required>
                                </div>
                                <div class="col">
                                    <label  class="main-content-label tx-11 tx-medium tx-gray-600">Date de la facture</label>
                                    <input class="form-control fc-datepicker" id="invoice_Date" value="{{$var_invoices->invoice_Date}}" name="invoice_Date" placeholder="dd-mm-yy"  value="{{ date('d-m-y') }}" required>
                                </div>
                                <div class="col">
                                    <label  class="main-content-label tx-11 tx-medium tx-gray-600">Date d'échéance</label> 
                                   <input class="form-control fc-datepicker" id="Due_date"  value="{{$var_invoices->Due_date}}"name="Due_date" placeholder="dd-mm-yy"  required>
                                </div>
                            </div>
                            <!-- end Row 1 -->
                             <br>
                            <!-- Row 2 -->
                            <div class="row">
                                <div class="col">
                                    <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">Section</label>
                                    <select class="form-control" name="section" id="exampleFormControlSelect1">
                                        {{-- <option value="{{$var_invoices->sectione->id}}">{{$var_invoices->sectione->section_nom}}</option>     --}}
                                        <option value="" sélectionné désactivé>Sélectionnez le Section</option>    
                                        
                                        @foreach ($var_sectiones as $var_sectione)
                                        <option value="{{$var_sectione->id}}" 
                                            {{ ( $var_sectione->id == $var_invoices->section) ? 'selected' : '' }}
                                            > {{$var_sectione->section_nom}}</option>
                                        @endforeach
                                  
                                      </select>
                                </div>
                                <div class="col">
                                    <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600"">Produit</label>
                                    <select class="form-control" id="produit" name="produit" id="exampleFormControlSelect1">
                                        <option value="{{$var_invoices->produit}}">{{$var_invoices->produit}}</option>
                                      </select>
                                </div>
                                <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Montant de la collecte</label>
                                    
                                    <input type="text" class="form-control"   id="Amount_collection" name="Amount_collection"  value="{{$var_invoices->Amount_collection}}" required>
                                </div>
                               
                            </div>

                            <!-- END ROW 2-->
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">Montant de la commission</label>
                                    <input type="text" class="form-control" id="Amount_Commission"  name="Amount_Commission"  value="{{$var_invoices->Amount_Commission}}" required>
                                </div>
                       
                                <div class="col">
                                    <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">Remise</label>
                                     <input type="text" class="form-control" id="Discount" value="{{$var_invoices->Discount}}"  name="Discount"  required >
                                </div>
                                <div class="col">
                                    <label for="inputName"  class="main-content-label tx-11 tx-medium tx-gray-600">taux de TVA</label>
                                    <select  class="form-control SlectBox" name="Value_VAT"  
                                    {{-- value=" {{$var_invoices->Value_VAT}}" --}}
                                    id="Value_VAT" onchange="myFunction()">
                                        {{-- <option  sélectionné désactivé>Sélectionnez le taux de taxe</option>     --}}
                                        <option {{$var_invoices->Value_VAT == '5' ? 'selected' : ''}} value="5">5%</option>
                                        <option {{$var_invoices->Value_VAT == '10' ? 'selected' : ''}} value="10">10%</option>
                                    </select>
                                </div>
                                   
                            </div>
                            <!-- END ROW 3-->
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Valeur TVA</label>
                                    <input type="text" class="form-control" id="Rate_VAT" value="{{$var_invoices->Rate_VAT}}"  name="Rate_VAT" readonly>
                              </div>
                              <div class="col">
                                <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Total TTC</label>
                                <input type="text" class="form-control" id="Total"value="{{$var_invoices->Total}}"   name="Total" readonly>
                            </div>
                         </div>
                         <!--END ROW 4 -->
                         <br>
                         <div class="row">
                             <div class="col">
                                <label for="exampleTextarea "  class="main-content-label tx-11 tx-medium tx-gray-600">Remarques</label>
                                <textarea class="form-control" name="note" id="" cols="30"    rows="3">{{$var_invoices->note}}</textarea> 
                            </div>
                            <br>                
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Enregistrer les données</button>                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
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

    <script>
        $(document).ready(function() {
            $('select[name="section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="produit"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="produit"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>



    {{-- <script type="text/javascript">

        $( "#type" ).change(function() {
            var _type = $(this).val();
          $.ajax({
              url: '{{ url("liste-filieres-par-type") }}'+'/'+_type,
             // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
          })
          .done(function(data) {
            var old_filiere = "{{ old('type') }}"; 
            var _html =" <option disabled selected>Selectionnez</option>";
            for(var i = 0 ; i < data.length ; i ++)
            {
                if(old_filiere && old_filiere == data[i].id)
                    _html+= '<option selected value="'+data[i].id +'">'+data[i].nom+'</option>'
                else
                    _html+= '<option value="'+data[i].id +'">'+data[i].nom+'</option>'
            }
            $('#filiere_id').removeAttr('disabled').html(_html);
              console.log("success");
          })
          .fail(function() {
              console.log("error");
          })
          .always(function() {
              console.log("complete");
          });
          
        });
        $(document).ready(function() {
            $("#type").trigger('change');
        });
    
     
     
    
    .modus-product-more .item-grid.grid-type-4 .product .price span.woocommerce-Price-currencySymbol {
    font-size: 12px !important;
    top: 0;
    position: absolute;
    left: -28
px
;
    padding-top: 4
px
;
}
    </script> --}}

    <script>

        function myFunction(){

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);


            var Amount_Commission2 = Amount_Commission-Discount;
             
           
             if(typeof Amount_Commission ==='undefined' || !Amount_Commission){
               
                alert('err');
             }
             else{
                 var resulte1 = Amount_Commission2 * Value_VAT/100 ;
                 var resulte2  = parseFloat(resulte1 + Amount_Commission2);

                    

                  document.getElementById('Rate_VAT').value = parseFloat(resulte1).toFixed(2);
                  document.getElementById('Total').value = parseFloat(resulte2).toFixed(2);

             }
        }
    </script>
    
    @endsection