<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'location';
    protected $fillable = ['title','address','lat','long','phone_number','shortdescription','image','video_url'];

    protected $casts = [
        'title' => 'string',
        'address' => 'string',
        'lat' => 'string',
        'long' => 'string',
        'shortdescription' => 'string',
        'image' => 'string',
        'deleted_at' => 'timestamp',
    ];

    protected function castAttribute($key, $value)
    {
        if (! is_null($value)) {
            return parent::castAttribute($key, $value);
        }
        switch ($this->getCastType($key)) {
            case 'int':
            case 'integer':
            return (int) 0;
            case 'real':
            case 'float':
            case 'double':
            return (float) 0;
            case 'enum':
            return '';
            case 'string':
            return '';
            case 'bool':
            case 'boolean':
            return false;
            case 'object':
            case 'array':
            case 'json':
            return [];
            case 'collection':
            return new BaseCollection();
            case 'date':
            return $this->asDate('0000-00-00');
            case 'datetime':
            return $this->asDateTime('0000-00-00');
            case 'timestamp':
            return '';
            default:
            return $value;
        }
    }

    public function LocationImagesList()
    {
        return $this->hasMany('App\Models\LocationImage','location_id','id');
    }
}
