@extends('base')

@section('content')
    <h2 class="mb-0">User Logs</h2>
    <hr class="mt-2 mb-0">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Entry</th>
            <th>User</th>
            <th>Timestamp</th>
        </thead>
        <tbody>
            @foreach($logs as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->log_entry }}</td>
                <td>{{ $data->user->name }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
