<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Recipt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('dashboard_assets/images/favicon2.png') }}">
    
        <link href="{{ url('dashboard_assets/libs/chartist/chartist.min.css') }}" rel="stylesheet">
    
        <!-- Bootstrap Css -->
        <link href="{{ url('dashboard_assets/css/bootstrap.min.css') }}" id="bootstrap-ssstyle" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ url('dashboard_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ url('dashboard_assets/css/app.min.css') }}" id="app-ddstyle" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{ url('dashboard_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('dashboard_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            //Window.onload = window.print();
            window.onload = function(){
                document.getElementById("download").addEventListener("click", ()=>{
                    const invoice = this.document.getElementById("invoice");
                    console.log(invoice);
                    console.log(window);
                    var opt = {
                        margin: 1,
                        filename: 'receipt.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    }
                    html2pdf().from(invoice).set(opt).save();
                });
                // $("document").ready(function() {
                //     setTimeout(function() {
                //         $("#download").trigger('click');
                //     },1);
                // });
            }
        </script>
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="display:flex;justify-content: center;align-items: center;">
                            <a href="{{url('/dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    WVS
                                    <!-- <img src="{{ url('dashboard_assets/images/logo-sm.png') }}" alt="" height="22"> -->
                                </span>
                                <span class="logo-lg">
                                    WVS
                                    <!-- <img src="{{ url('dashboard_assets/images/logo-dark.png') }}" alt="" height="17"> -->
                                </span>
                            </a>

                            <a href="{{url('/dashboard')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    WVS
                                    <!-- <img src="{{ url('dashboard_assets/images/logo-sm.png') }}" alt="" height="22"> -->
                                </span>
                                <span class="logo-lg">
                                    <!-- <h1>WVS</h1> -->
                                    <img src="{{ url('dashboard_assets/images/loginicon.png') }}" alt="" height="70">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                        </div> 
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ url('dashboard_assets/images/users/user-11.jpg') }}"
                                    alt="Header Avatar">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a>
                                <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-17 align-middle me-1"></i> My Wallet</a>
                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="mdi mdi-cog font-size-17 align-middle me-1"></i> Settings<span class="badge bg-success ms-auto">11</span></a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-17 align-middle me-1"></i> Lock screen</a> -->
                                <a class="dropdown-item" href="{{url('/changepass')}}"><i class="mdi mdi-lock-plus-outline font-size-17 align-middle me-1"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" onclick="return confirm('Are you sure?')" href="{{url('/logout')}}"><i class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>