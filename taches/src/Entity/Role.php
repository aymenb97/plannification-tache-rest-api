<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;

class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     *  @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="roles")
     *
     */
    private $users;

    public function __construct()
    {

        $this->users = new ArrayCollection();
    }


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","role:write","role:read"})
     */
    private $roleLib;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleLib(): ?string
    {

        return $this->roleLib;
    }

    public function setRoleLib(string $roleLib): self
    {
        $this->roleLib = $roleLib;

        return $this;
    }
    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
}
