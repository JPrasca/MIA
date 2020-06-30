@extends('layouts.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

    document.querySelector('#avatar-a').style.paddingTop = '0px';
    document.getElementById('home-a').classList.add('active');
    document.getElementById('home-li').classList.add('active');
</script>
<script>
    $(document).ready(function(){
       $.ajax({
          url:'https://dailyverses.net/get/verse?language=nvi&isdirect=1&url=' + window.location.hostname,
          dataType: 'JSONP',
          success:function(json){
             $(".dailyVersesWrapper").prepend(json.html);
          }
       });
    });
 </script>
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Bienvenido</span></h5>
                            <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/')}}">Inicio</a>
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
                        <div class="card animate fadeLeft" style="height: 120px;">
                            <div class="card-content">
                                <p class="caption mb-0">
                                    Hola, soy <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">MIA</strong>... Éste es mi pantalla inicial, te mostraré un versículo todos los día. Pero eso no es todo!, puedes explorar entre las opciones de mi menú, puedo ayudarte con algunas cosas.
                                </p>                                
                            </div>
                        </div>
                        <div class="card animate fadeRight" style="height: 280px;">
                            <div class="card-content" style="padding-bottom: 0px;">
                                <h6 class="breadcrumbs-title mt-0 mb-0">
                                    <span>Versículo del día</span>
                                </h6>
                            </div>                            
                            <div class="card-content" style="height: 100%;">                                
                                <div class="dailyVersesWrapper"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="content-overlay"></div>
            </div>                  
        </div>
    </div>
@endsection




