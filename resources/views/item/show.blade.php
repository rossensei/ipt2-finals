@extends('base')

@section('content')
    <div class="d-flex align-items-center justify-content-between mt-5">
        <h2 class="mb-0">Item Details</h2>
        <a href="/items" class="btn btn-primary btn-sm px-4">Back to List</a>
    </div>
    <hr class="mt-2 mb-0">

    <div class="card mt-4">
        <div class="card-header">
            {{ $item->item_name }}
        </div>
        <div class="card-body">
            <p><strong>Category:</strong> {{ $item->category }}</p>
            <p><strong>Available Qty:</strong> {{ $item->qty }}</p>
            <p><strong>Price:</strong> P{{ $item->price }}</p>
            <p><strong>Image:</strong></p>
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->item_name }}" style="max-width: 100px;">
            @else
                No Image
            @endif
            <hr>
            @if ($item->qty > 0)
                <form action="{{ url('/items/buy/'.$item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Buy</button>
                </form>
            @else
                <p class="text-danger">Item is out of stock.</p>
            @endif
        </div>
    </div>
@endsection
