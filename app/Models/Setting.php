<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public static function get($key){
        $setting = self::where('key', $key)->first();
        if($setting){
            return $setting->value;
        }
        return null;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    public function scoopSiteName($query){
        return $query->where('key', 'site_name')->first();
    }
}
