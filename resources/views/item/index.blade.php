@extends('base')

@section('content')
    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success me-2" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        <div>
            {{ session('success') }}
        </div>
    </div>
    @endif
    <div class="d-flex align-items-center justify-content-between mt-5">
        <h2 class="mb-0">List of Items</h2>
        <a href="/items/create" class="btn btn-primary btn-sm px-4">Add Item</a>
    </div>
    <hr class="mt-2 mb-0">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Image</th> <!-- Add Image column -->
            <th>Name</th>
            <th>Category</th>
            <th>Available Qty</th>
            <th>Price</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->item_name }}" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->qty }}</td>
                <td>P{{ $item->price }}</td>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('items.show', ['item' => $item->id]) }}" class="btn btn-sm btn-success text-white me-2">View</a>
                        @role('admin')
                        <a href="{{ url('/items/edit/'. $item->id) }}" class="btn btn-sm btn-primary text-white me-2">Edit</a>
                        <form action="{{ url('/items/delete/'.$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Do you want to delete this product?');" class="btn btn-sm btn-danger text-white">Delete</button>
                        </form>
                        @endrole
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
