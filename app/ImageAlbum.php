<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ImageAlbum extends Model
{
    // images

    public function images()
    {
        return $this->hasMany(Image::class, 'album_id');
    }
}
