<!DOCTYPE html>
<html class="loading" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="MIA CNX">
    <meta name="author" content="JPrasca">
    <title>{{ config('constants.name') }}</title>
    <link rel="apple-touch-icon" href="{{ $sLevelDir }}app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $sLevelDir }}app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/vendors/vendors.min.css">
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/themes/vertical-modern-menu-template/style.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $sLevelDir }}app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->

    <script>
        const   urlBase = "{{ config('constants.url_base')}}";
        const   apiUrlBase = "{{ config('constants.api_url')}}";

        let     vMemberType = Array();
        
        /* obteniendo tipos de miembros */
        const GlobalGetMemberTypes = () => {
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

        /*corroborando que existan datos de usuario en sesión*/
        const CheckLogin = () => {

            fetch(apiUrlBase + "userapp/check", {
                method: 'GET',
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then((response) => {
                if(response.ok){              
                    return response.json();              
                }
            })
            .then((myJson) => {
                //el estado de error indica que algo sucedió y que se debe redireccionar 
                if(myJson.status == "error"){
                    M.toast({html: myJson.message }); 
                    setTimeout(()=>{
                        location.href = urlBase + 'login';
                    }, 1000);
                    //console.log(myJson.data);
                }
            })
            .catch((error) => {
                M.toast({html: "Tenemos problemas para procesar los datos: \n"}); 
            });  
        }

        CheckLogin();

        //se realiza petición periódicamente para corroborar que sigue activo el usuario
        setInterval(CheckLogin, 5000);

        GlobalGetMemberTypes();

    </script>


    {{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> --}}
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
                <div class="nav-wrapper">
                    {{-- <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Buscar en {{ config('constants.name')  }}" data-search="template-list">
                        <ul class="search-list collection display-none"></ul>
                    </div> --}}
                    <ul class="navbar-list right">
                        {{-- <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li> --}}
                        {{-- <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li> --}}
                        <li>
                            {{ $objUser['name'] }}
                        </li>
                        <li>
                            <a id="avatar-a" style="padding-bottom: 18px; padding-top:18px; height: 65px" class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown">
                                <span class="avatar-status avatar-online">
                                    <img src="{{ $sLevelDir }}app-assets/images/avatar/avatar-7.png" alt="avatar">
                                    {{-- <i id="avatar-i" style="top: 65%;"></i> --}}
                                </span>
                            </a>
                        </li>
                    </ul>

                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Perfil</a></li>                       
                        <li class="divider"></li>                        
                        <li><a class="grey-text text-darken-1" href="{{ url('logout') }}"><i class="material-icons">keyboard_tab</i> Salir</a></li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form>
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ url('/') }}"><img class="hide-on-med-and-down" src="{{ $sLevelDir }}app-assets/images/logo/materialize-logo-color.png" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ $sLevelDir }}app-assets/images/logo/materialize-logo.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">{{ config('constants.name')  }}</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

            <li id="home-li" class="bold"><a  id="home-a" class="waves-effect waves-cyan" href="{{ url('/') }}"><i class="material-icons">home</i><span class="menu-title" data-i18n="Home">{{ config('constants.home') }}</span></a>
            </li>
            <li class="navigation-header"><a class="navigation-header-text">Gestión de personal</a><i class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            <li id="members-li" class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">people</i><span class="menu-title" data-i18n="People">{{ config('constants.member') }}</span></a>
                <div id="members-div" class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li id="members-list-li1">
                            <a id="members-list-a1" href="{{ url('member/view') }}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Member List">
                                    {{ config('constants.list') }}
                                </span>
                            </a>
                        </li>
                        <li id="members-list-li2">
                            <a id="members-list-a2" href="{{ url('member/newmember') }}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Member Add">
                                    {{ config('constants.new') }}
                                </span>
                            </a>                        
                        </li>
                        @if (isset($sViewMode) && $sViewMode == 'edit')
                        <li class="hidden-item" id="members-list-li3">
                            <a id="members-list-a3" href="#">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Member Edit">
                                    {{ config('constants.edit') }}
                                </span>
                            </a>
                        </li>                
                        @endif
                        @if (isset($sViewMode) && $sViewMode == 'view')
                        <li class="hidden-item" id="members-list-li4">
                            <a id="members-list-a4" href="#">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Member View">
                                    {{ config('constants.view') }}
                                </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">people</i>
                    <span class="menu-title" data-i18n="People">{{ config('constants.leader') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders List">{{ config('constants.list') }}</span></a>
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders Add">{{ config('constants.new') }}</span></a>                        </li>
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders Edit">{{ config('constants.edit') }}</span></a>
                        </li>
                        </li>
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders View">{{ config('constants.view') }}</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">group_work</i><span class="menu-title" data-i18n="People">{{ config('constants.group') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders List">{{ config('constants.list') }}</span></a>
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders Add">{{ config('constants.new') }}</span></a>                        </li>
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders Edit">{{ config('constants.edit') }}</span></a>
                        </li>
                        </li>
                        <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Leaders View">{{ config('constants.view') }}</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li id="configuration-li" class="navigation-header"><a class="navigation-header-text">Configuración</a><i class="navigation-header-icon material-icons">build</i>
            </li>
            <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                    <i class="material-icons">build</i>
                    <span class="menu-title" data-i18n="Build">
                        {{ config('constants.param') }}
                    </span>
                </a>
                <div id="configuration-div" class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a id="configuration-a1" href="{{ url('configuration/memberType') }}"><i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Leaders List">
                                    {{ config('constants.param_title_member_type') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a id="configuration-a2" href="{{ url('configuration/occupationType') }}"><i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Leaders Add">
                                    {{ config('constants.param_title_occupation_type') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            

        </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    @yield('content')

    @section('log-dropdown')
        <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a>
            <ul class="dropdown-content" id="dropdown1" tabindex="0">
                <li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">Perfil<span class="new badge red">2</span></a></li>
                <li class="divider" tabindex="-1"></li>
                <li tabindex="0"><a class="grey-text text-darken-2" href="{{ url('logout') }}">Salir</a></li>
            </ul>
        </div>   
    @endsection
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span class="right">{{ config('constants.dataYear') }} {{ config('constants.copyRight') }} <a href="#">{{ config('constants.author') }}</a></span></div>
        </div>
    </footer>

    <!-- END: Footer-->
    @if ($sLevelDir == '')
        <!-- BEGIN VENDOR JS-->
        <script src="{{ $sLevelDir }}app-assets/js/vendors.min.js"></script>
        <!-- BEGIN VENDOR JS-->
    @endif


    <!-- BEGIN THEME  JS-->
    <script src="{{ $sLevelDir }}app-assets/js/plugins.js"></script>
    <script src="{{ $sLevelDir }}app-assets/js/search.js"></script>
    <script src="{{ $sLevelDir }}app-assets/js/custom/custom-script.js"></script>
    <script src="{{ $sLevelDir }}app-assets/vendors/sweetalert/sweetalert.min.js"></script>
    <!-- END THEME  JS-->

</body>

</html>