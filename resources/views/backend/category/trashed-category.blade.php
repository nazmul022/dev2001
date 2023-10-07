@extends('backend.master')
@section('breadcrumb')
    Category
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Trashed Category</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Created_at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($trash_category as $t_item)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $t_item->category_name ?? 'N/A' }}</td>
                                        <td>{{ $t_item->slug ?? 'N/A' }}</td>
                                        <td>{{ $t_item->created_at != null ? $t_item->created_at->diffForHumans() : 'N/A' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ '/category-restore' }}/{{ $t_item->id }}">Restore</a>
                                            <a
                                                class="btn btn-outline-danger"href="{{ '/category-parmanent' }}/{{ $t_item->id }}">Parmanent
                                                Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
@endsection
