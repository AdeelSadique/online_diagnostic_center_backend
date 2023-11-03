<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class patients extends Model
{
    use HasFactory, HasApiTokens;



    protected $table = 'patients';
    protected $primaryKey = 'p_id';
    protected $fillable = ['name','email','p_contact','p_address','p_password','p_gender','p_dob','p_blood'];

    public function getPDobAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
    public function getCreatedAtAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
    public function getUpdatedAtAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
}
