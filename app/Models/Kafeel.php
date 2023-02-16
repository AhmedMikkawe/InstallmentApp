<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kafeel extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'phone_number',
        'national_id',
        'national_id_photo'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
