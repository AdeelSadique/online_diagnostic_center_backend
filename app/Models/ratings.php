<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\patients;
use App\models\tests;
use App\models\appointments;

class ratings extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $primaryKey = 'r_id';


        protected $with = ['patient','test','appointment'];
        function patient()  {
            return $this->belongsTo(patients::class, 'p_id','p_id');
        }
        function test()  {
            return $this->belongsTo(tests::class, 't_id','t_id');
        }
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
