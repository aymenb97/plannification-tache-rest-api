<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER') or is_granted('ROLE_MEMBER')",
 *          },
 *          "put"={"security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER') or is_granted('ROLE_MEMBER')"},
 *          "delete"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     normalizationContext={"groups"={"user:read","projet"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 *
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read","projet"})
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     *
     * @Groups({"user:write","user:read"})
     */
    private $roles=[];


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read","user:write","projet"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read","user:write","projet"})
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"user:read","user:write"})
     * @Assert\Email
     */
    private $email;

    /**
     *  @ORM\OneToMany(targetEntity="App\Entity\Tache", mappedBy="membreEquipe")
     *  @Groups({"user:read","user:write"})
     *
     */
    private $taches;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Groups({"user:read","user:write"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read","user:write"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:write"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="admin")
     */
    private $adminProjet;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="chefDeProjet")
     */
    private $chefProjet;

    /**
     * @Groups({"user:write"})
     * @SerializedName("password")
     */
    private $plainPassword;



    public function __construct()
    {
        $this->adminProjet= new ArrayCollection();
        $this->taches = new ArrayCollection();
        $this->roles= [];
        $this->messages = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }




    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    public function hasRoles(string $roles): bool
    {
        return in_array($roles, $this->roles);
    }
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $adminProjet): self
    {
        if (!$this->adminProjet->contains($adminProjet)) {
            $this->adminProjet[] = $adminProjet;
            $adminProjet->setAdmin($this);
        }

        return $this;
    }

    public function removeProjet(Projet $adminProjet): self
    {
        if ($this->adminProjet->removeElement($adminProjet)) {
            // set the owning side to null (unless already changed)
            if ($adminProjet->getAdmin() === $this) {
                $adminProjet->setAdmin(null);
            }
        }

        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser1($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUser1() === $this) {
                $message->setUser1(null);
            }
        }

        return $this;
    }
}
