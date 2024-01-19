<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Core\Attributes\Table;
use Core\Attributes\TargetRepository;
use Core\Security\UserAuthentication;


#[TargetRepository(name: UserRepository::class)]
#[Table(name: "users")]
class User extends UserAuthentication
{
    protected int $id;
    protected string $username;
    protected string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


//TODO !! -> A REVOIR : Les interfaces objet permettent de créer du code qui spécifie quelles méthodes une classe
// doit implémenter, sans avoir à définir comment ces méthodes fonctionneront.
    public function getAuthenticator()
    {
        return $this->username;
    }


}