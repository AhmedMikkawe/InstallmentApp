<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = [
        'installment_status',
        'receipt_photo',
        'value',
        'date'
        ];
    public function installment_request(){
        return $this->belongsTo(InstallmentRequest::class);
    }
}
