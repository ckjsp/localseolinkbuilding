@extends('advertiser.menu')

@section('content')
    <div class="container">
        <h1>Project Details</h1>
        <div class="card">
            <div class="card-header">
                Project Information
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $project->project_name }}</h5>
                <p class="card-text">URL: {{ $project->project_url }}</p>
                <p class="card-text">Categories: {{ $project->categories }}</p>
                <p class="card-text">Forbidden Categories: {{ $project->forbidden_category }}</p>
                <p class="card-text">Additional Note: {{ $project->additional_note }}</p>
            </div>
        </div>
    </div>
@endsection