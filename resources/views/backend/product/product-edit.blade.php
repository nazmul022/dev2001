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
                    <form action="{{ route('productUpdate') }}" method="post" enctype="multipart/form-data">
                        {{-- <p class="mg-b-20 mg-sm-b-30">A basic form where labels are aligned in left.</p> --}}
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Title: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="title" value="{{ $product->title }}" class="form-control"
                                    placeholder="Ex: Black T Shirt">
                            </div>
                        </div><!-- row -->
                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Price: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                                    placeholder="EX: 500 ৳">
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="brand_id" class="col-sm-4 form-control-label">Brand: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    {{-- <option value>Select One</option> --}}
                                    @foreach ($brands as $brand)
                                        <option @if($product->brand_id == $brand->id) selected @endif
                                            value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="category_id" class="col-sm-4 form-control-label">Category: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value>Select One</option>
                                    @foreach ($categories as $category)
                                        <option @if($product->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="subcategory_id" class="col-sm-4 form-control-label">Sub Category: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="subcategory_id" class="form-control" id="subcategory_id">
                                    <option  value="{{ $product->subcategory_id }}">{{ $product->subcategory->subcategory_name }}</option>


                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="summary" class="col-sm-4 form-control-label">Summary: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" id="summary" class="form-control">{{ $product->summary }}</textarea>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="description" class="col-sm-4 form-control-label">Description: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
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
    <div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


        <script>
            $("#category_id").change(function() {
                let category_id = $(this).val()
                if (category_id) {
                    $.ajax({
                        type: 'GET',
                        url: '/category/ajax/' + category_id,

                        success: function(data) {
                            if (data) {
                                $("#subcategory_id").empty();
                                $("#subcategory_id").append('<option value>Select Scat</option>');
                                $.each(data, function(key, value) {
                                    $("#subcategory_id").append('<option value="' + value.id +'">' + value.subcategory_name + '</option>')
                                })

                            } else {
                                $("#subcategory_id").empty();
                            }
                            // $("#msg").html(data.msg);
                        }
                    });
                } else {
                    // <option value>Select One</option>
                    $("#subcategory_id").empty();
                }
            })
            //    $(document).ready(function(){
            //     alert("OK")
            //    })
        </script>
    </div>
@endsection
