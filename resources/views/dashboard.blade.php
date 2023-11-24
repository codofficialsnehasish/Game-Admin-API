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
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/show_game')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/10.jpg') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Games</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$games}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/show_requests')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/12.png') }}" alt="" style="max-width: 60px!important;">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Requests</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$requests}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/slider')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/11.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Slider</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$slider}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/kolkataff')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/13.jpg') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Kolkata FF Paying Cash</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$payingCash[0]->sum_paying_cash}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-8">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/kolkataff')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/14.jpg') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Kolkata FF Winning Cash</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$winCash[0]->sum_winning_cash}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- End Page-content -->

                
                @include("dash/footer")