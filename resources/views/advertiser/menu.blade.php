@extends('layouts.app')

@section('content')
<!-- Menu -->
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
            <li class="menu-item {{ (isset($slug) && $slug == 'projects') ? 'active' : '' }}">
                <a href="{{ route('advertiser.projects') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-briefcase"></i>
                    <div data-i18n="Projects">Projects</div>
                </a>
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