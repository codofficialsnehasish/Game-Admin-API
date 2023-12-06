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
                                    <h6 class="page-title">Rate Chart</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Rate Chart</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/add_chart')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-plus me-2"></i> Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->                     
                        
                        
                        <div class="row">
                            @foreach($name as $nam)
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="top-head d-flex justify-content-between">
                                            <h4 class="card-title text-center" style="display: flex;align-items: center;">{{$nam->name}}</h4> 
                                            <div class="action">
                                                <a class="btn btn-outline-success" href="{{url('/edit_chart')}}/{{$nam->id}}">Edit</a>
                                                <a class="btn btn-outline-danger" href="{{url('/del_chart')}}/{{$nam->id}}">Delete</a>
                                            </div>
                                        </div>
                                        <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/del_chart')}}/{{$nam->id}}"><i class="ti-trash"></i></a>  -->
                                        
                                        <div class="table-responsive">
                                            <table class="table mb-0">

                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Play</th>
                                                        <th>Winning</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rate as $r)
                                                    <tr>
                                                        @if($nam->id == $r->chart_name_id)
                                                        <td>{{$r->type}}</td>
                                                        <td>{{$r->play}}</td>
                                                        <td>{{$r->winning}}</td>
                                                        @else
                                                            @php continue @endphp
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- end row -->


                        @include("dash/footer")