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

    public function getTagsToTextAttribute()
    {
        $arrTags = [];
        foreach ($this->tags as $tag) {
            $arrTags[] = $tag->name;
        }

        return implode(',', $arrTags);
    }

    public function destroyImages()
    {
        foreach ($this->images() as $image) {
            /*
            if (Storage::disk('s3')->exists($image->id . '.' . $image->extension)) {
                Storage::disk('s3')->delete($image->id . '.' . $image->extension);
            }
            */
            if (file_exists(public_path() . '/uploads/' . $image->id . '.' . $image->extension)) {
                Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
            }
        }
        return true;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured','=','1');
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend','=','1');
    }

    public function scopeOfCategory($query, $type)
    {
        return $query->where('category_id','=',$type);
    }
}
