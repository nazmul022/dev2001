@extends('backend.master')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5 class="text-center">All Orders</h5>
        </div><!-- sl-page-title -->

        <div class="row">

            <div class="col-lg-2">

                <a href="{{ route('ExcelDownload') }}" class="btn btn-success mb-2">Download Excel</a>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="excel">
                    <input type="submit" class="btn btn-success" value="Upload Excel">
                </form>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('SelectedDateExcelDawnload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="submit" class="btn btn-success mb-2" value="Selected Date">
                    <input type="date" class="form-control" name="start">
                    <input type="date" class="form-control" name="end">

                </form>
            </div>
            <div class="col-lg-2">

                <a href="{{ route('PdfDownload') }}" class="btn btn-purple">Download PDF</a>
            </div>
        </div>



        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <tr>
                        <th class="text-center">SL</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Total Unit</th>
                        <th class="text-center">Purches Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($orders as $key => $item)
                            <tr>
                                <td>{{ $orders->firstItem() + $key }}</td>
                                <td>{{ $item->product->title ?? 'N/A' }}</td>
                                <td>{{ $item->quantity ?? 'N/A' }}</td>
                                <td>{{ $item->product_unit_price ?? 'N/A' }}</td>
                                <td>{{ $item->quantity * $item->product_unit_price ?? 'N/A' }}</td>
                                <td>{{ $item->created_at ?? 'N/A' }}</td>
                                {{-- <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td> --}}
                                <td>
                                    <a href="" class="btn btn-purple">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
@endsection
