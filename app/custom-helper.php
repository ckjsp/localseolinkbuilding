<?php

if (!function_exists('base_url')) {
    function base_url($mainSlug = null)
    {
        // $base_url = env('APP_URL');
        $base_url = url('/');
        $slug = (config('app.locale') == 'en') ? '' : '/' . config('app.locale');
        if ($mainSlug != null && $mainSlug != '/') {
            return $base_url . $mainSlug . $slug;
        } else {
            return $base_url . $slug;
        }
    }
}

if (!function_exists('asset_url')) {
    function asset_url($mainSlug = null)
    {
        $base_url = env('APP_URL');
        if (env('APP_ENV') === 'local') {
            return $base_url . '/' . $mainSlug;
        } else {
            // return $base_url . '/public/' . $mainSlug;
            return $base_url . '/' . $mainSlug;
        }
        //return $base_url . '/' . $mainSlug;
    }
}

if (!function_exists('afterLangSlug')) {
    function afterLangSlug()
    {
        $urlArr = explode('/' . config('app.locale'), request()->fullUrl());
        if (isset($urlArr[1]) && !empty($urlArr[1]) && $urlArr[1] != '/') {
            return $urlArr[1];
        } else {
            return '';
        }
    }
}

if (!function_exists('afterBaseurlSlug')) {
    function afterBaseurlSlug()
    {
        $base_url = env('APP_URL');
        $urlArr = explode('/' . config('app.locale'), request()->fullUrl());
        $urlArr1 = explode($base_url, request()->fullUrl());

        if (isset($urlArr[1]) && !empty($urlArr[1]) && $urlArr[1] != '/') {
            $arr = explode('?', $urlArr[1]);
            return $arr[0];
        } elseif (isset($urlArr1[1]) && !empty($urlArr1[1]) && $urlArr1[1] != '/') {
            $arr = explode('?', $urlArr1[1]);
            return $arr[0];
        } else {
            return '';
        }
    }
}

if (!function_exists('slugify')) {
    function slugify($str)
    {
        $str = strtolower(trim($str));
        $str = preg_replace('/[^\w\s-]/', '', $str);
        $str = preg_replace('/[\s_-]+/', '-', $str);
        $str = preg_replace('/^-+|-+$/', '', $str);

        return $str;
    }
}

if (!function_exists('unslugify')) {
    function unslugify($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = preg_replace('/[\s_]+/', ' ', $str);
        return $str;
    }
}

if (!function_exists('checkBankImage')) {
    function checkBankImage($url)
    {
        return (file_exists($url)) ? $url : asset_url('images/favicon.png');
    }
}
