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
                                        <li class="breadcrumb-item"><a href="{{url('/show_wallet')}}">Wallet</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Money</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_wallet')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                            <div class="card-header bg-primary text-light">Add Money</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/post_wallet')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="customer" class="form-label">Choose Customer</label>
                                                        <select class="form-select" id="customer" name="customer" required onchange="req(this.value)">
                                                            <option selected disabled value="">Choose Customer</option>
                                                            @foreach($customer as $customer)
                                                            <option value="{{$customer->id}}">{{$customer->beneficiary_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <input type="text" id="balance" class="form-control text-center h2" style="border:none;" value=""  required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="amount">Add Amount</label>
                                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount" required>
                                                    </div>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Money</button>
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
                    function req(id){
		                // alert(id)
                        $.ajax({
		                	url:'/get_balance/'+id,
		                	type:'GET',
		                	data: {},
		                	success:function(resp){
		                		// alert(JSON.stringify(resp[0].wallet_balance))
                                // const data = JSON.parse(resp);
                                // console.log(resp[0].wallet_balance);
                                $('#balance').val("Wallet Balance "+resp[0].wallet_balance);
                                // reqb(id);
		                	}
		                })
                    }
                </script>

                
                @include("dash/footer")
