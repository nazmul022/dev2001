@extends('backend.master')
@section('breadcrumb')
    sub Category
@endsection
@section('category')
    active
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Sub Category View</h5>
            <a style="float:right" href="{{ url('subcategory-form') }}"><i class="fa fa-plus"></i>Add</a>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Category Name</th>
                            <th class="text-center">Created_at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($scategories as $key => $item)
                            <tr>
                                <td>{{ $scategories->firstItem() + $key }}</td>
                                <td>{{ $item->subcategory_name ?? 'N/A' }}</td>
                                <td>{{ $item->slug ?? 'N/A' }}</td>
                                <td>{{ $item->get_category->category_name }}</td>
                                <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    {{-- use for url --}}
                                    {{-- <a href="{{ url('subcategory-edit') }}/{{ $item->slug }}"class="btn btn-outline-success">Edit</a> --}}
                                    {{-- user for route --}}
                                    <a href="{{ route('SubCategoryEdit',$item->slug) }}"class="btn btn-outline-success">Edit</a>
                                    <a href=""class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $scategories->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
@endsection
