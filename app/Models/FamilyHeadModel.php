<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHeadModel extends Model
{
    use HasFactory;
    // `id`, `name`, `surname`, `birthdate`, `mobile_no`, `address`, `stateId`, `cityId`, `marital_status`, `wedding_date`, `hobbies`, `photo`, `created_at`, `updated_at`
    //protect against unauthorized data manipulation
    protected $table    = "family_head_models";
    protected $fillable = ['name','surname','address','mobile_no','birthdate','stateId','cityId','marital_status','wedding_date','hobbies','photo'];
    protected $guarded  = ['id', 'created_at', 'updated_at'];
}
