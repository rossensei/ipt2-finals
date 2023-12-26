@extends('base')

@section('content')
<div class="container p-5">
    <h2 class="fs-4">Create Item</h2>
    <div class="col-md-6">
        <form action="{{ url('/items') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input name="item_name" type="text" class="form-control" id="floatingInput" placeholder="Item name">
                <label for="floatingInput">Item name</label>
            </div>
            <div class="form-floating mb-3">
                <input name="category" type="text" class="form-control" id="floatingPassword" placeholder="Category">
                <label for="floatingPassword">Category</label>
            </div>
            <div class="form-floating mb-3">
                <input name="qty" type="number" class="form-control" id="floatingPassword" placeholder="Quantity">
                <label for="floatingPassword">Quantity</label>
            </div>
            <div class="form-floating mb-3">
                <input name="price" type="number" step="any" class="form-control" id="floatingPassword" placeholder="Price">
                <label for="floatingPassword">Price</label>
            </div>
            <div class="form-group mb-3">
                <label for="image">Item Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
