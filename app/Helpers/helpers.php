<?php

/**
 * Helper function untuk convert angka jadi terbilang (dalam bahasa Indonesia)
 *
 * @param int $angka - Angka yang mau diconvert
 * @return string - Angka dalam format terbilang
 *
 * Contoh:
 * terbilang(500000) => "Lima Ratus Ribu"
 * terbilang(1250000) => "Satu Juta Dua Ratus Lima Puluh Ribu"
 */
if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        // Array untuk mapping angka ke kata
        // Index array = nilai angka
        $angka_array = [
            '',           // 0
            'Satu',       // 1
            'Dua',        // 2
            'Tiga',       // 3
            'Empat',      // 4
            'Lima',       // 5
            'Enam',       // 6
            'Tujuh',      // 7
            'Delapan',    // 8
            'Sembilan',   // 9
            'Sepuluh',    // 10
            'Sebelas'     // 11
        ];

        // Base case: angka kurang dari 12
        // Langsung return dari array
        if ($angka < 12) {
            return $angka_array[$angka];
        }

        // Angka 12-19 (belasan)
        // Contoh: 15 = "Lima Belas"
        elseif ($angka < 20) {
            // $angka - 10 = ambil digit satuan
            // Misal: 15 - 10 = 5, lalu ambil kata "Lima"
            return terbilang($angka - 10) . ' Belas';
        }

        // Angka 20-99 (puluhan)
        // Contoh: 45 = "Empat Puluh Lima"
        elseif ($angka < 100) {
            // floor($angka / 10) = ambil digit puluhan
            // $angka % 10 = ambil digit satuan
            // Misal: 45 => floor(45/10)=4, 45%10=5
            return terbilang(floor($angka / 10)) . ' Puluh ' . terbilang($angka % 10);
        }

        // Angka 100-199 (seratus-an)
        // Contoh: 150 = "Seratus Lima Puluh"
        elseif ($angka < 200) {
            return 'Seratus ' . terbilang($angka - 100);
        }

        // Angka 200-999 (ratusan)
        // Contoh: 500 = "Lima Ratus"
        elseif ($angka < 1000) {
            return terbilang(floor($angka / 100)) . ' Ratus ' . terbilang($angka % 100);
        }

        // Angka 1000-1999 (seribu-an)
        // Contoh: 1500 = "Seribu Lima Ratus"
        elseif ($angka < 2000) {
            return 'Seribu ' . terbilang($angka - 1000);
        }

        // Angka 2000-999999 (ribuan)
        // Contoh: 25000 = "Dua Puluh Lima Ribu"
        elseif ($angka < 1000000) {
            return terbilang(floor($angka / 1000)) . ' Ribu ' . terbilang($angka % 1000);
        }

        // Angka 1000000-999999999 (jutaan)
        // Contoh: 2500000 = "Dua Juta Lima Ratus Ribu"
        elseif ($angka < 1000000000) {
            return terbilang(floor($angka / 1000000)) . ' Juta ' . terbilang($angka % 1000000);
        }

        // Angka 1 milyar ke atas
        // Contoh: 1500000000 = "Satu Milyar Lima Ratus Juta"
        else {
            return terbilang(floor($angka / 1000000000)) . ' Milyar ' . terbilang($angka % 1000000000);
        }
    }
}
