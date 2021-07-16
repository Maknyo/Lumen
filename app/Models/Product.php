<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Product extends Model
{
    protected $table = 'msproduct';
    public $timestamps = false;

    public function type() {
        return $this->belongsTo(MsType::class, 'typeid');
    }
}