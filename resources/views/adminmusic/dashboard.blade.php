@extends('layouts.app-admin')

@section('content')

    <!-- Content -->
    <div class="container mt-4">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p class="lead">This is the admin dashboard.</p>

        <!-- Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage registered users.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Songs</h5>
                        <p class="card-text">Manage uploaded songs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Payments</h5>
                        <p class="card-text">Check revenue reports.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">View system logs & reports.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





