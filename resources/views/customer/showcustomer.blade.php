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
                                        <li class="breadcrumb-item active" aria-current="page">All Customers</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/customer')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Reg Date</th>
                                                    <th>Beneficiary Name</th>
                                                    <th>Mobile</th>
                                                    <th>Wallet Balance</th>
                                                    <th>Google Pay No.</th>
                                                    <th>Paytm No.</th>
                                                    <th>Email</th>
                                                    <th>Bank Name</th>
                                                    <th>IFSC Code</th>
                                                    <th>Acount Number</th>
                                                    <th>M-Pin</th>
                                                    <th>Password</th>
                                                    <th>Adding Mode</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customer as $c)
                                               
                                                <tr>
                                                    <td>{{$c->reg_date}}</td>
                                                    <td>{{$c->beneficiary_name}}</td>
                                                    <td>{{$c->mobile}}</td>
                                                    <td>{{$c->wallet_balance}}</td>
                                                    <td>{{$c->google_pay_no}}</td>
                                                    <td>{{$c->paytm_no}}</td>
                                                    <td>{{$c->email}}</td>
                                                    <td>{{$c->bank_name}}</td>
                                                    <td>{{$c->ifsc_code}}</td>
                                                    <td>{{$c->account_number}}</td>
                                                    <td>{{$c->m_pin}}</td>
                                                    <td>{{$c->password}}</td>
                                                    <td>{{$c->adding_mode}}</td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{url('/editcustomer')}}/{{$c->id}}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('***If you delete the customer, then the customer all data will be deleted***')" href="{{url('/customerdel')}}/{{$c->id}}"><i class="ti-trash"></i></a>
                                                    </td>
                                                    
                                                </tr>
                                               
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end show data -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")