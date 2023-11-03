<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\appointments;


class feedbacks extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $primaryKey = 'f_id';


        protected $with = ['appointment'];
        function appointment()  {
            return $this->belongsTo(appointments::class, 'ap_id','ap_id');
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
