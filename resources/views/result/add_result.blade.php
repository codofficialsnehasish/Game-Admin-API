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
                                        <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Game Result</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Result</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_result')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                            <div class="card-header bg-primary text-light">Add New Result</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/post_result')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="custo" class="form-label">Games</label>
                                                        <select class="form-select" id="custo" name="game" onChange="reqs(this.value)" required>
                                                            <option selected disabled value="">Choose Game</option>
                                                            @foreach($game as $g)
                                                            <option value="{{$g->id}}">{{$g->game_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="md-3 mt-3">
                                                        <label for="baji" class="form-label">Baji</label>
                                                        <select class="form-select" id="baji" name="baji" required>
                                                            <option selected disabled value="">Choose Baji</option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="md-3 mt-3" style="display:none;" id="cata">
                                                        <label for="catagory" class="form-label">Catagory</label>
                                                        <select class="form-select" id="catagory" name="catagory" onChange="boxnumber()" required>
                                                            <option selected disabled value="">Choose catagory</option>
                                                            @foreach($catagory as $c)
                                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> -->
                                                    <!-- <div class="mb-3 mt-3" id="boxnumber" style="display:none;">
                                                        <label class="form-label" for="boxnum">Box Number</label>
                                                        <input type="number" class="form-control" name="boxnum" id="boxnum" placeholder="Choose box number" required>
                                                    </div> -->
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="pattinum">Enter Patti Number</label>
                                                        <input type="number" class="form-control" name="pattinum" id="pattinum" placeholder="Enter Patti number" required>
                                                    </div>
                                                    <div class="mb-0 mt-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Make Result</button>
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
                    function reqs(id){
                        // alert(id);
                        $("#baji").html('');
                        $.ajax({
                            url:'/get_baji/'+id,
                            type:'GET',
                            data: {},
                            success:function(resp){
                                // alert(JSON.stringify(resp));
                                // const data = JSON.parse(resp);
                                // console.log(resp[0]);
                                $(resp).each(function(i,j) {
                                    console.log(j);
                                    $("#baji").append("<option value="+j.id+">"+j.baji+" &nbsp;&nbsp;&nbsp;&nbsp;"+j.start_time +" - "+ j.end_time+"</option>");
                                });
                                che();
                            }
                        });
                    }

                    function che(){
                        document.getElementById("cata").style.display="block";
                    }
                    function boxnumber(){
                        document.getElementById("boxnumber").style.display="block";
                    }
                </script>

                @include("dash/footer")