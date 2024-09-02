@extends('layouts.app2')

@section('row_content')
    <div class="card">
        <!--begin::Body-->
        <div class="container">
            <h1>WhatsApp Messages</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sender Number</th>
                        <th scope="col">Message</th>
                        <th scope="col">Received At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                    <tr>
                        <th scope="row">{{ $message->id }}</th>
                        <td>{{ $message->sender_number }}</td>
                        <td>{{ $message->body }}</td>
                        <td>{{ $message->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Body-->
    </div>
@endsection
