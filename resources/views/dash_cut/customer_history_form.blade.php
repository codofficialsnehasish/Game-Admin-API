<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Example</h4> -->
                <form class="repeater custom-validation" method="post" action="{{url('/fromcus')}}">
                    @csrf
                    <div class="mb-0 "> <!-- col-lg-8 -->
                        <label class="form-label">Date Range</label>
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                            <input type="text" class="form-control" name="date1" placeholder="Start Date" />
                            <input type="text" class="form-control" name="date2" placeholder="End Date" />
                        </div>
                    </div>
                    <div class="md-3 mt-3"> <!--col-lg-4 -->
                        <label for="customer" class="form-label">Customer Name</label>
                        <select class="form-select" id="customer" name="customer" required>
                            <option selected disabled value="">Choose Customer Name</option>
                            @foreach($customer as $c)
                            <option value="{{$c->cid}}">{{$c->cname}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" value="View History"/>
                        </div>    
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>