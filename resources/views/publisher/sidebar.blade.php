@extends('layouts.app')

@section('content')
<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('publisher') }}" class="app-brand-link">
            <img src="{{ asset_url('img/favicon.svg') }}" alt="Logo" class="w-60 small-logo">
            <img src="{{ asset_url('img/header-logo.png') }}" alt="Logo" class="w-100 full-logo">
        </a>

        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a> -->
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ (isset($slug) && $slug == 'dashboard') ? 'active' : '' }}">
            <a href="{{ url('/publisher') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <!-- My Websites -->
        <li class="menu-item {{ (isset($slug) && $slug == 'websites') ? 'active' : '' }}">
            <a href="{{ url('/publisher/website') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-world"></i>
                <div data-i18n="My Websites">My Websites</div>
            </a>
        </li>

        <!-- Orders -->
        <li class="menu-item {{ (isset($slug) && $slug == 'orders') ? 'active' : '' }}">
            <a href="{{ url('/publisher/orders') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div data-i18n="My Orders">My Orders</div>
            </a>
        </li>

        <!-- Payments -->
        <li class="menu-item {{ (isset($slug) && $slug == 'payment') ? 'active' : '' }}">
            <a href="{{ url('/publisher/payment') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-wallet"></i>
                <div data-i18n="Payments">Payments</div>
            </a>
        </li>
        <li class="menu-item {{ (isset($slug) && $slug == 'wallet') ? 'active' : '' }}">
            <a href="{{ url('/publisher/wallet') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-wallet"></i>
                <div data-i18n="wallet">wallet</div>
            </a>
        </li>

        <!-- Wallet Balance -->
        <li class="menu-item {{ (isset($slug) && $slug == 'payment') ? 'active' : '' }}">
            <div class="wallet-balance text-center mt-4">
                <strong>Wallet Balance:</strong>
                <span class="text-success">${{ number_format($wallet_balance, 2) }}</span>
            </div>
        </li>


    </ul>
</aside>
<!-- / Menu -->
@yield('sidebar-content')
@endsection