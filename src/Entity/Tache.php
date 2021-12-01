<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_MEMBER')",
 *          },
 *          "put"={"security"="is_granted('ROLE_MANAGER')"},
 *          "delete"={"security"="is_granted('ROLE_MANAGER')"}
 *     },
 *     collectionOperations={
 *          "get"={ "security"="is_granted('ROLE_MEMBER')"},
 *          "post"={"security"="is_granted('ROLE_MANAGER')"}
 *     },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreTache;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebutTache;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFinTache;

    /**
     * @ORM\Column(type="integer")
     */
    private $priorite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etatTache;

    /**
     * @ORM\Column(type="integer")
     */
    private $tauxAvancement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="taches")
     */
    private $membreEquipe;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="taches")
     */
    private $projet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="taches")
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

    public function getMembreEquipe(): ?int
    {
        return $this->membreEquipe;
    }

    public function setMembreEquipe(int $membreEquipe): self
    {
        $this->membreEquipe = $membreEquipe;

        return $this;
    }

    public function getProjet(): ?string
    {
        return $this->projet;
    }

    public function setProjet(string $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): self
    {
        $this->module = $module;

        return $this;
    }
}
