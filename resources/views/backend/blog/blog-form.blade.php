@extends('backend.master')
@section('breadcrumb')
    Blog Form
@endsection
@section('blog')
    active
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add Blog </h5>
            {{-- <a style="float:right" href="{{ Route('') }}"><i class="fa fa-eye"></i>View</a> --}}
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-10 m-auto">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                        {{-- <p class="mg-b-20 mg-sm-b-30">A basic form where labels are aligned in left.</p> --}}
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Blog Title: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="title" class="form-control" placeholder="Enter productName">
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="category_id" class="col-sm-4 form-control-label">Category: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value>Select One</option>
                                    @foreach ($categories as $abc)
                                        <option value="{{ $abc->id }}">{{ $abc->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="my-editor" class="col-sm-4 form-control-label">Summary: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" id="my-editor" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Thumbnail: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="file" name="thumbnail" class="form-control" placeholder="Enter firstname">
                            </div>
                        </div><!-- row -->
                        <div class="text-center">
                            <div class="form-layout-footer mg-t-30">
                                <button class="btn btn-outline-info mg-r-5">Submit</button>
                            </div><!-- form-layout-footer -->
                        </div>
                        @csrf
                    </form>
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </div><!-- sl-pagebody -->
@endsection
@section('footer_js')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
