<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_MANAGER')",
 *          },
 *          "put"={"security"="is_granted('ROLE_MANAGER')"},
 *          "delete"={"security"="is_granted('ROLE_MANAGER')"}
 *     },
 *     collectionOperations={
 *          "get"={ "security"="is_granted('ROLE_MANAGER')"},
 *          "post"={"security"="is_granted('ROLE_MANAGER')"}
 *     },
 *     normalizationContext={"groups"={"module:read"}},
 *     denormalizationContext={"groups"={"module:write"}},
 * )
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"module:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"module:read","module:write"})
     */
    private $titreModule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"module:read","module:write"})
     */
    private $dateDebutModule;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFinModule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tache", mappedBy="module")
     * @Groups({"module:read","module:write"})
     */
    private $taches;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }
    public function getTaches(): Collection
    {
        return $this->taches;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreModule(): ?string
    {
        return $this->titreModule;
    }

    public function setTitreModule(string $titreModule): self
    {
        $this->titreModule = $titreModule;

        return $this;
    }

    public function getDateDebutModule(): ?string
    {
        return $this->dateDebutModule;
    }

    public function setDateDebutModule(string $dateDebutModule): self
    {
        $this->dateDebutModule = $dateDebutModule;

        return $this;
    }

    public function getDateFinModule(): ?\DateTimeInterface
    {
        return $this->dateFinModule;
    }

    public function setDateFinModule(\DateTimeInterface $dateFinModule): self
    {
        $this->dateFinModule = $dateFinModule;

        return $this;
    }


    public function setTaches(string $taches): self
    {
        $this->taches = $taches;

        return $this;
    }
}
