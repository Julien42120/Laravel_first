<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'title',
        'description',
        'size',
        'floor',
        'image',
        'room',
        'price',
        'address',
        'postcode',
        'city',
    ];
}
