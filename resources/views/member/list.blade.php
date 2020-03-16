<!-- BEGIN: VENDOR SUB CSS-->

<link rel="stylesheet" type="text/css" href="../app-assets/vendors/data-tables/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="../app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.css">
<link rel="stylesheet" type="text/css" href="../app-assets/vendors/data-tables/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../app-assets/css/pages/data-tables.css">
<!-- END: VENDOR SUB CSS-->
@extends('layouts.master_sub')
@section('content')

<script type="text/javascript">

    document.getElementById('home-a').classList.remove('active');
    document.getElementById('members-li').classList.add('active');
    document.getElementById('members-li').classList.add('open');
    document.getElementById('members-div').style.display = 'block';
    document.getElementById('members-list-li1').classList.add('active');
    document.getElementById('members-list-a1').classList.add('active');    
 
</script>

    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ config('constants.member_title_list') }}</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('constants.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('member/view') }}">{{ config('constants.member') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ config('constants.list') }}
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
                    <div class="section section-data-tables">
                    <!-- Page Length Options -->
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                    <h4 class="card-title">{{config('constants.member_title_list')}}</h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display responsive nowrap"  style="width: 100%;">
                                                </table>
                                            </div>
                                            <div id="progress" class="progress">
                                                <div class="indeterminate"></div>
                                            </div>
                                        </div>
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
        <a class="btn-floating btn-large waves-effect waves-light" href="{{ url('member/newmember') }}"><i class="material-icons">add</i></a>
    </div>
@endsection
    <!-- BEGIN VENDOR SUB JS-->
    <script src="../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR SUB JS-->
    <!-- BEGIN PAGE VENDOR SUB JS-->
    <script src="../app-assets/vendors/data-tables/js/jquery.dataTables.js"></script>
    <script src="../app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.js"></script>
    <script src="../app-assets/vendors/data-tables/js/dataTables.select.min.js"></script>
    <!-- END PAGE VENDOR SUB JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="../app-assets/js/scripts/data-tables.js"></script> --}}

    <script src="../app-assets/js/scripts/member-list.js"></script>

    <!-- END PAGE LEVEL JS-->




