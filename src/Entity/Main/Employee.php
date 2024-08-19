<?php

namespace App\Entity\Main;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[ApiResource]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Position $position = null;

    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, RoomServiceOrder>
     */
    #[ORM\OneToMany(targetEntity: RoomServiceOrder::class, mappedBy: 'employee')]
    private Collection $roomServiceOrders;

    public function __construct()
    {
        $this->roomServiceOrders = new ArrayCollection();
    }

    public function __toString(): string
    {

        return $this->first_name . ' ' . $this->last_name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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
            $roomServiceOrder->setEmployee($this);
        }

        return $this;
    }

    public function removeRoomServiceOrder(RoomServiceOrder $roomServiceOrder): static
    {
        if ($this->roomServiceOrders->removeElement($roomServiceOrder)) {
            // set the owning side to null (unless already changed)
            if ($roomServiceOrder->getEmployee() === $this) {
                $roomServiceOrder->setEmployee(null);
            }
        }

        return $this;
    }
}
