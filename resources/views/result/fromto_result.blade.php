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
                                    <h6 class="page-title">Game Result</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Game Result</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_result')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @include("dash_cut/result_form")
                        <!-- show data -->
                        <form action="{{url('/del-result')}}" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td>Sl No.</td>
                                                    <td>Date</td>
                                                    <th>Game</th>
                                                    <th>Baji</th>
                                                    <th>Result</th>
                                                    <!-- <th>Catagory</th>
                                                    <th>Box Number</th> -->
                                                    <!-- <th>Action</th> -->
                                                    <th id="delete"><input type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-outline-danger" value="Delete"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($data as $d)
                                                <tr>
                                                    <td>@php echo $i++ @endphp</td>
                                                    <td>{{$d->date}}</td>
                                                    <td>{{$d->gname}}</td>
                                                    <td>{{$d->baji}}&nbsp;&nbsp;&nbsp;&nbsp;{{$d->start_time}} - {{$d->end_time}}</td>
                                                    <td>{{$d->patti_number}} - {{$d->single}}</td>
                                                    <!-- <td>{{$d->cname}}</td>
                                                    <td>{{$d->box_number}}</td> -->
                                                    <!-- <td style="display:flex;justify-content:center;">
                                                        <a class="btn btn-success" href="{{url('/edit_catagory')}}/{{$d->id}}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/del_result')}}/{{$d->id}}"><i class="ti-trash"></i></a>
                                                    </td> -->
                                                    <td style="display:flex;justify-content:center;"><input type="checkbox"  name="arr[]" value="{{$d->id}}"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        </form>
                        <!-- end show data -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                @include("dash/footer")