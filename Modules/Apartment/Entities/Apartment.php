<?php

namespace Modules\Apartment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Apartment\Database\Factories\ApartmentFactory;

class Apartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ApartmentFactory
    // {
    //     // return ApartmentFactory::new();
    // }
}
