<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\managers;

class tests extends Model
{
    use HasFactory;
protected $table = 'tests';
protected $primaryKey = 't_id';
protected $fillable = ['t_name','t_category','t_price','t_location','reporting_time','m_id','t_status'];


    protected $with = ['manager'];
    function manager()  {
        return $this->belongsTo(managers::class, 'm_id','m_id');
    }
}