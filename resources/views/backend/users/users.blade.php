@extends('backend.master')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5 class="text-center">Total User({{ $user_count }})</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Registered Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $key => $item)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>{{ $item->name ?? 'N/A' }}</td>
                                <td>{{ $item->email ?? 'N/A' }}</td>
                                <td>{{ $item->created_at->format('d-M-Y l') ?? 'N/A' }}</td>
                                {{-- <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td> --}}
                                <td>
                                    <a href="{{ url('/category/edit') }}/{{ $item->id }}"
                                        class="btn btn-outline-success">Edit</a>
                                    <a href="{{ url('/category/delete') }}/{{ $item->id }}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
@endsection
