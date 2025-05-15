@extends('layouts.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="card-title text-muted">Ongoing Task</h6>
                <h2 class="fw-bold text-success">{{ $ongoing }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="card-title text-muted">Completed Task</h6>
                <h2 class="fw-bold text-primary">{{ $completed }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="card-title text-muted">Total Driver</h6>
                <h2 class="fw-bold text-dark">{{ $driverCount }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
