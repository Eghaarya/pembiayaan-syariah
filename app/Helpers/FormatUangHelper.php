<?php

if (!function_exists('formatUangTanpaPembulatan')) {
    function formatUangTanpaPembulatan($angka)
    {
        if (!is_numeric($angka)) {
            return $angka;
        }

        // Pisahkan bagian bilangan bulat dan desimal
        $parts = explode('.', rtrim(rtrim((string) $angka, '0'), '.'));

        $ribuan = number_format($parts[0], 0, '', '.'); // Format ribuan

        if (isset($parts[1])) {
            return 'Rp ' . $ribuan . ',' . $parts[1]; // Tambahkan desimal apa adanya
        }

        return 'Rp ' . $ribuan; // Tanpa desimal
    }
}
