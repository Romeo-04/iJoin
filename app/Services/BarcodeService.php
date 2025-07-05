<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BarcodeService
{
    /**
     * Generate a barcode URL using an online barcode generator API
     * 
     * @param string $ticketCode
     * @return string|null
     */
    public static function generateBarcodeUrl(string $ticketCode): ?string
    {
        try {
            // Using QuickChart.io (recommended - free and reliable)
            $barcodeUrl = "https://quickchart.io/barcode?type=code128&text=" . urlencode($ticketCode) . "&width=400&height=100";
            
            // Return the URL directly without HTTP verification to avoid blocking
            // The URL will be validated when the image is actually loaded in the browser
            return $barcodeUrl;
            
        } catch (\Exception $e) {
            Log::error('Error generating barcode: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Generate a QR code URL (alternative option)
     * 
     * @param string $ticketCode
     * @return string|null
     */
    public static function generateQRCodeUrl(string $ticketCode): ?string
    {
        try {
            // Using QuickChart.io QR code generator
            $qrUrl = "https://quickchart.io/qr?text=" . urlencode($ticketCode) . "&size=200";
            
            // Return the URL directly without HTTP verification
            return $qrUrl;
            
        } catch (\Exception $e) {
            Log::error('Error generating QR code: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Generate both barcode and QR code URLs
     * 
     * @param string $ticketCode
     * @return array
     */
    public static function generateBothCodes(string $ticketCode): array
    {
        return [
            'barcode_url' => self::generateBarcodeUrl($ticketCode),
            'qr_code_url' => self::generateQRCodeUrl($ticketCode)
        ];
    }
}
