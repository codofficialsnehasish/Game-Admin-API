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
                                    <h6 class="page-title">Single Catagory Data</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Single Catagory Data</li>
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
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title">Example</h4> -->
                                        <!-- <form class="custom-validation" method="post" action="">
                                            @csrf -->
                                            <div data-repeater-list="group-a">
                                                <div data-repeater-item class="row">
                                                    <div class="md-3"> <!--col-lg-4 -->
                                                        <label for="reports" class="form-label">Games</label>
                                                        <select class="form-select" id="reports" name="gameid" onchange="tab(this.value)" required>
                                                            <option selected disabled value="">Choose Game</option>
                                                            @foreach($games as $g)
                                                                <option value="{{$g->id}}">{{$g->game_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="md-3 mt-3">
                                                        <label for="baji" class="form-label">Baji</label>
                                                        <select class="form-select" id="baji" name="baji" onchange="res(this.value)" required>
                                                            <option selected value="">Choose Baji</option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                                        <div class="d-grid">
                                                            <input type="submit" class="btn btn-primary" value="View Data"/>
                                                        </div>    
                                                    </div>  -->
                                                </div>
                                            </div>
                                            <!-- <input data-repeater-create type="button" class="btn btn-success mt-2 mt-sm-0" value="Add"/> -->
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body" id="table_data">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function tab(id){
                        // alert(id);
                        $("#baji").html('');
                        $.ajax({
                            url:'/get_baji/'+id,
                            type:'GET',
                            data: {},
                            success:function(resp){
                                $(resp).each(function(i,j) {
                                    // console.log(j);
                                    $("#baji").append("<option value="+j.id+">"+j.baji+" &nbsp;&nbsp;&nbsp;&nbsp;"+j.start_time +" - "+ j.end_time+"</option>");
                                });
                                che();
                            }
                        });
                    }

                    function res(id){
                        $("#table_data").html('');
                        $.ajax({
                            url:'/single-catagory-report/'+id,
                            type:"GET",
                            data:{},
                            success:function(resp){
                                // alert(resp);
                                $("#table_data").html(resp);
                            }
                        });
                    }
                </script>
                
                @include("dash/footer")