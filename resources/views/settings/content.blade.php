<style>
    .wizard>.actions {
        display:none;
    }
</style>
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
                                    <h6 class="page-title">Settings</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_edit_text_format')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="form-horizontal" class="form-horizontal form-wizard-wrapper" action="{{url('/add_content')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h3>Contact Details</h3>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtFirstNameShipping" class="col-lg-3 col-form-label">Phone</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtFirstNameShipping" data-parsley-type="digits" value="{{ $general_settings->contact_phone }}" name="phone" type="text" class="form-control" required placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtLastNameShipping" class="col-lg-3 col-form-label">Phone (Optional)</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtLastNameShipping" data-parsley-type="digits" value="{{ $general_settings->contact_phone_opt }}"  name="phoneopt" type="text" class="form-control" required placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtCompanyShipping" class="col-lg-3 col-form-label">Email</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtCompanyShipping" type="email" class="form-control" value="{{ $general_settings->contact_email }}"  name="email" required parsley-type="email" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtEmailAddressShipping" class="col-lg-3 col-form-label">Email (Optional)</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtEmailAddressShipping" type="email" class="form-control" value="{{ $general_settings->contact_email_opt }}"  name="emailopt" required parsley-type="email" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-12">
                                                        <label class="form-label">Address</label>
                                                        <div>
                                                            <textarea required class="form-control" name="address" rows="5"> {{ $general_settings->contact_address }} </textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>
                                            <h3>Wallet Details</h3>
                                            <fieldset>
                                                <div class="mb-0 mt-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Add Wallet Text</label>
                                                        <div>
                                                            <textarea required class="form-control" name="wt_text" rows="5">{{ $general_settings->wallet_add_txt }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Withdraw Wallet Text</label>
                                                        <div>
                                                            <textarea required class="form-control" name="with_text" rows="5">{{ $general_settings->wallet_withdraw_txt }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="endbtn" style="position: relative;display: block;text-align: right;width: 100%;">
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row end -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <script>
                    document.getElementById("#finish").addEventListener("click", function () {
                        alert("ok");
                        form.submit();
                    });
                </script>

                
                @include("dash/footer")