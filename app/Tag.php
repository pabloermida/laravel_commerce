<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany('CodeCommerce\Product');
    }

    public function saveTags($tags)
    {
        $tags = array_unique(array_map(function ($str) {
            //For every tag in the array
            //Remove white spaces and set to lowercase with first char upper
            return ucwords(strtolower(preg_replace('/\s+/', ' ', trim($str))));
        },
            explode(',', $tags)));

        $tagIds = [];
        foreach ($tags as $tag){
            array_push($tagIds, $this->firstOrCreate(['name' => $tag])->id);
        }
        return $tagIds;
    }

}
