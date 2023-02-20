<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'required_device',
        'request_status',
        'request_type',
        'installment_value',
        'installment_count',
        'total',
        'user_id'];
    public function installments(){
        return $this->hasMany(Installment::class);
    }
}
