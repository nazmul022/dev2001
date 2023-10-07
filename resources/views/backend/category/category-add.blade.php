@extends('backend.master')
@section('breadcrumb')
    Category Add
@endsection
@section('content')
<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5 class="col-xl-8 m-auto">Category Add</h5>
      <a style="float:right" href="{{ url('subcategory-view') }}" ><i class="fa fa-eye"></i>View</a>

    </div><!-- sl-page-title -->
    <div class="row row-sm mg-t-20">
      <div class="col-xl-8 m-auto">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <form action="{{ url('category-post') }}" method="POST">
                <div class="form-group">
                    <label for="category_name">Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                @csrf
            </form>
        </div><!-- card -->
    </div><!-- col-6 -->
  </div><!-- row -->
</div><!-- sl-pagebody -->
@endsection
