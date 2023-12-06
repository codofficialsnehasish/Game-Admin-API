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
                                        <li class="breadcrumb-item active" aria-current="page">Add New Chart</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/charts')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New Rate Chart</div>
                                            <div class="card-body">
                                                <form class="outer-repeater custom-validation" action="{{url('/post_chart')}}" method="post">
                                                    @csrf
                                                    <!-- <input type="text" value="value", name="val"> -->
                                                    <div data-repeater-list="outer_group" class="outer">
                                                        <div data-repeater-item class="outer">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="formname">Chart Name:</label>
                                                                <input type="text" name="name" class="form-control" id="formname" placeholder="Enter Chart Name..." required>
                                                            </div>
                
                                                            <div class="inner-repeater mb-4">
                                                                <div data-repeater-list="inner_group" class="inner mb-3 row">
                                                                    <div class="col-md-3"><label class="form-label">Type:</label></div>
                                                                    <div class="col-md-3"><label class="form-label">Play :</label></div>
                                                                    <div class="col-md-3"><label class="form-label">Winning :</label></div>
                                                                    <div data-repeater-item class="inner mb-3 row">
                                                                        <!-- <div class="col-md-1 col-sm-2">
                                                                            <div class="d-grid">
                                                                                <input type="text" value="Baji" style="border:none;" class="form-control inner mt-2 mt-sm-0" readonly/>
                                                                            </div>    
                                                                        </div> -->
                                                                        <div class="col-md-3 col-sm-8 d-flex">
                                                                            <input type="text" name="type" id="timeInput" class="inner form-control" placeholder="" required/>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-8">
                                                                            <input type="text" name="play" id="timeInput" class="inner form-control" required/>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-8">
                                                                            <input type="text" name="win" class="inner form-control" required/>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-4">
                                                                            <div class="d-grid">
                                                                                <input data-repeater-delete type="button" class="btn btn-primary inner mt-2 mt-sm-0" value="Delete Row"/>
                                                                            </div>    
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <input data-repeater-create type="button" class="btn btn-success inner" value="Add Row"/>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                    var inputEle = document.getElementById('timeInput');


                    function onTimeChange() {
                        var timeSplit = inputEle.value.split(':'),
                            hours,
                            minutes,
                            meridian;
                        hours = timeSplit[0];
                        minutes = timeSplit[1];
                        if (hours > 12) {
                            meridian = 'PM';
                            hours -= 12;
                        } else if (hours < 12) {
                            meridian = 'AM';
                            if (hours == 0) {
                            hours = 12;
                            }
                        } else {
                            meridian = 'PM';
                        }
                        let t = hours + ':' + minutes + ' ' + meridian;
                        console.log(t);
                        $('#timeInput').val(t);
                        // alert(hours + ':' + minutes + ' ' + meridian);
                    }
                </script>
                
                @include("dash/footer")
