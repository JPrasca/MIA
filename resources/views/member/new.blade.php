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
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">
                                    Aquí se visualizarán las personas registradas en el sistema
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="content-overlay"></div>
            </div>                  
        </div>
    </div>
    <!-- BEGIN VENDOR JS-->
    <script src="../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
@endsection





