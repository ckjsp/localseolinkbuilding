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
                                //location.reload(); // Reload the page to show the selected project
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
            var projectId = $(this).data('project-id'); // Get the project ID from the button's data attribute
            var editUrl = `{{ route('advertiser.projects.edit', ':id') }}`.replace(':id', projectId);

            // Check if projectId exists
            if (projectId) {
                // Perform an AJAX request to get the project details
                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    success: function(data) {
                        // Populate form fields with project data
                        $('#project_id').val(data.id);
                        $('#project_name').val(data.project_name);
                        $('#project_url').val(data.project_url);
                        $('#projectCategories').val(data.categories).trigger('change');
                        $('#projectForbiddenCategories').val(data.forbidden_category).trigger('change');
                        $('#additional_note').val(data.additional_note);

                        // Update the form action for editing
                        $('#project-form').attr('action', `{{ route('advertiser.projects.update', ':id') }}`.replace(':id', projectId));
                        $('#project-form').find('input[name="_method"]').remove();
                        $('#project-form').append('<input type="hidden" name="_method" value="PUT">');

                        // Set the modal title for editing
                        $('#add-projects-pop .modal-title').text('{{ __("Edit Project Detail") }}');

                        // Show the modal
                        $('#add-projects-pop').modal('show');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });


        $(document).on('click', '.delete-btn', function() {
            var projectId = $(this).data('project-id');
            var deleteUrl = `{{ route('advertiser.delete', ':id') }}`.replace(':id', projectId);
            if (confirm('Are you sure you want to delete this project?')) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $(`[data-project-id="${projectId}"]`).closest('li').remove();
                        $(`#project-card-${projectId}`).remove();

                        if ($('li.project-menu-list').length === 0) {
                            localStorage.removeItem('project_tour_completed');
                            var emtyProject = `<div class="row text-center justify-content-center empty-container"><img src="{{ asset('img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;"><h5>Unlock High-Quality Backlinks and Boost<br /> Traffic with a New Project</h5><p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest posting campaigns.</p><a href="javascript:void(0)" data-bs-toggle="modal"  data-bs-target="#add-projects-pop" id="addprojectBtn" class="btn btn-primary w-auto">+Add Projects</a></div>`;
                            $('.project_details').html(emtyProject);
                        } else if (response.clearLocalStorage) {
                            localStorage.removeItem('project_tour_completed');
                            var emtyProject = `<div class="row text-center justify-content-center empty-container"><img src="{{ asset('img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;"><h5>Unlock High-Quality Backlinks and Boost<br /> Traffic with a New Project</h5><p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest posting campaigns.</p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn" class="btn btn-primary w-auto">+Add Projects</a></div>`;
                            $('.project_details').html(emtyProject);
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
@endpush