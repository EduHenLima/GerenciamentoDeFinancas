<?php


namespace SONFin\Models;


use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser
{
    // Mass Assignment
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];
    /**
     * @var mixed
     */
    private $id;
    /**
     * @var mixed
     */
    private $email;
    /**
     * @var mixed
     */
    private $password;

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
}
