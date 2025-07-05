<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\BarcodeService;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'ticket_code', 'barcode_url', 'is_verified'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function generateBarcode(): void
    {
        $barcodeUrl = BarcodeService::generateBarcodeUrl($this->ticket_code);

        if ($barcodeUrl) {
            $this->update(['barcode_url' => $barcodeUrl]);
        }
    }


    public function getBarcodeUrl(): ?string
    {
        if (!$this->barcode_url) {
            $this->generateBarcode();
        }

        return $this->barcode_url;
    }


    public function getQRCodeUrl(): ?string
    {
        return BarcodeService::generateQRCodeUrl($this->ticket_code);
    }
}
