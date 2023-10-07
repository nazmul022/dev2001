@extends('backend.master')
@section('breadcrumb')
    Category
@endsection
@section('category')
    active
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Category View</h5>
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
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Created_at</th>
                            <th class="text-center">Created_at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <form action="{{ route("SelectedCategoryDelete") }}" method="post">
                        @csrf
                        @foreach ($categories as $key => $item)
                            <tr>
                                <td>
                                    <input class="text-center" type="checkbox" name="cat_id[]" value="{{ $item->id }}">
                                </td>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>{{ $item->category_name ?? 'N/A' }}</td>
                                <td>{{ $item->slug ?? 'N/A' }}</td>
                                <td>{{ $item->created_at->format('d-M-Y l') ?? 'N/A' }}</td>
                                <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <a href="{{ url('/category/edit') }}/{{ $item->id }}"
                                        class="btn btn-outline-success">Edit</a>
                                    <a href="{{ url('/category/delete') }}/{{ $item->id }}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="text-center">
                            <td colspan="10">
                                <button style="cursor: pointer" class="btn btn-outline-danger" type="submit">Delete</button>
                            </td>
                        </tr>
                    </form>
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
   <div>
    {{-- <script src="{{ asset('//cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script> --}}
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
   const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
@if(session('hproduct'))
Toast.fire({
  icon: 'error',
  title: '{{ session('hproduct') }}'
})
@endif
@if(session('nproduct'))
    Toast.fire({
  icon: 'success',
  title: '{{ session('nproduct') }}'
})

@endif


    </script>
   </div>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>


@endsection

