@extends('layouts.master_sub_id')
@section('content')
<script type="text/javascript">
        document.getElementById('home-a').classList.remove('active');
        document.getElementById('members-li').classList.add('active');
        document.getElementById('members-li').classList.add('open');
        document.getElementById('members-div').style.display = 'block';
        document.getElementById('members-list-li4').classList.add('active');
        document.getElementById('members-list-a4').classList.add('active');
</script>
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
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Miembros</a>
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
                                    Vista de un registro
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="content-overlay"></div>
            </div>                  
        </div>
    </div>

@endsection





