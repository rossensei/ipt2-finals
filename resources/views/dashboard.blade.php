@extends('base')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Dashboard</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Summary</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">{{ $userCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text">{{ $itemCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Purchases</h5>
                                <p class="card-text">${{ $totalPurchases }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title">Product Sales Count</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Sold Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($itemsSoldCount as $item)
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                <td>${{ $item->price }}</td>
                                <td>{{ $item->sold_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
