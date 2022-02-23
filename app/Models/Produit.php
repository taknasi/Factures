<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];
    
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
