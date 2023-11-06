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
                                    <h6 class="page-title">Sub Catagory</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/show_catagory')}}">Catagory</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Sub Catagory</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_sub_catagory')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New Sub Catagory</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/add_sub_catagory')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="catagory" class="form-label">Select Catagory</label>
                                                        <select class="form-select" id="catagory" name="catagory" required>
                                                            <option selected disabled value="">Choose Catagory</option>
                                                            @foreach($catagory as $cata)
                                                            <option value="{{$cata->id}}">{{$cata->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="subcatagory">Sub Catagory Name</label>
                                                        <input type="text" class="form-control" name="subcatagory" id="subcatagory" placeholder="Enter catagory" required>
                                                    </div>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Catagory</button>
                                                            <!-- <button type="reset" class="btn btn-secondary waves-effect">Cancel</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- end register -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")
