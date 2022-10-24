<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Maatwebsite\Excel\Sheet;

class PHPExcelMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Sheet::macro('setTop', function (Sheet $sheet, $range,  $style) {
        //     $sheet->getDelegate()->getStyle($range)->getBorders()->getTop()->setBorderStyle($style);
        // });
    }
}
