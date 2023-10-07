@extends('backend.master')
@section('breadcrumb')
    Category
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Category Add</h5>
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
                <form action="{{ url('category-post') }}" method="POST">
                    <div class="form-group">
                        <label for="category_name">Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @csrf
                </form>

            </div><!-- sl-pagebody -->
        @endsection
