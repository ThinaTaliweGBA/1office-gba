<!-- resources/views/emptyPage.blade.php -->

@extends('layouts.app2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info my-16">
                    <p>This page is currently empty.</p>
                    <p>Please check back later or <a href="{{ route('home') }}">return to the homepage</a>.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
