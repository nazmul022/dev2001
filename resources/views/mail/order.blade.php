<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#SL</th>
        <th scope="col">Product Name</th>
        <th scope="col">Image</th>
        <th scope="col">Product Quantity</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($data as $item)
      <tr>
        <th>{{ $loop->index + 1 }}</th>
        <td>{{ $item->product->title }}</td>
        <td> <img src="{{ asset('images/'.$item->product->thumbnail) }}" alt="{{ $item->product->title }}"></td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->product_unit_price }}</td>
        @php
            $total+= $item->quantity * $item->product_unit_price;
        @endphp
      </tr>
      @endforeach
      <span>{{ $total }}</span>
    </tbody>
  </table>
