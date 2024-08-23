@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Top 10 Clients</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Total Purchases</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topClient as $client)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $client->id}}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
