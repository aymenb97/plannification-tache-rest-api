<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(collectionOperations={"get_messages","post"},mercure=true,denormalizationContext={"groups"={"message:write"}},normalizationContext={"groups"={"message:read"}})
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"message:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"message:read","message:write"})
     */
    private $message;

    /**
     * @ORM\Column(type="datetime",nullable="false", options={"default":"CURRENT_TIMESTAMP"})
     * @Groups({"message:read"})
     */
    private $timestamp;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"message:read","message:write"})
     */
    private $sender;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"message:read","message:write"})
     */
    private $receiver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    private function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = new \DateTime();
        return $this;

    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
