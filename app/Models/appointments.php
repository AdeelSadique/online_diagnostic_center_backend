<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\appointments;
use App\models\tests;
use App\models\managers;




class appointments extends Model
{
    use HasFactory;
    protected $table = 'appointments';
protected $primaryKey = 'ap_id';


    protected $with = ['patient','test','manager'];
    function patient()  {
        return $this->belongsTo(patients::class, 'p_id','p_id');
    }
    function test()  {
        return $this->belongsTo(tests::class, 't_id','t_id');
    }
    function manager()  {
        return $this->belongsTo(managers::class, 'm_id','m_id');
    }






    //date format functions
    public function getApDateAttribute($date) {
        $dateFormatted = date('d-M-Y',strtotime($date));
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
