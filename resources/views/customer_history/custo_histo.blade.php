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
                        
                        <!-- end page title -->
                        
                        
                        <!-- show data -->
                        @include("forms/customer_history_form")
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                        <div class="d-grid">
                                            <a class="btn btn-outline-success">Customer Details</a>
                                        </div>    
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Registration Date</th>
                                                    <th>Name</th>
                                                    <th>Telephone</th>
                                                    <th>Wallet Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$custo->reg_date}}</td>
                                                    <td>{{$custo->beneficiary_name}}</td>
                                                    <td>{{$custo->mobile}}</td>
                                                    <td>{{$custo->wallet_balance}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                        <div class="d-grid">
                                            <a class="btn btn-outline-success">Customer Play Details</a>
                                        </div>    
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Date</th>
                                                    <th>Game</th>
                                                    <th>Pay On</th>
                                                    <th>Win</th>
                                                    <th>Action</th> -->
                                                    <td>Date</td>
                                                    <!-- <th>Customer Name</th> -->
                                                    <th>Game Name</th>
                                                    <th>Time</th>
                                                    <th>Catagory</th>
                                                    <th>Digits</th>
                                                    <th>Amount</th>
                                                    <th>Is Winner</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($play as $c)
                                                <tr>
                                                    <!-- <td>{{$c->date}}</td>
                                                    <td>{{$c->gname}}</td>
                                                    <td>{{$c->payon}}</td>
                                                    <td>{{$c->winamount}}</td> -->
                                                    <td>@php echo date("d-m-Y",strtotime($c->date)) @endphp</td>
                                                    
                                                    <td>{{$c->gname}}</td>
                                                    <td>{{$c->baji}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;{{$c->start_time}}{{$c->end_time}}</td>
                                                    <td>{{$c->cata_name}}</td>
                                                    <td>{{$c->box_number}}</td>
                                                    <td>{{$c->amount}}</td>
                                                    <td @if($c->is_winner == 1)style="padding:0;" @endif>@if($c->is_winner == 1) <img style="height: 57px;width: 70px;" src="{{ url('dashboard_assets/images/winner.gif') }}"/> @else Not Win @endif</td>
                                                    <!-- <td style="display:flex;justify-content:center;"> -->
                                                        <!-- <a class="btn btn-success" href="{{url('/edit_catagory')}}/{{$c->id}}" alt="edit"><i class="ti-check-box"></i></a> -->
                                                        <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/clear_history')}}/{{$c->id}}">Clear <i class="ti-trash"></i></a> -->
                                                    <!-- </td> -->
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
                
    
