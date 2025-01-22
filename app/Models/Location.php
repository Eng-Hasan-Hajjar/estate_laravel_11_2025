<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // العلاقة مع العقارات
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    
}
