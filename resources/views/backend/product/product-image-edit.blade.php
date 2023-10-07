@extends('backend.master')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5 class="text-center">Product Edit </h5>
            <a style="float:right" href="{{ url('products') }}"><i class="fa fa-eye"></i>View</a>

        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-10 m-auto">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="{{ route('MultiImaUpdate') }}" method="post" enctype="multipart/form-data">
                        {{-- <p class="mg-b-20 mg-sm-b-30">A basic form where labels are aligned in left.</p> --}}

                        <input type="hidden" name="product_id" value="{{ $product_id }}" class="form-control">

                            @foreach ($gallery as $img)
                            {{-- <input type="text" value="{{ $img->id }}" name="id"> --}}
                                <div class="row mg-t-20">
                                <label class="col-sm-4 form-control-label">Product Thumbnail ({{ $img->product_id }}): <span
                                        class="tx-danger">*</span></label>

                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <input type="file" name="images[]" class="form-control" placeholder="Enter firstname">
                                </div>
                                <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                    <img width="100px" src="{{ asset('gallery/'.$img->created_at->format('Y/m/').$img->product_id.'/'.$img->images) }}" alt="">
                                </div>
                                <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                                    <a class="btn btn-outline-danger" href="{{ route('GalleryImageDelete', $img->id) }}">Delete</a>
                                </div>
                                </div><!-- row -->
                            @endforeach
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Product Thumbnail: <span
                                            class="tx-danger">*</span></label>

                                    <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                        <input type="file" name="images[]" class="form-control" placeholder="Enter firstname">
                                    </div>
                                    <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                    </div>
                                    <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                                        <a class="btn btn-outline-danger" href="{{ route('GalleryImageDelete', $img->id) }}">Delete</a>
                                    </div>
                                </div><!-- row -->

                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Product Thumbnail: <span
                                            class="tx-danger">*</span></label>

                                    <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                        <input type="file" name="images[]" class="form-control" placeholder="Enter firstname">
                                    </div>
                                    <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                        <img src="" alt="">
                                    </div>
                                    <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                                        <a class="btn btn-outline-danger" href="{{ route('GalleryImageDelete', $img->id) }}">Delete</a>
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
