<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class admins extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'admins';
    protected $primaryKey = 'a_id';


    public function getADobAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
    public function getCreatedAtAttribute($value) {
        $dateFormatted = date('d-M-Y',strtotime($value));
        return $dateFormatted;
    }
    public function getUpdatedAtAttribute($value) {
        $dateFormatted = date('d-M-Y',strtotime($value));
        return $dateFormatted;
    }
}