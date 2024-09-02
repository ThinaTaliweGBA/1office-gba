@extends('layouts.app2')
@section('row_content')
    <div class="chart border rounded bg-primary-subtle p-4"> <!-- Added padding for some space inside the div -->
        <form action="{{ route('sendWhatsAppMessage') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <br>
            <div class="form-group">
                <label for="receiver_number">Recipient's WhatsApp Number:</label>
                <input type="text" name="receiver_number" id="receiver_number" class="form-control" required
                    placeholder="e.g. +1234567890">

                <div class="invalid-feedback">
                    Please provide a valid number.
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" class="form-control" required></textarea>
                <div class="invalid-feedback">
                    Message is required.
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-right">Send</button>
        </form>
    </div>
    <br>
    <div class="chart border rounded bg-primary-subtle p-4">
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('receiver_number');

            input.addEventListener('input', function() {
                // Remove any character that is not a digit
                var value = this.value.replace(/[^\d]/g, '');

                // Trim value to the first nine digits after the country code
                value = value.substring(0, 11);

                // Add country code prefix if it's not present
                if (!value.startsWith('27')) {
                    value = '27' + value;
                }

                // Update the input value
                this.value = '+' + value;
            });

            input.addEventListener('focus', function() {
                // Add country code prefix if the input is empty
                if (this.value === '') {
                    this.value = '+27';
                }
            });

            input.addEventListener('blur', function() {
                // Remove country code prefix if no other input has been entered
                if (this.value === '+27') {
                    this.value = '';
                }
            });
        });
    </script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endpush
