<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'number',
        'complement',
        'cep',
        'birthdate'
    ];

    //A person has many contacts
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
