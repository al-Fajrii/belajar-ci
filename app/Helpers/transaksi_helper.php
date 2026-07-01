<?php

if (!function_exists('hitung_ppn')) {
    /**
     * Menghitung PPN 12% dari total harga pembelian (tidak termasuk ongkir).
     *
     * @param int|float $total_harga
     * @return int
     */
    function hitung_ppn($total_harga): int
    {
        return (int) ($total_harga * 0.12);
    }
}

if (!function_exists('hitung_biaya_admin')) {
    /**
     * Menghitung biaya admin berjenjang berdasarkan total harga pembelian.
     *
     * - <= Rp 15.000.000          : 0.5%
     * - Rp 15.000.001 - 35.000.000 : 0.7%
     * - > Rp 35.000.000            : 0.9%
     *
     * @param int|float $total_harga
     * @return int
     */
    function hitung_biaya_admin($total_harga): int
    {
        if ($total_harga <= 15_000_000) {
            $tarif = 0.005;
        } elseif ($total_harga <= 35_000_000) {
            $tarif = 0.007;
        } else {
            $tarif = 0.009;
        }

        return (int) ($total_harga * $tarif);
    }
}

if (!function_exists('hitung_diskon_kupon')) {
    /**
     * Menghitung diskon berdasarkan kode kupon.
     * Diskon dihitung dari total harga pembelian (sebelum PPN dan biaya admin).
     *
     * Kode kupon yang valid:
     * - HEMAT20  : 20%
     * - HEMAT30  : 30%
     * - MEMBER25 : 25%
     *
     * @param int|float $total_harga
     * @param string    $kupon_code
     * @return int
     */
    function hitung_diskon_kupon($total_harga, string $kupon_code): int
    {
        $kupon = [
            'HEMAT20'  => 0.20,
            'HEMAT30'  => 0.30,
            'MEMBER25' => 0.25,
        ];

        $kode = strtoupper(trim($kupon_code));

        if (!isset($kupon[$kode])) {
            return 0;
        }

        return (int) ($total_harga * $kupon[$kode]);
    }
}
