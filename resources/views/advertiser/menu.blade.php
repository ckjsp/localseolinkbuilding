@extends('layouts.app')

@section('content')
<!-- Menu -->
<style>
    #hover-dropdown-demo .dropdown-toggle:hover ~ .dropdown-menu{ display: block;position: absolute;top: 100%;
 }
</style>

<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner {{ (isset($slug) && $slug == 'marketplace') ? 'my-2' : '' }}">
            <!-- Dashboards -->
            <li class="menu-item {{ (!isset($slug) || $slug == '' || $slug == 'dashboard') ? 'active' : '' }}">
                <a href="{{ route('advertiser') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboards">Dashboards</div>
                </a>
            </li>

            <!-- Project List -->
            <li id="hover-dropdown-demo" class="menu-item {{ (isset($slug) && $slug == 'projects') ? 'active' : '' }} dropdown">
                <a href="#" type="button" class="dropdown-toggle menu-link" data-bs-toggle="dropdown" data-trigger="hover" aria-expanded="false">
                    <div data-i18n="Projects">Projects</div>
                </a>
                <ul class="dropdown-menu" id="projects-menu">
                    <!-- Project items will be dynamically added here -->
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
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        if ($('#projects-menu').children().length === 0) {
            $.ajax({
                url: "{{ route('advertiser.menu') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Add the CSRF token to the request headers
                },
                success: function(response) {
                    var projectsMenu = $('#projects-menu');
                    projectsMenu.empty(); // Clear any existing content

                    $.each(response.data, function(index, project) {
                        var projectItem = '<li class="menu-item"><a class="menu-link" href="/projects/' + project.id + '">' + project.project_name + '</a></li>';
                        projectsMenu.append(projectItem);
                    });
                },
                error: function(xhr) {
                    console.error('Error fetching projects:', xhr);
                }
            });
        }
    });
</script>
@endpush