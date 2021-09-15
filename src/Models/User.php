<?php


namespace SONFin\Models;


use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser,UserInterface
{
    // Mass Assignment
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    public function getId(): int
    {
        return (int)$this->id;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getHashedPassword(): string
    {
        return $this->password;
    }

    public function onLogin()
    {
        // TODO: Implement onLogin() method.
    }

    public function onLogout()
    {
        // TODO: Implement onLogout() method.
    }

    public function getFullname(): string
    {
        return "{$this->firstname}  {$this->lastname}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
