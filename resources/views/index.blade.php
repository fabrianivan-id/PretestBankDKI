@extends('layouts.app')

@section('content')
    <h1>Welcome to the Bank Backend Service</h1>
    <p>This is the dashboard where you can manage various banking operations.</p>

    @guest
    @else
    <!-- Dashboard Cards -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-header">Recent Applications</div>
                <div class="card-body">
                    <h5 class="card-title">Applications</h5>
                    <p class="card-text">No recent applications.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-header">System Status</div>
                <div class="card-body">
                    <h5 class="card-title">Status</h5>
                    <p class="card-text">All systems are operational.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-header">Alerts</div>
                <div class="card-body">
                    <h5 class="card-title">No Alerts</h5>
                    <p class="card-text">There are currently no alerts.</p>
                </div>
            </div>
        </div>
    </div>
    @endguest
@endsection
