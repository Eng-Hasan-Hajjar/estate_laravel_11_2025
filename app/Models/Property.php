<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','user_id', 'description', 'price', 'type', 'location', 'area', 'num_bedrooms', 'num_bathrooms', 'status'
    ];

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mainImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    
}
