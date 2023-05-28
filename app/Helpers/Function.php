<?php
function akun($data)
{
    if ($data >= 0 && $data <= 30) {
        $predikat = "SANGAT RENDAH";
    } elseif ($data > 30 && $data <= 55) {
        $predikat = "RENDAH";
    } elseif ($data > 55 && $data <= 75) {
        $predikat = "CUKUP";
    } elseif ($data > 75 && $data <= 90) {
        $predikat = "TINGGI";
    } elseif ($data > 90 && $data <= 100) {
        $predikat = "SANGAT TINGGI";
    } else {
        $predikat = '';
    }
    return $predikat;
}
