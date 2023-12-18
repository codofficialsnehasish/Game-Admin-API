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
                        <li class="breadcrumb-item active" aria-current="page">Edit Todays Result</li>
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

        <form action="{{url('/update-todays-result')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        Edit Image
                        <input type="hidden" name="id" value="{{$data->id}}">
                    </div>
                    <div class="card-body text-center">
                        <!-- <label for="" class="mb-3 mt-3">Add Thumbnail</label> -->
                        <div class="mb-3" style="display: flex;justify-content: center;align-items: center;">
                            <img class="img-thumbnail rounded me-2" id="blah" src="{{ url('files/todays_result') }}/{{$data->image}}" alt="" width="800" data-holder-rendered="true">
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