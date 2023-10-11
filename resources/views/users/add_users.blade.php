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
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
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
                        Users</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row -->
        <div class="row">
            
            <div class="col-lg col-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                            action="{{route('users.store','test')}}" method="post">
                            {{csrf_field()}}
                            <div  class="row">
                                <div class="col">
                                        <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Nom d'utilisateur:</label>
                                        <input type="text" class="form-control" id="inputName" name="name"  required>
                                </div>
                                <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Email</label>
                                    <input type="text" class="form-control" id="inputName" name="email"  required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Password</label>
                                    <input type="password" class="form-control" id="inputName" name="password"  required>
                           
                                </div>
                                <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600"> Confirmer Password </label>
                                    <input type="password" class="form-control" id="inputName" name="password"  required>
                           
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="main-content-label tx-11 tx-medium tx-gray-600">Numéro de facture</label>
                                    <select class="form-control" id="Status" name="Status" id="exampleFormControlSelect1">
                                        <option value="activé">activé</option>
                                        <option value="Désactivé">Désactivé</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <p class="mg-b-10">Multiple Select with Pre-Filled Input</p>
                                    {{-- <select class="form-control select2" multiple="multiple"> --}}
                                        {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                
                                </div>
                            </div>
                            <br>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button class="btn btn-main-primary pd-x-20" type="submit">Confirmer</button>
                            </div>
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
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

@endsection