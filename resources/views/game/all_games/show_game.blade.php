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
                                    <h6 class="page-title">Catagory</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Games</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_game')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                                    <td>Sl No.</td>
                                                    <th>Name</th>
                                                    <th>Timing</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($game as $d)
                                                <tr>
                                                    <td>@php echo $i++ @endphp</td>
                                                    <td>{{$d->game_name}}</td>
                                                    <td>
                                                    @php $j = 1 @endphp
                                                    @foreach($time as $t)
                                                        @if($t->game_id == $d->id)
                                                            <b class="text-info pr-3">Baji @php echo $j++ @endphp</b>&nbsp;{{$t->start_time}} - {{$t->end_time}}<br>
                                                        @else
                                                            @php continue @endphp
                                                        @endif
                                                    @endforeach
                                                    </td>
                                                    <td>
                                                        <!-- <a class="btn btn-success" href="#" alt="edit"><i class="ti-check-box"></i></a> -->
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/del_game')}}/{{$d->id}}"><i class="ti-trash"></i></a>
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