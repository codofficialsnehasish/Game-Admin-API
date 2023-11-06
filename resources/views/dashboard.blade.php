<!-- adding header -->
@include("dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Dashboard</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Welcome to Supersathi Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/showuser')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/06.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Users</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;"> <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/showcustomer')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/05.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Customers</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$customer}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/show_bill')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/07.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Bills</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;"> <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/showexp')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/08.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Expences</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;"> <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- End Page-content -->

                
                @include("dash/footer")