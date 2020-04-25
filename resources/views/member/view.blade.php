@extends('layouts.master_sub_id')
@section('content')
<script type="text/javascript">
        document.getElementById('home-a').classList.remove('active');
        document.getElementById('members-li').classList.add('active');
        document.getElementById('members-li').classList.add('open');
        document.getElementById('members-div').style.display = 'block';
        document.getElementById('members-list-li4').classList.add('active');
        document.getElementById('members-list-a4').classList.add('active');

        document.querySelector("#avatar-a").style.padding = "";
        document.querySelector("#avatar-i").style.top = "";

    function SendMail(sEmail){
        window.location = "mailto:" + sEmail;
    }
</script>
<link rel="stylesheet" type="text/css" href="../../app-assets/css/pages/page-users.css">
    <div id="main">
        
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Datos de membresía</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('constants.home') }}</a>
                                </li>
                            <li class="breadcrumb-item"><a href="{{ url('/member') }}">{{ config('constants.member') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ config('constants.view') }}
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
                    <!-- users view start -->
                    <div class="section users-view">
                        <!-- users view media object start -->
                        <div class="card-panel animate fadeUp">
                            <div class="row">
                                <div class="col s12 m7">
                                    <div class="display-flex media">
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <span class="users-view-name">{{ strtoupper($objMember->first_name) }} {{ strtoupper($objMember->last_name) }}</span>
                                                {{-- <span class="grey-text">@</span>
                                                <span class="users-view-username grey-text">candy007</span> --}}
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{ $objMember->identification }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    <a href="#" onclick="SendMail('{{ $objMember->email }}')" class="btn-small btn-light-blue waves-effect waves-dark"><i class="material-icons">mail_outline</i></a>
                                    {{-- <a href="user-profile-page.html" class="btn-small btn-light-indigo">Profile</a> --}}
                                    <a href="{{ config('constants.url_base')}}member/edit/{{ $objMember->Id }}" class="btn-small primary waves-effect waves-light">Editar</a>
                                </div>
                            </div>
                        </div>
                        <!-- users view media object ends -->
                        <!-- users view card data start -->
                        <div class="card animate fadeLeft">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m6">
                                        <h6 class="mb-2 mt-2"><i class="material-icons">info_outline</i> Información personal & contacto</h6>
                                        <table class="striped s12 m6">
                                            <tbody>
                                                <tr>
                                                    <td>Género:</td>
                                                    @if ($objMember->genre == 'M')
                                                        <td>Masculino</td>  
                                                    @else
                                                        <td>Femenino</td>
                                                    @endif
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="">Edad</td>
                                                    <td >{{ $objMember->age }} años</td>
                                                </tr>
                                                <tr>
                                                    <td>Fecha de nacimiento</td>
                                                    <td>{{ $objMember->birth_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td class="users-view-role"><a href="#" onclick="SendMail('{{ $objMember->email }}')">{{ $objMember->email }}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Teléfono:</td>
                                                    <td class="users-view-role">{{ $objMember->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Dirección:</td>
                                                    <td class="users-view-role">{{ $objMember->adress }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col s12 m6">
                                        <h6 class="mb-2 mt-2"><i class="material-icons">info_outline</i>Otros datos de membresía</h6>
                                        <table class="striped s12 m6">
                                            <tbody>
                                                <tr>
                                                    <td>Fecha de registro:</td>
                                                    <td>{{ $objMember->regist_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ocupación:</td>
                                                    {{-- occupation_type.name --}}
                                                    <td class="users-view-role">{{ $objMember->occupation_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Área:</td>
                                                    <td>
                                                        {{-- members.member_type_id --}}
                                                        @foreach ($vMemberTypeSelect as $item)                                                        
                                                            <span class=" users-view-status chip {{$item->color_template2}} lighten-4 ">
                                                                <span class="{{$item->color_template}}-text" >
                                                                    {{ $item->name}}
                                                                </span>
                                                            </span>                                                         
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- users view card data ends -->
                    </div>
                    <!-- users view ends -->                    
                </div>
                <div class="content-overlay"></div>
            </div>                  
        </div>
        <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top active">
            <a class="btn-floating btn-large waves-effect waves-light" href="{{ url('member') }}"><i class="material-icons">list</i></a>
        </div>
    </div>
    <!-- BEGIN VENDOR JS-->
    <script src="../../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    {{-- <script src="../../app-assets/js/scripts/page-users.js"></script> --}}
@endsection





