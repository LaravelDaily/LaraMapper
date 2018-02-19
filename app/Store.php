<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

/**
 * Class Store
 *
 * @package App
 * @property string $city
 * @property string $name
 * @property text $description
 * @property string $address
 * @property integer $phone
*/
class Store extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['name', 'description', 'phone', 'address_address', 'address_latitude', 'address_longitude', 'city_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCityIdAttribute($input)
    {
        $this->attributes['city_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to string format
     * @param $input
     */
    public function setPhoneAttribute($input)
    {
        $this->attributes['phone'] = $input ? $input : null;
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_store')->withTrashed();
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }
}
