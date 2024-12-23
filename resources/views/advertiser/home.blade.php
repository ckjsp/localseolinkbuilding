@extends('advertiser.menu')

@section('sidebar-content')
@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_url('libs/toastr/toastr.css') }}">
@endpush
<link rel="stylesheet" href="{{ asset_url('libs/shepherd/shepherd.css') }}" />
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y pt-5 mt-5">
    <div class="row mb-5">

        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <a href="{{ url('/advertiser/orders') }}"><span
                                    class="avatar-initial rounded bg-label-primary"><i
                                        class="ti ti-truck ti-md"></i></span></a>
                        </div>
                        <h4 class="ms-1 mb-0">{{$orderCount}}</h4>
                    </div>
                    <p class="mb-1">Total Orders</p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">{{$successOrderCount}}</span>
                        <small class="text-muted">Completed Orders</small>
                    </p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">{{$pendingOrderCount}}</span>
                        <small class="text-muted">Pending Orders</small>
                    </p>
                </div>
            </div>
        </div>

        <!-- <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i
                                    class="ti ti-git-fork ti-md"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">Total Content Writing</p>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="ti ti-alert-triangle ti-md"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">$0</h4>
                    </div>
                    <p class="mb-1">Total Funds Added</p>
                </div>
            </div>
        </div> -->
    </div>
    <div class="project_details">
        @if($projects->isEmpty())
        <div class="row text-center justify-content-center empty-container">
            <img src="{{ asset('public/img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;">
            <h5>Unlock High-Quality Backlinks and Boost<br /> Traffic with a New Project</h5>
            <p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest
                posting
                campaigns.</p>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn"
                class="btn btn-primary w-auto">+Add Projects
            </a>
        </div>
        @else
        <div class="d-flex justify-content-between my-3 step-3">
            <h5 class="card-title">
            </h5>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn"
                class="btn btn-primary w-auto">+Add Projects
            </a>
            {{-- <button id="shepherd-example">Start Tour</button> --}}
        </div>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div id="projects-container">
            @foreach($projects as $project)
            <div class="row mb-3 step-4" id="project-card-{{ $project->id }}">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $project->project_name }}</h5>
                        <div class="d-flex gap-3">
                            <p class="card-text"> {{ $project->project_url }}</p>
                            <span>Created on {{ \Carbon\Carbon::parse($project->created_at)->format('F d, Y') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex">
                            <div class="col col-md-3 border rounded p-4 pb-0 bg-light">
                                <div>
                                    <p>Total Backlinks built from LP</p>
                                    <h4>1</h4>
                                </div>
                                <div>
                                    <p>Total Paid</p>
                                    <h4>$25</h4>
                                </div>
                                <div>
                                    <p>Total Content Written</p>
                                    <h4>10</h4>
                                </div>
                            </div>
                            <div class="col col-md-3 d-flex flex-column border rounded p-3">
                                <img src="{{ asset_url('img/pages/project-moz-logo.svg') }}" style="max-width: 67px; height: 23px;" />
                                <div class="mt-3 d-flex align-items-center">
                                    <span class="mt-3">Domain Authority</span><br>
                                </div>

                                <h4 class="mt-3"> <svg width="20" viewBox="0 0 160 160">
                                        <circle r="70" cx="80" cy="80" fill="transparent" stroke="#e0e0e0" stroke-width="12px"></circle>
                                        <circle r="70" cx="80" cy="80" fill="transparent" stroke="#60e6a8" stroke-width="12px" stroke-dasharray="439.6px" stroke-dashoffset="109.9px"></circle>
                                    </svg> 70</h4>

                                <div class="mt-2 d-flex align-items-center">
                                    <span class="mt-3">Spam Score</span><br>
                                </div>

                                <h4 class="mt-3">20%</h4>

                            </div>

                            <div class="col  d-flex flex-column border rounded p-3">
                                <img src="{{ asset_url('img/pages/project-semrush-logo.svg') }}" style="max-width: 30%;" alt="Project SEMrush Logo" />
                                <div class="d-flex gap-5 flex-wrap mt-2">
                                    <div class="mt-3 justify-content-between align-items-center">
                                        <p>Authority Score</p>
                                        <h4 class="mt-3"> <svg width="20" viewBox="0 0 160 160">
                                                <circle r="70" cx="80" cy="80" fill="transparent" stroke="#e0e0e0" stroke-width="12px"></circle>
                                                <circle r="70" cx="80" cy="80" fill="transparent" stroke="#60e6a8" stroke-width="12px" stroke-dasharray="439.6px" stroke-dashoffset="109.9px"></circle>
                                            </svg> 4</h4>
                                    </div>
                                    <div class="mt-3  justify-content-between align-items-center">
                                        <p>Organic Traffic</p>
                                        <h4>268</h4>
                                    </div>
                                    <div class="mt-3  justify-content-between align-items-center">
                                        <p>Referring Domain</p>
                                        <h4>1.1K</h4>
                                    </div>
                                    <div class="mt-3  justify-content-between align-items-center">
                                        <p>Total Backlinks</p>
                                        <h4>66.2K</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-md-12 d-flex align-items-center justify-content-end  px-0">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#competitorModal" data-project-id="{{ $project->id }}" id="addcompetitorBtn" class="btn btn-primary w-auto step-5 waves-effect waves-light">
                                    +Add Competitors
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @include('advertiser.partials.createprojectmodal')
</div>


<!-- Modal for Adding Competitor -->

<div class="modal fade loader" id="competitorModal" tabindex="-1" aria-labelledby="competitorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="competitorModalLabel">Add Competitor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="competitorForm" action="{{ route('addcompetitor') }}" method="POST" onsubmit="return handleCompetitorFormSubmit()">
                    @csrf
                    <input type="hidden" id="projectId" name="project_id">
                    <div class="mb-3">
                        <label for="competitorUrl" class="form-label">Competitor URL</label>
                        <input type="text" class="form-control" id="competitorUrl" name="add_competitor" placeholder="Enter competitor URL" required oninput="validateCompetitorUrl()">
                        <div class="invalid-feedback" id="urlErrorMsg" style="display: none;">
                            Please enter a valid .com URL without any additional path (e.g., no / after .com).
                        </div>
                        <p class="text-danger">Cannot add more than 3 competitors</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

                <!-- Loader -->
                <div id="loader" class="text-center" style="display: none;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <ul id="competitorList" class="list-group mt-2">
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    #projectCategories~.select2 .select2-search__field {
        width: 100% !important;
    }

    .width-calc {
        width: calc(25% - 20px);
    }

    .card-body .row {
        gap: 10px;
    }
</style>

<script src="{{ asset_url('libs/shepherd/shepherd.js') }}"></script>
<script src=" {{ asset_url('libs/toastr/toastr.js') }}"></script>
<script src="{{ asset_url('js/projects.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addCompetitorBtns = document.querySelectorAll('#addcompetitorBtn');
        const loader = document.getElementById('loader');

        addCompetitorBtns.forEach(btn => {

            btn.addEventListener('click', function() {
                const projectId = btn.getAttribute('data-project-id');
                document.getElementById('projectId').value = projectId;

                // Show loader
                loader.style.display = 'block';

                // Fetch competitors for the project
                fetch(`/competitors/${projectId}`)
                    .then(response => response.json())
                    .then(data => {
                        const competitorList = document.getElementById('competitorList');
                        competitorList.innerHTML = ''; // Clear the list first

                        // Handle competitors after a delay
                        setTimeout(() => {
                            if (Array.isArray(data.competitors) && data.competitors.length > 0) {
                                let counter = 1;

                                data.competitors.forEach(url => {
                                    url = url.trim(); // Remove extra spaces

                                    if (url) { // Ensure URL is not empty
                                        const listItem = document.createElement('li');
                                        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                                        listItem.textContent = `${counter}. ${url}`;

                                        // Create remove button
                                        const removeBtn = document.createElement('button');
                                        removeBtn.className = 'btn btn-danger btn-sm ms-2';
                                        removeBtn.textContent = 'Remove';
                                        removeBtn.addEventListener('click', function() {
                                            // Show loader
                                            loader.style.display = 'block';

                                            // Remove competitor URL
                                            fetch(`/competitors/${projectId}/remove`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-Requested-With': 'XMLHttpRequest',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                    },
                                                    body: JSON.stringify({
                                                        url: url
                                                    })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        listItem.remove(); // Remove from the list on success
                                                    } else {
                                                        console.error('Error removing competitor:', data.error);
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                })
                                                .finally(() => {
                                                    loader.style.display = 'none'; // Hide loader after processing
                                                });
                                        });

                                        listItem.appendChild(removeBtn);
                                        competitorList.appendChild(listItem);

                                        counter++;
                                    }
                                });
                            } else {
                                competitorList.innerHTML = '<li class="list-group-item">No competitors found.</li>';
                            }

                            // Hide loader after displaying competitors
                            loader.style.display = 'none';
                        }, 1000); // Show competitors after 3 seconds
                    })
                    .catch(error => {
                        console.error('Error fetching competitors:', error);
                        // Hide loader on error
                        loader.style.display = 'none';
                    });
            });
        });

        // Reset data when the modal is closed

        $('#competitorModal').on('hidden.bs.modal', function() {
            document.getElementById('competitorForm').reset(); // Reset form fields
            document.getElementById('competitorList').innerHTML = ''; // Clear competitor list
        });
    });
</script>

<script>
    function validateCompetitorUrl() {
        const urlField = document.getElementById('competitorUrl');
        const errorMsg = document.getElementById('urlErrorMsg');
        const urlValue = urlField.value;

        // Updated regex to ensure valid domain structure and TLD, and no path after the domain
        const regex = /^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/)?$/;

        if (!regex.test(urlValue)) {
            urlField.classList.add('is-invalid');
            errorMsg.style.display = 'block';
            return false;
        } else {
            urlField.classList.remove('is-invalid');
            errorMsg.style.display = 'none';
            return true;
        }
    }

    function handleCompetitorFormSubmit() {
        // Validate URL first
        const isValid = validateCompetitorUrl();

        if (!isValid) {
            return false;
        }

        // Show loader if the URL is valid
        document.getElementById('loader').style.display = 'block';
        return true; // Allow form to be submitted
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set timeout to remove alerts after 3 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.classList.remove('show');
                alert.classList.add('fade');
            });
        }, 3000); // 3 seconds
    });
</script>
@endsection
@push('script')
<script src="{{ asset_url('libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>
@endpush