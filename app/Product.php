<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'featured', 'recommend'];

    public function category()
    {
        return $this->belongsTo('CodeCommerce\Category');
    }

    public function images()
    {
        return $this->hasMany('CodeCommerce\ProductImage');
    }

    public function tags()
    {
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    public function destroyImages()
    {
        foreach ($this->images() as $image) {
            if (Storage::disk('s3')->exists($image->id . '.' . $image->extension)) {
                Storage::disk('s3')->delete($image->id . '.' . $image->extension);
            }
        }
        return true;
    }
}
