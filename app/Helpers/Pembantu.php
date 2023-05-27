<?php

use Illuminate\Support\Carbon;

class Pembantu
{
    public static function mask($angka)
    {
        $damask = number_format($angka, 0, ',', '.');
        return $damask;
    }
    public static function statusL($waktu)
    {
        $tahunLapor = $waktu + 1;
        $waktuLapor = $tahunLapor . "-02-26";
        $waktuLapor = strtotime($waktuLapor);
        $sekarang = strtotime(now());
        $jarak = $sekarang - $waktuLapor;

        $diff = now()->diffInDays(Carbon::parse($waktuLapor));

        if ($jarak < 0) {
            return "Status LHP : Open ( $diff hari )";
        } else {
            return "Status LHP : Close ( lewat $diff hari)";
        }
    }

    public static function statusLD($waktu)
    {
        $tahunLapor = $waktu + 1;
        $waktuLapor = $tahunLapor . "-02-26";
        $waktuLapor = strtotime($waktuLapor);
        $sekarang = strtotime(now());
        $jarak = $sekarang - $waktuLapor;

        $diff = now()->diffInDays(Carbon::parse($waktuLapor));

        if ($jarak < 0) {
            return "Status Input/Update Data : Open ( $diff hari kedepan )";
        } else {
            return "Status Input/Update Data : Close ( $diff hari yang lalu)";
        }
    }

    public static function status($waktu)
    {
        $tahunLapor = $waktu + 1;
        $waktuLapor = $tahunLapor . "-02-26";
        $waktuLapor = strtotime($waktuLapor);
        $sekarang = strtotime(now());
        $jarak = $sekarang - $waktuLapor;

        $diff = now()->diffInDays(Carbon::parse($waktuLapor));

        if ($jarak < 0) {
            return "open";
        } else {
            return "close";
        }
    }
}
