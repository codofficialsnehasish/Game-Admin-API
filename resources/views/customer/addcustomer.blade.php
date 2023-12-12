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
                                    <h6 class="page-title">Customer</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Customer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Customer</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/showcustomer')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                                <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @if(Session::has("error"))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Error!</strong> {{Session::get("error")}}
                        </div>
                        @endif
                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New Customer</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/addcustomer')}}" method="post">
                                                    @csrf
                                                    <!-- <div class="mb-3 mt-3">
                                                        <label class="form-label" for="input-date1">Date</label>
                                                        <input type="date" id="input-date1" value="20@php echo date('y-m-d') @endphp" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                        <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                                    </div> -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="form-label" for="input-email">Email address::</label>
                                                        <input id="input-email" name="email" class="form-control input-mask" data-inputmask="'alias': 'email'">
                                                        <span class="text-muted">_@_._</span>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="phone">Phone No.</label>
                                                        <div>
                                                            <input data-parsley-type="number" type="text" name="phone" id="phone" class="form-control" required placeholder="Enter phone number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">Wallet Balance</label>
                                                        <div>
                                                            <input data-parsley-type="number" type="text" name="balance" value="0" id="balance" class="form-control" placeholder="Enter phone number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">Google Pay Number</label>
                                                        <div>
                                                            <input type="checkbox" id="check1" name="check1" onclick="copyValue();" /><b style="margin:10px;color:green;">Same as Phone Number</b>
                                                            <input data-parsley-type="number" type="text" name="gpay" id="gpay" class="form-control mt-2" placeholder="Enter Gpay number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">Paytm Number</label>
                                                        <div>
                                                            <input type="checkbox" id="check2" name="check2" onclick="copyValue();" /><b style="margin:10px;color:green;">Same as Phone Number</b>
                                                            <input data-parsley-type="number" type="text" name="paytm" id="paytm" class="form-control" placeholder="Enter Paytm number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone_pay">Phone Pay Number</label>
                                                        <div>
                                                            <input type="checkbox" id="check3" name="check3" onclick="copyValue();" /><b style="margin:10px;color:green;">Same as Phone Number</b>
                                                            <input data-parsley-type="number" type="text" name="phone_pay" id="phone_pay" class="form-control" placeholder="Enter Paytm number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="pass">Password</label>
                                                        <div>
                                                            <input type="password" name="password" id="pass" class="form-control" required placeholder="Enter Password">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="cpass">Confirm Password</label>
                                                        <div>
                                                            <input type="password" name="confirm_password" id="cpass" class="form-control" required placeholder="Enter Confirm Password">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="mpin">M-Pin</label>
                                                        <div>
                                                            <input data-parsley-type="number" type="password" name="m_pin" id="mpin" class="form-control" required placeholder="Enter 4 digit M-Pin number">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="md-3">
                                                        <label for="area" class="form-label">Adding Mode</label>
                                                        <select class="form-select" id="area" name="mode" required>
                                                            <option selected disabled value="">Choose</option>
                                                            <option value="Manually">Manually</option>
                                                            <option value="App">App</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div> -->
                                                    <div class="mb-0 mt-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Customer</button>
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
                <script>
                    function copyValue() {
                        if(document.getElementById('check1').checked){
                            let text1 = document.getElementById('phone').value;        
                            document.getElementById('gpay').value = text1;
                        }
                        else{
                            document.getElementById('gpay').value = "";
                        }    
                        if(document.getElementById('check2').checked){
                            let text1 = document.getElementById('phone').value;        
                            document.getElementById('paytm').value = text1;
                        }
                        else{
                            document.getElementById('paytm').value = "";
                        } 
                        if(document.getElementById('check3').checked){
                            let text1 = document.getElementById('phone').value;        
                            document.getElementById('phone_pay').value = text1;
                        }
                        else{
                            document.getElementById('phone_pay').value = "";
                        } 
                    }
                </script>

                @include("dash/footer")