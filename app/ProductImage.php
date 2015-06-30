<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'extension'];

    public function product() {
        return $this->belongsTo('CodeCommerce\Product');
    }

    public function getLocationAttribute()
    {
        return Storage::disk('s3')->getDriver()->getAdapter()->getClient()->getObjectUrl(Config::get('filesystems.disks.s3.bucket'), $this->id . "." . $this->extension);
    }
}
