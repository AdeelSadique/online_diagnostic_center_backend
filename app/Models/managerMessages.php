<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\managers;
use App\models\patients;

class managerMessages extends Model
{
    use HasFactory;
    protected $table = 'manager_messages';
    protected $primaryKey = 'mm_id';

    protected $with = ['manager','patient'];
    function patient()  {
        return $this->belongsTo(patients::class, 'p_id','p_id');
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
