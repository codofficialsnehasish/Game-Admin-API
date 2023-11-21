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
                                    <h6 class="page-title">Notification</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Notification</li>
                                    </ol>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_result')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- end page title -->
               
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-bs-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">Date</th>
                                                        <th data-priority="3">Customer Name</th>
                                                        <th data-priority="1">Amount</th>
                                                        <th data-priority="3">Which For</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($data as $d)
                                                    <tr>
                                                        <th>{{$d->date}}</th>
                                                        <td>{{$d->cname}}</td>
                                                        <td>{{$d->amount}}</td>
                                                        <td>@if($d->which_for == "add_fund")Add Fund in Wallet @else Withdraw Fund @endif</td>
                                                        <td>
                                                            @if($d->which_for == "add_fund")
                                                            <a class="btn btn-outline-success" href="{{url('/approve_add_fund')}}/{{$d->id}}" alt="edit">Approve <i class="ti-check-box"></i></a>
                                                            <a class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" href="{{url('/cancel_add_fund')}}/{{$d->id}}">Cancel<i class="ti-trash"></i></a>
                                                            @elseif($d->which_for == "fund_withdraw")
                                                            <a class="btn btn-outline-success" href="{{url('/withdraw_fund')}}/{{$d->id}}" alt="edit">Approve <i class="ti-check-box"></i></a>
                                                            <a class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" href="{{url('/cancel_withdraw_fund')}}/{{$d->id}}">Cancel<i class="ti-trash"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")