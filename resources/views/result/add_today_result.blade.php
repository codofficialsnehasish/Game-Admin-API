<!-- adding header -->
@include("dash/header")
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include("dash/left_side_bar")
<!-- Left Sidebar End -->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Todays Result</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Todays Result</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <a href="{{url('/todays-result')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                            <i class="fas fa-arrow-left me-2"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        @if(Session::has("msgg"))
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Error!</strong> {{Session::get("msgg")}}
        </div>
        @endif
        @if(Session::has("msg"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Well done!</strong> {{Session::get("msg")}}
        </div>
        @endif

        <form action="{{url('/post-todays-result')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        Add New Image
                    </div>
                    <div class="card-body text-center">
                        <!-- <label for="" class="mb-3 mt-3">Add Thumbnail</label> -->
                        <div class="mb-3" style="display: flex;justify-content: center;align-items: center;">
                            <img class="img-thumbnail rounded me-2" id="blah" alt="" width="800" data-holder-rendered="true">
                        </div>
                        <div class="mb-0">
                            <input type="file" name="file" class="filestyle" id="imgInp" data-input="false" data-buttonname="btn-secondary">
                        </div> 
                    </div>
                    <div class="col-lg-2 ml-3">
                        <div class="card">
                            <div style="text-align:center;"><input type="submit" class="btn btn-primary" value="Save & Update"></div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </form>

    </div> <!-- container-fluid -->
</div>
</div>
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files;
        if (file) {
            console.log("ok");
            blah.src = URL.createObjectURL(file);
        }
    }
</script>

@include("dash/footer")