<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class managers extends Model
{
    use HasFactory, HasApiTokens;



    protected $table = 'managers';
    protected $primaryKey = 'm_id';

    protected $fillable = ['name','email','m_contact','hospital_name','m_address','m_password','status'];




    public function getCreatedAtAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
    public function getUpdatedAtAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }

}
