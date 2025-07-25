<?php

namespace App\Helpers;

use App\Models\Setting;

class TravelCostHelper
{
    /**
     * Hitung biaya perjalanan berdasarkan koordinat user dan bengkel
     */
    public static function hitungBiayaPerjalanan($userLat, $userLng)
    {
        // Ambil koordinat bengkel dari setting
        $bengkelCoordinates = Setting::where('key', 'bengkel_longlat')->first();
        $bengkelLongLat = $bengkelCoordinates ? explode(',', $bengkelCoordinates->value) : ['106.8', '-6.2'];
        
        $bengkelLng = (float) ($bengkelLongLat[0] ?? 106.8);
        $bengkelLat = (float) ($bengkelLongLat[1] ?? -6.2);
        
        // Ambil tarif per km dari setting
        $tarifSetting = Setting::where('key', 'tarif_per_km')->first();
        $tarif = $tarifSetting ? (float) $tarifSetting->value : 5000;
        
        // Hitung jarak
        $jarak = self::hitungJarak($userLat, $userLng, $bengkelLat, $bengkelLng);
        
        // Hitung biaya (pembulatan ke atas untuk jarak)
        $biaya = ceil($jarak) * $tarif;
        
        return [
            'jarak' => $jarak,
            'biaya' => $biaya,
            'tarif_per_km' => $tarif,
            'bengkel_lat' => $bengkelLat,
            'bengkel_lng' => $bengkelLng
        ];
    }
    
    /**
     * Hitung jarak antara dua koordinat menggunakan formula Haversine
     */
    public static function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371; // Radius bumi dalam kilometer
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return $R * $c;
    }
}
