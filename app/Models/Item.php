<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

}
