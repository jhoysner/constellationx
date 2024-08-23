@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transactions </h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transactions') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Product</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td >{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->currency }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $transactions->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
