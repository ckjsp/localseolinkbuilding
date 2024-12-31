<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbTransaction;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $wallet_balance = 0;

            if (Auth::check()) {
                $publisherId = Auth::user()->id;

                $totalCredit = lslbTransaction::where('publisher_id', $publisherId)
                    ->where('transaction_type', 'credit')
                    ->sum('amount');

                $totalDebit = lslbTransaction::where('publisher_id', $publisherId)
                    ->where('transaction_type', 'debit')
                    ->sum('amount');

                $wallet_balance = $totalCredit - $totalDebit;
            }

            $view->with('wallet_balance', $wallet_balance);
        });
    }
}
