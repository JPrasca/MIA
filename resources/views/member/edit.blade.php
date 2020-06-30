<!-- BEGIN: VENDOR SUB CSS-->

<link rel="stylesheet" type="text/css" href="../../app-assets/css/pages/form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../app-assets/vendors/materialize-stepper/materialize-stepper.min.css">
<link rel="stylesheet" type="text/css" href="../../app-assets/vendors/data-tables/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../../app-assets/vendors/data-tables/css/jquery.dataTables.css">
<!-- END: VENDOR SUB CSS-->
@extends('layouts.master')
@section('content')
<script type="text/javascript">

    document.getElementById('home-a').classList.remove('active');
    document.getElementById('members-li').classList.add('active');
    document.getElementById('members-li').classList.add('open');
    document.getElementById('members-div').style.display = 'block';
    document.getElementById('members-list-li3').classList.add('active');
    document.getElementById('members-list-a3').classList.add('active');

    let vMemberTypeSelectList = new Array();
    let iMemberId = "{{ $objMember->Id }}";

    @foreach($vMemberTypeSelect as $vMemberTypeItem)
        vMemberTypeSelectList.push("{{ $vMemberTypeItem }}");
    @endforeach
</script>
<div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ config('constants.member_title_edit') }}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('constants.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/member') }}">{{ config('constants.member') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ config('constants.edit') }}
                            </li>
                        </ol>
                    </div>
                    @section('log-dropdown')
                    @parent   
                    @endsection
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
                                                        <input type="number" class="validate valid" name="idNumber" id="idNumber" required="" data-length="15" value="{{ $objMember->identification }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">view_agenda</i>
                                                        <label for="firstName" class="active">Nombres: <span class="red-text">*</span></label>
                                                    <input type="text" id="firstName" name="firstName" class="validate valid" required="" data-length="80" value="{{ $objMember->first_name }}">
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">view_agenda</i>
                                                        <label for="lastName" class="active">Apellidos: <span class="red-text">*</span></label>
                                                        <input type="text" id="lastName" class="validate valid" name="lastName" required="" data-length="80" value="{{ $objMember->last_name }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <div class="select-wrapper">
                                                            <i class="material-icons prefix">face</i>
                                                            <select id="genre" name="genre" required="" class="validate valid">
                                                                <option value="" disabled>Escoja el género</option>
                                                                @if ($objMember->genre == "M")
                                                                    <option value="M" selected>Masculino</option>
                                                                    <option value="F">Femenino</option> 
                                                                @else
                                                                    <option value="M" >Masculino</option>
                                                                    <option value="F" selected>Femenino</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">date_range</i>
                                                        <label for="birthDate" class="active">Fecha de nacimiento: <span class="red-text">*</span></label>
                                                        <input id="birthDate" name="birthDate" type="text" class="datepicker validate valid" required="" value="{{ $objMember->birth_date }}">
                                                    </div>
                                                </div>
                                                <div class="row"></div>
                                                <div class="step-actions">
                                                    <div class="row">
                                                        <div class="col m4 s6 mb-4">
                                                            <button class="btn btn-light previous-step waves-effect waves-light" disabled="">
                                                                <i class="material-icons left">arrow_back</i>
                                                                Atrás
                                                            </button>
                                                        </div>
                                                        <div class="col m1 s1 mb-1"></div>
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
                                            <div class="step-title waves-effect">Datos de contacto</div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">room</i>
                                                        <label for="adress">Dirección: <span class="red-text"></span></label>
                                                        <input type="text" class="validate" id="adress" name="adress" data-length="100" value="{{ $objMember->adress }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">email</i>
                                                        <label for="email" class="active">Email: <span class="red-text">*</span></label>
                                                    <input type="email" class="validate valid" name="email" id="email" required="" data-length="80" value="{{ $objMember->email }}">
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <i class="material-icons prefix">phone</i>
                                                        <label for="contactNum" class="active">Teléfono: <span class="red-text">*</span></label>
                                                        <input type="number" class="validate valid" name="contactNum" id="contactNum" required="" data-length="12" value="{{ $objMember->phone }}">
                                                    </div>
                                                </div>
                                                <div class="step-actions">
                                                    <div class="row">
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="btn btn-light previous-step waves-effect waves-light">
                                                                <i class="material-icons left">arrow_back</i>
                                                                Atrás
                                                            </button>
                                                        </div>
                                                        <div class="col m1 s1 mb-1"></div>
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
                                                        <label class="active">Ministerio (no es obligatorio)</label>                                 
                                                        <div class="section section-data-tables">
                                                        <!-- Page Length Options -->
                                                            <div class="row">
                                                                <div class="col s12">
                                                                    <table id="page-length-option" class="display responsive">
                                                                    </table>
                                                                </div>
                                                            </div>                                            
                                                        </div>                                                       
                                                    </div>  
                                                    <div class="input-field col m6 s12">
                                                        <div>
                                                            <i class="material-icons prefix">recent_actors</i>
                                                            <select id="occupation" name="occupation" required="" class="validate valid">
                                                                <option value="" disabled>Escoja una ocupación</option>                                                                
                                                                <!-- llenado del combo de tipos de ocupación con la lista
                                                                retornada del controlador-->
                                                                @foreach ($vOccupationlist as $occupationitem)  
                                                                    @if ($objMember->occupation_type == $occupationitem->Id )
                                                                        <option value="{{ $occupationitem->Id }}" selected="selected">{{ $occupationitem->name }}</option>
                                                                    @else
                                                                        <option value="{{ $occupationitem->Id }}">{{ $occupationitem->name }}</option>
                                                                    @endif
                                                                    
                                                                @endforeach
                                                            </select>
                                                            {{-- <label for="occupation">Ocupación</label> --}}
                                                        </div>    
                                                    </div>                                                                                                                                
                                                </div>
                                                <div class="step-actions">
                                                    <div class="row">
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="btn btn-light previous-step waves-effect waves-light">
                                                                <i class="material-icons left">arrow_back</i>
                                                                Atrás
                                                            </button>
                                                        </div>
                                                        <div class="col m1 s1 mb-1"></div>
                                                        <div class="col m4 s12 mb-3">
                                                            <button class="waves-effect btn btn-primary waves-light" type="button" onclick="SaveMemberConfirm()">Guardar cambios</button>
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
</div>
<div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top active">
    <a class="btn-floating btn-large waves-effect waves-light" href="{{ url('member') }}"><i class="material-icons">list</i></a>
</div>
<!-- BEGIN VENDOR SUB JS-->
<script src="../../app-assets/js/vendors.min.js"></script>

<script src="../../app-assets/js/scripts/member-edit.js"></script>
<script src="../../app-assets/vendors/formatter/jquery.formatter.min.js"></script>
<script src="../../app-assets/vendors/materialize-stepper/materialize-stepper.min.js"></script>
<!-- BEGIN VENDOR SUB JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="../../app-assets/js/scripts/form-wizard.js"></script>

<script src="../../app-assets/vendors/data-tables/js/jquery.dataTables.js"></script>
<!-- END PAGE LEVEL JS--> 
@endsection





