<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @package App
 * @property string $name
*/
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    
    
    
}
