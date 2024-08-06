@extends('layouts.app')

@section('content')
<!-- Menu -->
<style>
    #hover-dropdown-demo .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
    }

    #hover-dropdown-demo .dropdown-toggle.active+.dropdown-menu {
        display: block;
    }

    .menu-horizontal-wrapper,
    .menu-horizontal .menu-inner {
        overflow: visible;
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
                <div type="button" class="dropdown-toggle menu-link active" aria-expanded="false">
                    <div data-i18n="Projects">Projects</div>
                </div>
                <ul class="dropdown-menu" id="projects-menu" style="display: none;">
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
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('advertiser.menu') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    var projectsMenu = $('#projects-menu');
                    projectsMenu.empty();
                    if (response.data.length > 0) {
                        var selectedProjectId = "{{ session('selected_project_id') }}";
                        var firstProject = response.data[0];
                        var selectedProject = selectedProjectId ? response.data.find(project => project.id == selectedProjectId) : firstProject;
                        var selectedProjectName = selectedProject ? selectedProject.project_name : firstProject.project_name;


                        //var selectedProjectName = firstProject.project_name;
                        $('#selected-project-name').text(selectedProjectName);
                        $('#hover-dropdown-demo .dropdown-toggle div').text(selectedProjectName);
                        $.each(response.data, function (index, project) {
                            var projectItem = '<li class="menu-item"><a class="menu-link" href="#" data-project-id="' + project.id + '">' + project.project_name + '</a></li>';
                            projectsMenu.append(projectItem);
                        });
                    }
                },
                error: function (xhr) {
                    console.error('Error fetching projects:', xhr);
                }
            });
            // project click event - update the selected project name
            $(document).on('click', '#projects-menu .menu-link', function (e) {
                e.preventDefault();
                var projectId = $(this).data('project-id');

                $.ajax({
                    url: "{{ route('advertiser.project.name') }}",
                    method: 'GET',
                    data: { id: projectId },
                    success: function (response) {
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
                                success: function (res) {
                                    console.log('Selected project ID stored in session');
                                    location.reload(); // Reload the page to show the selected project
                                },
                                error: function (xhr) {
                                    console.error('Error storing selected project ID:', xhr);
                                }
                            });
                        } else {
                            console.error('Error retrieving project name:', response.error);
                        }
                    },
                    error: function (xhr) {
                        console.error('Error fetching project name:', xhr);
                    }
                });
            });
            $('#hover-dropdown-demo .dropdown-toggle').on('click', function (e) {
                e.preventDefault(); // Prevent default link behavior
                $(this).toggleClass('active');
                $(this).next('.dropdown-menu').toggle();
            });

            // Close the dropdown if clicked outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('#hover-dropdown-demo').length) {
                    $('#hover-dropdown-demo .dropdown-toggle').removeClass('active');
                    $('#hover-dropdown-demo .dropdown-menu').hide();
                }
            });
        });
    </script>
@endpush