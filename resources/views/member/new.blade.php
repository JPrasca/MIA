<!-- BEGIN: VENDOR SUB CSS-->

<link rel="stylesheet" type="text/css" href="../app-assets/css/pages/form-wizard.css">
<link rel="stylesheet" type="text/css" href="../app-assets/vendors/materialize-stepper/materialize-stepper.min.css">
<link rel="stylesheet" type="text/css" href="../app-assets/vendors/data-tables/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../app-assets/vendors/data-tables/css/jquery.dataTables.css">
<!-- END: VENDOR SUB CSS-->
@extends('layouts.master_sub')
@section('content')
<script type="text/javascript">

    document.getElementById('home-a').classList.remove('active');
    document.getElementById('members-li').classList.add('active');
    document.getElementById('members-li').classList.add('open');
    document.getElementById('members-div').style.display = 'block';
    document.getElementById('members-list-li2').classList.add('active');
    document.getElementById('members-list-a2').classList.add('active');
 
</script>
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Registro de nuevas personas</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('member') }}">Miembros</a>
                                </li>
                                <li class="breadcrumb-item active">Nuevo
                                </li>
                            </ol>
                        </div>
                        @section('log-dropdown')
                        @parent   
                        @endsection
                    </div>
                </div>
            </div>
                 
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section section-form-wizard">

                    <!-- Horizontal Stepper -->

                    <div class="row">
                        <div class="col s12">
                            <div class="card animate fadeUp">
                                <div class="card-content pb-0">
                                    <div class="card-header mb-2">
                                        <h4 class="card-title">Datos de la persona</h4>
                                    </div>

                                    <form method="POST" action="{{ config('constants.url_base') }}api/member/insert"><ul class="stepper horizontal" id="horizStepper">
                                        <li class="step active">
                                            <div class="step-title waves-effect">Datos personales</div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">perm_identity</i>
                                                        <label for="idNumber" class="active">Identificación: <span class="red-text">*</span></label>
                                                        <input type="number" class="validate valid" name="idNumber" id="idNumber" required="" data-length="15">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">view_agenda</i>
                                                        <label for="firstName" class="active">Nombres: <span class="red-text">*</span></label>
                                                        <input type="text" id="firstName" name="firstName" class="validate valid" required="" data-length="80">
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">view_agenda</i>
                                                        <label for="lastName" class="active">Apellidos: <span class="red-text">*</span></label>
                                                        <input type="text" id="lastName" class="validate valid" name="lastName" required="" data-length="80">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <div class="select-wrapper">
                                                            <i class="material-icons prefix">face</i>
                                                            <select id="genre" name="genre" required="" class="validate valid">
                                                                <option value="" disabled selected>Escoja el género</option>
                                                                <option value="M">Masculino</option>
                                                                <option value="F">Femenino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col m6 s12">                                                        
                                                        <i class="material-icons prefix">date_range</i>
                                                        <label for="birthDate" class="active">Fecha de nacimiento: <span class="red-text">*</span></label>
                                                        <input id="birthDate" name="birthDate" type="text" class="datepicker validate valid" required="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="step-actions">
                                                        <div class="row">
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="red btn btn-reset waves-effect waves-light" type="reset">
                                                                    <i class="material-icons left">clear</i>Limpiar
                                                                </button>
                                                            </div>
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="btn btn-light previous-step waves-effect waves-light" disabled="">
                                                                    <i class="material-icons left">arrow_back</i>
                                                                    Atrás
                                                                </button>
                                                            </div>
                                                            <div class="col m4 s12 mb-3">
                                                                <button id="btnNext1" class="waves-effect waves dark btn btn-primary next-step waves-effect waves-light" type="submit">
                                                                    Siguiente
                                                                    <i class="material-icons right">arrow_forward</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-title waves-effect">Datos de contacto</div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">room</i>
                                                        <label for="adress">Dirección: <span class="red-text"></span></label>
                                                        <input type="text" class="validate" id="adress" name="adress" maxlength="100">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">email</i>
                                                        <label for="email" class="active">Email: <span class="red-text">*</span></label>
                                                        <input type="email" class="validate valid" name="email" id="email" required="" data-length="80">
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">phone</i>
                                                        <label for="contactNum" class="active">Teléfono: <span class="red-text">*</span></label>
                                                        <input type="number" class="validate valid" name="contactNum" id="contactNum" required="" data-length="12">
                                                    </div>
                                                </div>
                                                <div class="step-actions">
                                                    <div class="row">
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="red btn btn-reset" type="reset">
                                                                <i class="material-icons left">clear</i>Limpiar
                                                            </button>
                                                        </div>
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="btn btn-light previous-step waves-effect waves-light">
                                                                <i class="material-icons left">arrow_back</i>
                                                                Atrás
                                                            </button>
                                                        </div>
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="waves-effect waves dark btn btn-primary next-step waves-effect waves-light" type="submit">
                                                                Siguiente
                                                                <i class="material-icons right">arrow_forward</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-title waves-effect">Otro</div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <div>
                                                            <i class="material-icons prefix">recent_actors</i>
                                                            <select id="occupation" name="occupation" required="" class="validate valid">
                                                                <option value="" disabled selected>Escoja una ocupación</option>
                                                               
                                                                <!-- llenado del combo de tipos de ocupación con la lista
                                                                retornada del controlador-->
                                                                @foreach ($vOccupationlist as $occupationitem)                                                                
                                                                    <option value="{{ $occupationitem->Id }}" >{{ $occupationitem->name }}</option>
                                                                @endforeach
                                                            </select>                                                           
                                                            {{-- <label for="occupation">Ocupación</label> --}}
                                                        </div>    
                                                    </div> 
                                                    <div class="input-field col m6 s12">      
                                                        <label class="active">Ministerio:</label>                                 
                                                        <div class="section section-data-tables">
                                                        <!-- Page Length Options -->
                                                            <div class="row">
                                                                <div class="col s12">
                                                                    <table id="page-length-option" class="display responsive"  style="width: 60%; height: 30%">
                                                                    </table>
                                                                </div>
                                                            </div>                                            
                                                        </div>                                                       
                                                    </div>                                                                             
                                                </div>
                                                <div class="step-actions">
                                                    <div class="row">
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="red btn mr-1 btn-reset waves-effect waves-light" type="reset">
                                                                <i class="material-icons">clear</i>
                                                                Limpiar
                                                            </button>                                                            
                                                        </div>
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="btn btn-light previous-step waves-effect waves-light">
                                                                <i class="material-icons left">arrow_back</i>
                                                                Atrás
                                                            </button>
                                                        </div>
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="waves-effect btn btn-primary waves-light" type="button" onclick="SaveMemberConfirm()">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top active">
        <a class="btn-floating btn-large waves-effect waves-light" href="{{ url('member') }}"><i class="material-icons">list</i></a>
    </div>
<!-- BEGIN VENDOR SUB JS-->
<script src="../app-assets/js/vendors.min.js"></script>

<script src="../app-assets/js/scripts/member-new.js"></script>
<script src="../app-assets/vendors/materialize-stepper/materialize-stepper.min.js"></script>
<!-- BEGIN VENDOR SUB JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="../app-assets/js/scripts/form-wizard.js"></script>

<script src="../app-assets/vendors/data-tables/js/jquery.dataTables.js"></script>
<!-- END PAGE LEVEL JS--> 
@endsection







