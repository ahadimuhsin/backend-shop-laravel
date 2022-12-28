<?php

use Carbon\Carbon;

if(! function_exists('moneyFormat')){
    function moneyFormat($str)
    {
        return 'Rp. '.number_format($str, '0', '', '.');
    }
}

if(! function_exists('tanggalIndonesia'))
{
    function tanggalIndonesia($tanggal)
    {
        $value = Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('l, d F Y');
    }
}

?>
