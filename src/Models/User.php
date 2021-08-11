<?php


namespace SONFin\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Mass Assignment
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];
}
