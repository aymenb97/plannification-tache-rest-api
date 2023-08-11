<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')",
 *          },
 *          "put"={"security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"},
 *          "delete"={"security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"}
 *     },
 *     collectionOperations={
 *          "get"={ "security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"},
 *          "post"={"security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"}
 *     },
 *     normalizationContext={"groups"={"projet:read","projet"}},
 *     denormalizationContext={"groups"={"projet:write"}},
 * )
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"projet:read","tache"   })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"projet:read","projet:write","tache"})
     */
    private $titre;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @Groups({"projet:read","projet:write"})
     */
    private $dateDebutProjet;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @Groups({"projet:read","projet:write"})
     */
    private $dateFinProjet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"projet:read","projet:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"projet:read","projet:write"})
     */
    private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="adminProjet")
     * @Groups({"projet:read","projet:write","projet"})
     * @MaxDepth(2)
     */
    private $admin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="adminProjet")
     * @Groups({"projet:read","projet:write","projet"})
     * @MaxDepth(2)
     */
    private $chefDeProjet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tache", mappedBy="projet")
     * @Groups({"projet:read","projet:write"})
     */
    private $taches;

     public function __construct()
     {
         $this->taches = new ArrayCollection();
         $this->roles= [];
     }
    public function getTaches(): Collection
    {
        return $this->taches;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDebutProjet(): ?\DateTimeInterface
    {
        return $this->dateDebutProjet;
    }

    public function setDateDebutProjet(?\DateTimeInterface $dateDebutProjet): self
    {
        $this->dateDebutProjet = $dateDebutProjet;

        return $this;
    }

    public function getDateFinProjet(): ?\DateTimeInterface
    {
        return $this->dateFinProjet;
    }

    public function setDateFinProjet(?\DateTimeInterface $dateFinProjet): self
    {
        $this->dateFinProjet = $dateFinProjet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
    public function getChefDeProjet(): ?User
    {
        return $this->chefDeProjet;
    }

    public function setChefDeProjet(?User $chefDeProjet): self
    {
        $this->chefDeProjet = $chefDeProjet;

        return $this;
    }
}
