@extends('base')

@section('content')
<div class="container p-5">
    <h2 class="fs-4">Edit Item</h2>

    <div class="col-md-6">
        <form action="{{ url('/items/'.$item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-floating mb-3">
                <input name="item_name" type="text" class="form-control" value="{{ $item->item_name }}" id="item_name" placeholder="Item name">
                <label for="item_name">Item name</label>
            </div>
            <div class="form-floating mb-3">
                <input name="category" type="text" class="form-control" id="category" value="{{ $item->category }}" placeholder="Category">
                <label for="category">Category</label>
            </div>
            <div class="form-floating mb-3">
                <input name="qty" type="text" class="form-control" id="Quantity" value="{{ $item->qty }}" placeholder="Quantity">
                <label for="Quantity">Quantity</label>
            </div>
            <div class="form-floating mb-3">
                <input name="price" type="number" step="any" class="form-control" id="Price" value="{{ $item->price }}" placeholder="Price">
                <label for="Price">Price</label>
            </div>
            <div class="form-group mb-3">
                <label for="image">Item Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-sm btn-primary px-3">Save</button>
        </form>
    </div>
</div>
@endsection
