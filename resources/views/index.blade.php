<!-- resources/views/dashboard/index.blade.php -->

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
                    <h5 class="card-title">Recent Applications</h5>
                    @if($recentApplications->isEmpty())
                        <p class="card-text">No recent applications.</p>
                    @else
                        <ul class="list-group" style="color:black;">
                            @foreach($recentApplications as $application)
                                <li class="list-group-item">
                                    {{ $application->nama_ktp }} - {{ $application->created_at->format('d-m-Y H:i') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
                    <h5 class="card-title">Pending Applications</h5>
                    <p class="card-text">
                        There are currently {{ $pendingCount }} application(s) waiting for approval.
                    </p>
                    @if($pendingCount > 0)
                        <div class="alert alert-warning">
                            <strong>Alert!</strong> There are {{ $pendingCount }} application(s) waiting for approval.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endguest
@endsection
