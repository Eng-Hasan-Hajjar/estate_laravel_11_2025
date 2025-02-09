<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','user_id', 'description', 'price','currency', 'location', 'area', 'num_bedrooms',
         'num_bathrooms', 'status', 'directions', 'num_balconies', 'is_furnished',
         'property_type_id', 'region_id'
    ];

 
    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function mainImage()
{
    return $this->hasOne(PropertyImage::class)->where('is_primary', 1);
}


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

}
