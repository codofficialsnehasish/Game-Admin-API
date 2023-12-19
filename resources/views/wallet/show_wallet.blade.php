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
                                    <h6 class="page-title">Wallet</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/add_money')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> Credit
                                            </a>
                                            <a href="{{url('/cut_money')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                                <i class="fas fa-minus me-2"></i> Debit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <form action="{{url('/del-wallet')}}" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-12">
                                <!-- <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td>Sl No.</td>
                                                    <td>Date</td>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th id="delete">Delete</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($data as $d)
                                                <tr>
                                                    <td>@php echo $i++ @endphp</td>
                                                    <td>{{$d->date}}</td>
                                                    <td>{{$d->name}}</td>
                                                    <td>{{$d->amount}}</td>
                                                    <td @if($d->status == "Credited")style="color:green;" @else style="color:red;" @endif>{{$d->status}}</td>
                                                    <td>
                                                        <input type="checkbox"  name="arr[]" value="{{$d->id}}">
                                                        <a class="btn btn-success" href="{{url('/edit_catagory')}}/{{$d->id}}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/del_catagory')}}/{{$d->id}}"><i class="ti-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                                <input type="submit" value="Delete">
                                            
                                        </table>
                                    </div>
                                </div> -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>Sl No.</td>
                                                        <td>Date</td>
                                                        <th>Name</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th id="delete"><input type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-outline-danger" value="Delete"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach($data as $d)
                                                    <tr>
                                                        <td>@php echo $i++ @endphp</td>
                                                        <td>{{$d->date}}</td>
                                                        <td>{{$d->name}}</td>
                                                        <td>{{$d->amount}}</td>
                                                        <td @if($d->status == "Credited")style="color:green;" @else style="color:red;" @endif>{{$d->status}}</td>
                                                        <td>
                                                            <input type="checkbox"  name="arr[]" value="{{$d->id}}">
                                                            <!-- <a class="btn btn-success" href="{{url('/edit_catagory')}}/{{$d->id}}" alt="edit"><i class="ti-check-box"></i></a> -->
                                                            <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/del_catagory')}}/{{$d->id}}"><i class="ti-trash"></i></a> -->
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        </form>
                        <!-- end show data -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function myFunction() {
                        // Get the checkbox
                        var checkBox = document.getElementById("myCheck");
                        // Get the output text
                        var text = document.getElementById("text");
                        var bdata = document.getElementById("bdata");

                        // If the checkbox is checked, display the output text
                        if (checkBox.checked == true){
                            text.style.display = "block";
                        } else {
                            text.style.display = "none";
                        }
                    }

                    document.addEventListener("DOMContentLoaded", () => {
                        myFunction();
                        console.log("Hello World!");
                    });
                </script>

                
                @include("dash/footer")