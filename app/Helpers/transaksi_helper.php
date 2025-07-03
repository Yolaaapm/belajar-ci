<?php

function hitung_ppn($total)
{
    return $total * 0.11;
}

function hitung_biaya_admin($total)
{
    if ($total <= 20000000) {
        return $total * 0.006;
    } elseif ($total <= 40000000) {
        return $total * 0.008;
    } elseif ($total > 40000000) {
        return $total * 0.01;
    } else {
        return 0; // misalnya fallback
    }
}
