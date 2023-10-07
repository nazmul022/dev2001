@extends('backend.master')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add Product </h5>
            <a style="float:right" href="{{ url('products') }}"><i class="fa fa-eye"></i>View</a>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-10 m-auto">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="{{ route('productStore') }}" method="post" enctype="multipart/form-data">
                        {{-- <p class="mg-b-20 mg-sm-b-30">A basic form where labels are aligned in left.</p> --}}
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Title: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="title" class="form-control" placeholder="Enter productName">
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Price: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="price" class="form-control" placeholder="Enter Price">
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="brand_id" class="col-sm-4 form-control-label">Brand: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value>Select One</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->

                        <div id="items">
                            <div class="row mg-t-20">
                                <label for="color_id" class="col-sm-2 form-control-label">Color: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <select name="color_id[]" id="color_id" class="form-control">
                                        <option value>Select One</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <label for="size_id" class="col-sm-1 form-control-label">Size: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <select name="size_id[]" id="size_id" class="form-control">
                                        <option value>Select One</option>
                                        @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <label for="category_id" class="col-sm-1 form-control-label">Quantity: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="quantity[]" class="form-control" placeholder="50">
                                </div>
                            </div><!-- row -->
                        </div>
                        <div id="items">
                            <div class="row mg-t-20">
                                <label for="color_id" class="col-sm-2 form-control-label">Color: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <select name="color_id[]" id="color_id" class="form-control">
                                        <option value>Select One</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <label for="size_id" class="col-sm-1 form-control-label">Size: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <select name="size_id[]" id="size_id" class="form-control">
                                        <option value>Select One</option>
                                        @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <label for="category_id" class="col-sm-1 form-control-label">Quantity: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="quantity[]" class="form-control" placeholder="50">
                                </div>
                            </div><!-- row -->
                        </div>
                        <div id="items">
                            <div class="row mg-t-20">
                                <label for="color_id" class="col-sm-2 form-control-label">Color: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <select name="color_id[]" id="color_id" class="form-control">
                                        <option value>Select One</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <label for="size_id" class="col-sm-1 form-control-label">Size: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                    <select name="size_id[]" id="size_id" class="form-control">
                                        <option value>Select One</option>
                                        @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <label for="category_id" class="col-sm-1 form-control-label">Quantity: <span
                                        class="tx-danger">*</span></label>
                                <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="quantity[]" class="form-control" placeholder="50">
                                </div>
                            </div><!-- row -->
                        </div>

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
                            <label for="subcategory_id" class="col-sm-4 form-control-label">Sub Category: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="subcategory_id" class="form-control" id="subcategory_id">
                                    <option value>Select One</option>
                                    @foreach ($scat as $abc)
                                        <option value="{{ $abc->id }}">{{ $abc->subcategory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="summary" class="col-sm-4 form-control-label">Summary: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" id="summary" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label for="description" class="col-sm-4 form-control-label">Description: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Thumbnail: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="file" name="thumbnail" class="form-control"
                                    placeholder="Enter firstname">
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Product Images: <span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="file" name="images[]" multiple class="form-control"
                                    placeholder="Enter firstname">
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
{{-- <script src="//code.jquery.com/jquery-3.5.1.min.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


@endsection
