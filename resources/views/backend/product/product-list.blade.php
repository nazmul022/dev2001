@extends('backend.master')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5 class="text-center">Total Products({{ $product_count }})</h5>
            <a style="float:right" href="{{ route('productAdd') }}"><i class="fa fa-plus"></i>Add</a>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>

                            <th class="text-center">SL</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Images</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($products as $key=> $product)
                            <tr>
                                <td>{{ $products->firstItem() + $key }}</td>
                                <td>{{ $product->title ?? 'N/A' }}</td>
                                <td>{{ $product->price ?? 'N/A' }} ৳</td>
                                <td><img src="{{ asset('images/' . $product->thumbnail) }}" alt=""></td>
                                <td>
                                    @foreach (App\Attribute::where('product_id', $product->id)->get() as $test)
                                        <span>Size: {{ $test->size->size_name }}</span>
                                        <span>Color: {{ $test->color->color_name }}</span>
                                        <span>Quantity: {{ $test->quantity }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->gallery as $img)
                                                <img style="width:50px" src="{{ asset('gallery/'.$img->created_at->format('Y/m/') .$img->product_id.'/'.$img->images)}}" alt="thumbnail">
                                        {{-- <img style= "width:50px" src="{{ asset('gallery/').$img->created_at->format('Y/m/') }}" alt="Thumbnail"> --}}
                                    @endforeach

                                </td>
                                {{-- <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td> --}}
                                <td class="form-control">

                                    <a href="{{ route('ProductEdit',$product->slug) }}" class="btn btn-outline-success">Edit</a><br>
                                    <a href="{{ route('ProductImageEdit',$product->slug) }}" class="btn btn-outline-purple">Gallery Image</a><br>

                                    <a href="{{ route('productDelete', $product->id) }}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
@endsection
