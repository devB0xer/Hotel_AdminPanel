<?php

namespace App\Entity\Main;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RoomServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomServiceRepository::class)]
#[ApiResource]
class RoomService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, RoomServiceOrder>
     */
    #[ORM\OneToMany(targetEntity: RoomServiceOrder::class, mappedBy: 'room_service', orphanRemoval: true)]
    private Collection $roomServiceOrders;

    public function __construct()
    {
        $this->roomServiceOrders = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, RoomServiceOrder>
     */
    public function getRoomServiceOrders(): Collection
    {
        return $this->roomServiceOrders;
    }

    public function addRoomServiceOrder(RoomServiceOrder $roomServiceOrder): static
    {
        if (!$this->roomServiceOrders->contains($roomServiceOrder)) {
            $this->roomServiceOrders->add($roomServiceOrder);
            $roomServiceOrder->setRoomService($this);
        }

        return $this;
    }

    public function removeRoomServiceOrder(RoomServiceOrder $roomServiceOrder): static
    {
        if ($this->roomServiceOrders->removeElement($roomServiceOrder)) {
            // set the owning side to null (unless already changed)
            if ($roomServiceOrder->getRoomService() === $this) {
                $roomServiceOrder->setRoomService(null);
            }
        }

        return $this;
    }
}
