@extends('backend.master')
@section('breadcrumb')
    Blog View
@endsection
@section('category')
    active
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog View</h5>
            {{-- <div class="alert alert-danger">
                {{ session('hproduct') }} --}}
            </div>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center"> <input type="checkbox" id="checkAll"> All</th>
                            <th class="text-center">#SL</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Thumbnail</th>
                            <th class="text-center">Created_at</th>
                            <th class="text-center">Created_at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($blog as $key => $item)
                            <tr>
                                <td>{{ $blog->firstItem() + $key }}</td>
                                <td>{{ $item->title ?? 'N/A' }}</td>
                                <td>{{ $item->slug ?? 'N/A' }}</td>
                                <td>{{ $item->thumbnail ?? 'N/A' }}</td>
                                <td>{{ $item->created_at->format('d-M-Y l') ?? 'N/A' }}</td>
                                <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <a href="" class="btn btn-outline-success">Edit</a>
                                    <a href="" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="text-center">
                            <td colspan="10">
                                <button style="cursor: pointer" class="btn btn-outline-danger" type="submit">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{ $blog->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->
@endsection

