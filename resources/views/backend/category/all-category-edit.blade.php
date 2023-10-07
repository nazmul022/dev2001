@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-success text-light">{{ __('View Category') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $key }}</th>
                                        <td>{{ $item->category_name ?? 'N/A' }}</td>
                                        <td>{{ $item->slug ?? 'N/A' }}</td>
                                        <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            {{-- <button type="button"  class="btn btn-outline-primary getid" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                                Edit
                                            </button> --}}

                                            <a class="btn btn-outline-primary" href="{{ url('/category/edit') }}/{{ $item->id }}">Edit</a>
                                            <a class="btn btn-outline-danger"
                                                href="{{ url('/category/delete') }}/{{ $item->id }}">Delete</a>
                                        </td>
                                    </tr>
                                                            <!-- Modal -->
                                    {{-- <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title : Name</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <input type="text" value="{{ $item->category_name }}">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-primary">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div> --}}
                                @endforeach

                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    </div>

                    <div class="card-header text-center bg-danger text-light">{{ __('Trash Data') }}</div>
                    <div class="card-body">
                        @if (session('CategoryParmanent'))
                            <div class="alert alert-success CategoryParmanent" role="alert">
                                {{ session('CategoryParmanent') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trash_category as $t_item)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $t_item->category_name ?? 'N/A' }}</td>
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center bg-primary text-light">{{ __('Edit Category') }}</div>
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

                        <form action="{{ url('category-update') }}" method="POST">
                            <div class="mb-3">
                                <input type="hidden" value="{{ $edit_category->id }}" name="id">
                                <label for="category_name" class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ $edit_category->category_name }}" name="category_name" id="category_name"
                                    placeholder="Ex:-Fashion">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
