<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
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
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/pages/register.css">
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
                fetch(apiUrlBase + 'memberType')
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

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column register-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <form class="login-form">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Registro</h5>
                                    <p class="ml-4">Ingresa tus datos</p>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" type="text">
                                    <label for="username" class="center-align">Usuario</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">mail_outline</i>
                                    <input id="email" type="email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password">
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password-again" type="password">
                                    <label for="password-again">Confirmar contraseña</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <a href="#" onclick="SignIn()" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Registro</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p class="margin medium-small"><a href="{{ url('login') }}">¿Ya tienes usuario? Inicia sesión</a></p>
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
    <script src="{{ $sLevelDir }}app-assets/js/scripts/user-register.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>