<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminMessages extends Model
{
    use HasFactory;
    protected $table = 'admin_messages';
protected $primaryKey = 'am_id';



    //date format functions

    public function getCreatedAtAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
    public function getUpdatedAtAttribute($dob) {
        $dateFormatted = date('d-M-Y',strtotime($dob));
        return $dateFormatted;
    }
}