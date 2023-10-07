@extends('backend.master')
@section('breadcrumb')
    Category
@endsection
@section('content')
<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Category Edit</h5>
    </div><!-- sl-page-title -->
    @if (session('CategoryAdd'))
    <div class="alert alert-success  alert-dismissible fade show CategoryAdd" role="alert">
        <strong>Good News!</strong> {{ session('CategoryAdd') }}

    </div>
@endif
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="card pd-20 pd-sm-40 mg-t-50">
        <form action="{{ url('category-update') }}" method="POST">
        <div class="d-sm-flex wd-sm-300 ">
          <div class="form-group mg-b-0">
            <input type="hidden" value="{{ $edit_category->id }}" name="id">
            <label>Name: <span class="tx-danger">*</span></label>
            <input type="text" value="{{ $edit_category->category_name }}" name="category_name" id="category_name" class="form-control wd-200 wd-xs-250" placeholder="Enter Name" required>
          </div><!-- form-group -->
          <div class="mg-sm-l-10 mg-t-10 mg-sm-t-25 pd-t-4">
            <button type="submit" class="btn btn-info pd-x-15">Submit</button>
          </div>
        </div>
        @csrf
      </form>
    </div><!-- card -->

  </div><!-- sl-pagebody -->
@endsection
