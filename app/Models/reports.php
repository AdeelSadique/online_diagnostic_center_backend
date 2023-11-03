<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\appointments;
use App\models\managers;

class reports extends Model
{
    use HasFactory;


    protected $table = 'reports';
    protected $primaryKey = 'r_id';

        protected $with = ['appointment','manager'];
        function appointment()  {
            return $this->belongsTo(appointments::class, 'ap_id','ap_id');
        }
        function manager()  {
            return $this->belongsTo(managers::class, 'm_id','m_id');
        }


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