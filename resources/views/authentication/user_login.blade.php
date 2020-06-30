<!DOCTYPE html>
<html class="loading"  data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>{{ config('constants.name') }}</title>
    <link rel="apple-touch-icon" href="{{ $sLevelDir }}app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $sLevelDir }}app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/pages/login.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->

    <script>
        const   urlBase = "{{ config('constants.url_base')}}";
        const   apiUrlBase = "{{ config('constants.api_url')}}";
        let     vMemberType = Array();
        
        function GlobalGetMemberTypes (){
            try{
                /* llenado de tipos de miembro */
                fetch(urlBase + 'api/memberType')
                .then(function(response) {
                    if(response.ok){              
                        return response.json();              
                    }
                }).then(function(jsonMemberTypes){
                    vMemberType = jsonMemberTypes.list;
                }).catch(function(){
                    M.toast({html: "Tengo problemas para obtener el listado de áreas"});
                });
            }catch(e){
                M.toast({html: "Ha ocurrido un error al ejecutar la función GlobalGetMemberTypes(): \n" + e.message });
            }
        }

        GlobalGetMemberTypes();

    </script>
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form class="login-form">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Iniciar sesión</h5>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" type="text" autocomplete="off">
                                    <label for="username" class="center-align">Usuario</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" autocomplete="off">
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                    {{-- <p>
                                        <label>
                                            <input type="checkbox" />
                                            <span>Recordame</span>
                                        </label>
                                    </p> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <a href="#" id="a-login" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Entrar</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin medium-small"><a href="{{ url('register') }}">Registro</a></p>
                                </div>
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin right-align medium-small"><a href="{{ url('forgotPassword') }}">Recordar Contraseña</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ $sLevelDir }}app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ $sLevelDir }}app-assets/js/plugins.js"></script>
    <script src="{{ $sLevelDir }}app-assets/js/search.js"></script>
    <script src="{{ $sLevelDir }}app-assets/js/custom/custom-script.js"></script>
    <script src="{{ $sLevelDir }}app-assets/js/scripts/user-login.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>