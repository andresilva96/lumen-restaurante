<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'description', 'photo', 'user_id'];
    protected $appends = ['photo_full_url'];

    protected function getPhotoFullUrlAttribute()
    {
        if ($this->attributes['photo']) {
            return 'https://s3-'.env('AWS_REGION').'.amazonaws.com/'.env('AWS_BUCKET').'/restaurant/'.$this->attributes['photo'];
        }

        return null;
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function address()
    {
        return $this->hasOne('\App\Address');
    }
}