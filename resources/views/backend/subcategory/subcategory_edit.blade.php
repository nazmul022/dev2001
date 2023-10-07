@extends('backend.master')
@section('breadcrumb')
    sub Category Edit
@endsection
@section('content')
<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Add Form Layouts</h5>
      <a style="float:right" href="{{ url('subcategory-view') }}" ><i class="fa fa-eye"></i>View</a>

    </div><!-- sl-page-title -->

    {{-- <div class="card pd-20 pd-sm-40">
      <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="John Paul" placeholder="Enter firstname">
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="lastname" value="McDoe" placeholder="Enter lastname">
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="email" value="johnpaul@yourdomain.com" placeholder="Enter email address">
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-8">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Mail Address: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="address" value="Market St. San Francisco" placeholder="Enter address">
            </div>
          </div><!-- col-8 -->
          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
              <select class="form-control select2" data-placeholder="Choose country">
                <option label="Choose country"></option>
                <option value="USA">United States of America</option>
                <option value="UK">United Kingdom</option>
                <option value="China">China</option>
                <option value="Japan">Japan</option>
              </select>
            </div>
          </div><!-- col-4 -->
        </div><!-- row -->

        <div class="form-layout-footer">
          <button class="btn btn-info mg-r-5">Submit Form</button>
          <button class="btn btn-secondary">Cancel</button>
        </div><!-- form-layout-footer -->
      </div><!-- form-layout -->
    </div><!-- card --> --}}

    <div class="row row-sm mg-t-20">
      <div class="col-xl-10 m-auto">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <form action="{{ url('subcategory-update') }}" method="post">
          <h6 class="card-body-title">Fillup Form</h6>
          {{-- <p class="mg-b-20 mg-sm-b-30">A basic form where labels are aligned in left.</p> --}}
          <div class="row">
            <label class="col-sm-4 form-control-label">Sub Category Name: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="text" name="subcategory_name" value="{{ $scat->subcategory_name }}" class="form-control" placeholder="Enter firstname">
            </div>
          </div><!-- row -->
          <div class="row mg-t-20">
            <label for="category_id" class="col-sm-4 form-control-label">Category: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <select name="category_id" class="form-control" id="category_id">

                @foreach ($categories as $item)
                <option @if($item->id == $scat->category_id ) selected @endif value="{{ $item->id }}">{{ $item->category_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
            <div class="text-right">
                <div class="form-layout-footer mg-t-30">
                    <button class="btn btn-info mg-r-5">Save</button>
                  </div><!-- form-layout-footer -->
            </div>
            @csrf
        </form>
        </div><!-- card -->
      </div><!-- col-6 -->
      {{-- <div class="col-xl-6 mg-t-25 mg-xl-t-0">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Right Label Alignment</h6>
          <p class="mg-b-30 tx-gray-600">A basic form where labels are aligned in right.</p>
          <div class="row row-xs">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Firstname:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="text" class="form-control" placeholder="Enter firstname">
            </div>
          </div><!-- row -->
          <div class="row row-xs mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Lastname:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="text" class="form-control" placeholder="Enter lastname">
            </div>
          </div>
          <div class="row row-xs mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Email:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="text" class="form-control" placeholder="Enter email address">
            </div>
          </div>
          <div class="row row-xs mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Address:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <textarea rows="2" class="form-control" placeholder="Enter your address"></textarea>
            </div>
          </div><!-- row -->
          <div class="row row-xs mg-t-30">
            <div class="col-sm-8 mg-l-auto">
              <div class="form-layout-footer">
                <button class="btn btn-info mg-r-5">Submit Form</button>
                <button class="btn btn-secondary">Cancel</button>
              </div><!-- form-layout-footer -->
            </div><!-- col-8 -->
          </div>
        </div><!-- card -->
      </div><!-- col-6 --> --}}
    </div><!-- row -->

    {{-- <div class="card pd-20 pd-sm-40 mg-t-20">
      <h6 class="card-body-title">Form Alignment</h6>
      <p class="mg-b-20 mg-sm-b-30">An inline form that is centered align and right aligned.</p>

      <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20">
        <div class="d-md-flex pd-y-20 pd-md-y-0">
          <input type="text" class="form-control" placeholder="Email address">
          <input type="password" class="form-control mg-md-l-10 mg-t-10 mg-md-t-0" placeholder="Password">
          <button class="btn btn-info pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0">Sign In</button>
        </div>
      </div><!-- d-flex -->

      <div class="d-flex align-items-center justify-content-end bg-gray-100 ht-md-80 bd pd-x-20 mg-t-10">
        <div class="d-md-flex pd-y-20 pd-md-y-0">
          <input type="text" class="form-control" placeholder="Email address">
          <input type="password" class="form-control mg-md-l-10 mg-t-10 mg-md-t-0" placeholder="Password">
          <button class="btn btn-info pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0">Sign In</button>
        </div>
      </div><!-- d-flex -->
    </div><!-- card --> --}}

  </div><!-- sl-pagebody -->
@endsection
