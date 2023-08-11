<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')",
 *          },
 *          "put"={"security"="is_granted('ROLE_MANAGER')"},
 *          "delete"={"security"="is_granted('ROLE_MANAGER')"}
 *     },
 *     collectionOperations={
 *          "get"={ "security"="is_granted('ROLE_MEMBER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"},
 *          "post"={"security"="is_granted('ROLE_MANAGER') or is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"}
 *     },
 *     normalizationContext={"groups"={"tache:read","tache"}, "datetime_format" = "Y-m-d"},
 *     denormalizationContext={"groups"={"tache:write", "datetime_format" = "Y-m-d"}},
 * )
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tache:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tache:read","tache:write"})
     */
    private $titreTache;

    /**
     * @ORM\Column(type="date")
     * @Groups({"tache:read","tache:write"})
     */
    private $dateDebutTache;

    /**
     * @ORM\Column(type="date")
     * @Groups({"tache:read","tache:write"})
     */
    private $dateFinTache;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"tache:read","tache:write"})
     */
    private $priorite;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"tache:read","tache:write"})
     */
    private $etatTache;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"tache:read","tache:write"})
     */
    private $tauxAvancement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tache:read","tache:write"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="taches")
     * @Groups({"tache:read","tache:write"})
     */
    private $membreEquipe;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="taches")
     * @Groups({"tache:read","tache:write","tache"})
     */
    private $projet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="taches")
     * @Groups({"tache:read","tache:write"})
     */
    private $module;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreTache(): ?string
    {
        return $this->titreTache;
    }

    public function setTitreTache(string $titreTache): self
    {
        $this->titreTache = $titreTache;

        return $this;
    }

    public function getDateDebutTache(): ?\DateTimeInterface
    {
        return $this->dateDebutTache;
    }

    public function setDateDebutTache(\DateTimeInterface $dateDebutTache): self
    {
        $this->dateDebutTache = $dateDebutTache;

        return $this;
    }

    public function getDateFinTache(): ?\DateTimeInterface
    {
        return $this->dateFinTache;
    }

    public function setDateFinTache(\DateTimeInterface $dateFinTache): self
    {
        $this->dateFinTache = $dateFinTache;

        return $this;
    }

    public function getPriorite(): ?int
    {
        return $this->priorite;
    }

    public function setPriorite(int $priorite): self
    {
        $this->priorite = $priorite;

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

    public function getEtatTache(): ?string
    {
        return $this->etatTache;
    }

    public function setEtatTache(string $etatTache): self
    {
        $this->etatTache = $etatTache;

        return $this;
    }

    public function getTauxAvancement(): ?int
    {
        return $this->tauxAvancement;
    }

    public function setTauxAvancement(int $tauxAvancement): self
    {
        $this->tauxAvancement = $tauxAvancement;

        return $this;
    }

    public function getMembreEquipe(): ?User
    {
        return $this->membreEquipe;
    }

    public function setMembreEquipe(?User $membreEquipe): self
    {
        $this->membreEquipe = $membreEquipe;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }
}
