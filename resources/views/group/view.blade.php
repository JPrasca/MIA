@extends('layouts.master')
@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Listado de personas</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/person') }}">Inicio</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Personas</a>
                                </li>
                                <li class="breadcrumb-item active">Listado
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
    <script type="text/javascript">
        window.addEventListener('load', function(){
            document.getElementById('persons-li').classList.add('active');
            document.getElementById('persons-li').classList.add('open');
            document.getElementById('persons-list-li').classList.add('active');
            document.getElementById('persons-list-a').classList.add('active');
        });
    
     
    </script>
@endsection





