@extends('layouts.app')

@section('content')
<!-- Menu -->
<style>
    #hover-dropdown-demo .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
    }

    #hover-dropdown-demo .dropdown-toggle {
        cursor: pointer;
    }

    #hover-dropdown-demo .dropdown-toggle.active+.dropdown-menu {
        display: block;
    }

    .menu-horizontal-wrapper,
    .menu-horizontal .menu-inner {
        overflow: visible;
    }

    .edit-btn-project {
        box-shadow: none !important;
    }

    #hover-dropdown-demo {
        min-width: 140px;
        max-width: 160px;
    }

    #hover-dropdown-demo>div>div {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #projects-menu {
        width: 390px;
    }

    .shepherd-header {
        display: none !important;
    }
</style>

<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex">
        <ul class="menu-inner {{ (isset($slug) && $slug == 'marketplace') ? 'my-2' : '' }}">
            <!-- Dashboards -->
            <li class="menu-item {{ (!isset($slug) || $slug == '' || $slug == 'dashboard') ? 'active' : '' }}">
                <a href="{{ route('advertiser') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboards">Dashboards</div>
                </a>
            </li>

            <!-- Project List -->
            <li id="hover-dropdown-demo"
                class="menu-item {{ (isset($slug) && $slug == 'projects') ? 'active' : '' }} dropdown">
                <div type="" class="dropdown-toggle menu-link active" aria-expanded="false">
                    <div data-i18n="Projects">Projects</div>
                </div>
                <ul class="dropdown-menu p-2" id="projects-menu" style="display: none;">
                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop"
                            id="addprojectBtn" class="btn btn-primary w-auto">+Add Projects
                        </a></li>
                </ul>
            </li>

            <!-- Market Place -->
            <li class="menu-item {{ (isset($slug) && $slug == 'marketplace') ? 'active' : '' }}">
                <a href="{{ route('advertiser.marketplace') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-briefcase"></i>
                    <div data-i18n="Marketplace">Marketplace</div>
                </a>
            </li>

            <!-- My Order -->
            <li class="menu-item {{ (isset($slug) && $slug == 'orders') ? 'active' : '' }}">
                <a href="{{ route('advertiser.orders') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-briefcase"></i>
                    <div data-i18n="My Orders">My Orders</div>
                </a>
            </li>

            <!-- Payment -->
            <li class="menu-item {{ (isset($slug) && $slug == 'payment') ? 'active' : '' }}">
                <a href="{{ route('advertiser.payment') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-wallet"></i>
                    <div data-i18n="Payments">Payments</div>
                </a>
            </li>
        </ul>
    </div>
</aside>


<!-- / Menu -->

@yield('sidebar-content')
@include('advertiser.partials.createprojectmodal')
@endsection
@push('script')
<script>
    $('#projectCategories').select2();
    $('#projectForbiddenCategories').select2();
</script>
<script>
    $(document).ready(function() {


        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var projectsMenu = $('#projects-menu');

        loadProjectsMenu();

        $(document).on('click', '#projects-menu .menu-link', function(e) {
            e.preventDefault();
            var projectId = $(this).data('project-id');

            $.ajax({
                url: "{{ route('advertiser.project.name') }}",
                method: 'GET',
                data: {
                    id: projectId
                },
                success: function(response) {
                    console.log('project name', response);
                    if (response.success) {
                        $('#selected-project-name').text(response.project_name);
                        $('#hover-dropdown-demo .dropdown-toggle div').text(response.project_name);
                        $.ajax({
                            url: "{{ route('advertiser.set.selected.project') }}",
                            method: 'POST',
                            data: {
                                _token: csrfToken,
                                selected_project_id: projectId
                            },
                            success: function(res) {
                                console.log('Selected project ID stored in session');

                                window.location.reload();

                            },
                            error: function(xhr) {
                                console.error('Error storing selected project ID:', xhr);
                            }
                        });
                    } else {
                        console.error('Error retrieving project name:', response.error);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching project name:', xhr);
                }
            });
        });

        $('#hover-dropdown-demo .dropdown-toggle').on('click', function(e) {
            var projectsMenu = $('#projects-menu');
            projectsMenu.toggle();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#hover-dropdown-demo').length) {
                $('#hover-dropdown-demo .dropdown-toggle').removeClass('active');
                $('#hover-dropdown-demo .dropdown-menu').hide();
            }
        });

        $(document).on('click', '.edit-btn-project', function() {
            var projectId = $(this).data('project-id');
            var editUrl = `{{ route('advertiser.projects.edit', ':id') }}`.replace(':id', projectId);

            $.ajax({
                url: editUrl,
                type: 'GET',
                success: function(data) {
                    $('#project_id').val(data.id);
                    $('#project_name').val(data.project_name);
                    $('#project_url').val(data.project_url);
                    $('#projectCategories').val(data.categories).trigger('change');
                    $('#projectForbiddenCategories').val(data.forbidden_category).trigger('change');
                    $('#additional_note').val(data.additional_note);
                    $('#project-form').attr('action', `{{ route('advertiser.projects.update', ':id') }}`.replace(':id', projectId));


                    $('#project_name').attr('readonly', !!data.project_name);
                    $('#project_url').attr('readonly', !!data.project_url);

                    $('#project-form').find('input[name="_method"]').remove();
                    $('#project-form').append('<input type="hidden" name="_method" value="PUT">');

                    $('#add-projects-pop').modal('show');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $(document).on('hidden.bs.modal', '#add-projects-pop', function() {
            resetProjectForm();
        });

        function resetProjectForm() {
            $('#project_id').val('');
            $('#project_name').val('').removeAttr('readonly');
            $('#project_url').val('').removeAttr('readonly');
            $('#projectCategories').val('').trigger('change');
            $('#projectForbiddenCategories').val('').trigger('change');
            $('#additional_note').val('');
            $('#project-form').find('input[name="_method"]').remove();
            $('#project-form').attr('action', '');
            $('#add-projects-pop .modal-title').text('{{ __("Add Project Details") }}');
        }


        $(document).on('click', '.delete-btn', function() {
            var projectId = $(this).data('project-id');
            var deleteUrl = `{{ route('advertiser.delete', ':id') }}`.replace(':id', projectId);
            if (confirm('Are you sure you want to delete this project?')) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $(`[data-project-id="${projectId}"]`).closest('li').remove();
                        $(`#project-card-${projectId}`).remove();

                        if ($('li.project-menu-list').length === 0) {
                            localStorage.removeItem('project_tour_completed');
                            var emptyProject = `<div class="row text-center justify-content-center empty-container"><img src="{{ asset('img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;"><h5>Unlock High-Quality Backlinks and Boost<br /> Traffic with a New Project</h5><p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest posting campaigns.</p><a href="javascript:void(0)" data-bs-toggle="modal"  data-bs-target="#add-projects-pop" id="addprojectBtn" class="btn btn-primary w-auto">+Add Projects</a></div>`;
                            $('.project_details').html(emptyProject);
                        } else if (response.clearLocalStorage) {
                            localStorage.removeItem('project_tour_completed');
                            var emptyProject = `<div class="row text-center justify-content-center empty-container"><img src="{{ asset('img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;"><h5>Unlock High-Quality Backlinks and Boost<br /> Traffic with a New Project</h5><p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest posting campaigns.</p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn" class="btn btn-primary w-auto">+Add Projects</a></div>`;
                            $('.project_details').html(emptyProject);
                        }
                        loadProjectsMenu();

                        $('#selected-project-name').text('Select a project');
                        $('#hover-dropdown-demo .dropdown-toggle div').text('Projects');
                        alert('Project deleted successfully.');
                    },
                    error: function(xhr) {
                        alert('Failed to delete the project.');
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $(document).on('click', '#addprojectBtn', function() {
            $('#project-form')[0].reset();
            $('input[name="project_id"]').val('');
            $('#projectCategories').val(null).trigger('change');
            $('#projectForbiddenCategories').val(null).trigger('change');
            $('#project-form').attr('action', `{{ route('advertiser.projects.store') }}`);
        });

        $(document).on('submit', '#project-form', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 1) {
                        var success = response.message;
                        $('#project-form').prev('.alert.alert-danger').remove();
                        $('#add-projects-pop').modal('hide');
                        var projects = response.projects;
                        console.log('projects', projects);
                        var projectsHtml = '';
                        projects.forEach(function(project) {
                            projectsHtml = `
                        <div class="row mb-3 step-4" id="project-card-${project.id}">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">${project.project_name}</h5>
                                    <div class="d-flex gap-3">
                                        <p class="card-text"> ${project.project_url}</p>
                                        <span> ${project.created_at} </span>
                                    </div>
                                </div>
                                <hr />
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-md-3 border rounded p-4 pb-0 bg-light">
                                            <div>
                                                <p>Total Backlinks built from LP</p>
                                                <h4>0</h4>
                                            </div>
                                            <div>
                                                <p>Total Paid</p>
                                                <h4>$0</h4>
                                            </div>
                                            <div>
                                                <p>Total Content Written</p>
                                                <h4>0</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center border rounded">
                                            <img src="{{ asset_url('img/pages/search-icon.png') }}"
                                                style="max-width: 100px;height: fit-content;">
                                            <p>Data is being prepared and will be presented here once it is ready.</p>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center width-calc">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#" id="addcompetitorBtn"
                                                class="btn btn-primary w-auto step-5">+Add Competitors
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        });
                        if ($('.step-3').length > 0) {
                            // Append new projects to #projects-container
                            $('#projects-container').append(projectsHtml);
                        } else {
                            $('.empty-container').remove();
                            var step3Html = `
                        <div class="d-flex justify-content-between my-3 step-3">
                            <h5 class="card-title" id="selected-project-name">Select a project</h5>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn" class="btn btn-primary w-auto">+Add Projects</a>
                        </div>
                        <div id="projects-container">
                            ${projectsHtml}
                        </div>`;

                            // Insert step-3 and projects-container into the parent element
                            $('.project_details').append(step3Html);
                        }
                        //$('#projects-container').html(projectsHtml);
                        loadProjectsMenu();
                        toastr.success(success, 'Success!', {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            onHidden: function() {
                                if (!localStorage.getItem('project_tour_completed')) {
                                    startProjectTour();
                                }
                            }
                        });
                    } else if (response.status == 0) {
                        var errors = response.message;
                        var errorHtml = '<div class="alert alert-danger">';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var errorMessages = errors[key];
                                errorMessages.forEach(function(message) {
                                    errorHtml += '<ul class="m-0"><li>' + message + '</li></ul>';
                                });
                            }
                        }
                        errorHtml += '</div>';
                        $('#project-form').before(errorHtml);
                        setTimeout(function() {
                            $('#project-form').prev('.alert.alert-danger').remove();
                        }, 2500);
                    }
                },
                error: function(xhr) {
                    console.log('xhr', xhr);
                    if (xhr.responseJSON) {
                        var response = xhr.responseJSON;
                        console.log('responseJSON', response);
                        if (response.status === '0') {
                            var errors = response.errors;
                            var errorHtml = '<div class="alert alert-danger">';

                            // Loop through each error and append it to the errorHtml string
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorMessages = errors[key];
                                    errorMessages.forEach(function(message) {
                                        errorMessages.forEach(function(message) {
                                            errorHtml += '<ul class="m-0"><li>' + message + '</li></ul>';
                                        });
                                    });

                                }
                            }
                            errorHtml += '</div>';
                            $('#project-form').before(errorHtml);
                            setTimeout(function() {
                                $('#project-form').prev('.alert.alert-danger').remove();
                            }, 2500);
                        } else {
                            console.log("Error: responseJSON is undefined");
                        }
                    } else {
                        console.log("Error: responseJSON is undefined");
                    }
                }
            });
        });

        function startProjectTour() {
            const tourVar = new Shepherd.Tour({
                defaultStepOptions: {
                    scrollTo: false,
                    cancelIcon: {
                        enabled: true
                    }
                },
                useModalOverlay: true
            });

            const tour = setupTour(tourVar);
            tour.on('cancel', saveTourCookie);
            tour.on('complete', saveTourCookie);

            tour.start();
        }

        function setupTour(tour) {
            const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat',
                nextBtnClass = 'btn btn-sm btn-primary btn-next';
            tour.addStep({
                //title: 'Navbar',
                text: "Add Projects to check Which orders belong to </br>which client, stay organized, and effortlessly </br> keep track of progress and spending. It's straightforward! 🚀",
                attachTo: {
                    element: '#hover-dropdown-demo',
                    on: 'bottom'
                },
                buttons: [{
                        action: tour.cancel,
                        classes: backBtnClass,
                        text: 'Skip'
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next,
                    }
                ]
            });
            tour.addStep({
                //title: 'Card',
                text: 'Manage Projects seamlessly. Edit details or delete projects as needed.',
                attachTo: {
                    element: '#projects-menu',
                    on: 'right'
                },
                beforeShowPromise: function() {
                    return new Promise(function(resolve) {
                        setTimeout(function() {
                            const projectList = document.querySelector('#projects-menu');
                            if (projectList) {
                                projectList.style.display = 'block';
                            }
                            resolve();
                        }, 500);
                    });
                },
                buttons: [{
                        text: 'Skip',
                        classes: backBtnClass,
                        action: tour.cancel
                    },
                    {
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next
                    }
                ]
            });
            tour.addStep({
                //title: 'Footer',
                text: 'Add a project by filling in the Project Name and Project URL, then include categories',
                attachTo: {
                    element: '.step-3',
                    on: 'bottom'
                },
                buttons: [{
                        text: 'Skip',
                        classes: backBtnClass,
                        action: tour.cancel
                    },
                    {
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next
                    }
                ]
            });
            tour.addStep({
                //title: 'About US',
                text: 'Keep your budget in check by monitoring expenses. Track the amount spent on link-building for each specific order.',
                attachTo: {
                    element: '.step-4',
                    on: 'bottom'
                },
                buttons: [{
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next
                    }
                ]
            });
            tour.addStep({
                title: 'About US',
                text: 'Keep your budget in check by monitoring expenses. Track the amount spent on link-building for each specific order.',
                attachTo: {
                    element: '.step-5',
                    on: 'bottom'
                },
                buttons: [{
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Finish',
                        classes: nextBtnClass,
                        action: tour.cancel
                    }
                ]
            });

            return tour;
        }

        function saveTourCookie() {
            localStorage.setItem('project_tour_completed', 'true');
            window.location.reload();
        }

        $('#add-projects-pop').on('show.bs.modal', function() {
            $('#project-form').find('.invalid-feedback').remove();
            $('#project-form').find('.is-invalid').removeClass('is-invalid');
        });
    });
</script>
<script src="{{ asset_url('libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset_url('libs/shepherd/shepherd.js') }}"></script>
<script src=" {{ asset_url('libs/toastr/toastr.js') }}"></script>
<script src="{{ asset_url('js/projects.js') }}"></script>
@endpush