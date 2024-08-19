<?php

namespace App\Entity\Main;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Main\Room;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
#[ApiResource]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $check_in_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $check_out_date = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guest $guest = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    #[ORM\Column]
    private ?bool $is_checked_out = null;

    /**
     * @var Collection<int, ServiceOrder>
     */
    #[ORM\OneToMany(targetEntity: ServiceOrder::class, mappedBy: 'booking', orphanRemoval: true)]
    private Collection $serviceOrders;

    /**
     * @var Collection<int, RoomServiceOrder>
     */
    #[ORM\OneToMany(targetEntity: RoomServiceOrder::class, mappedBy: 'booking', orphanRemoval: true)]
    private Collection $roomServiceOrders;

    public function __construct()
    {
        $this->serviceOrders = new ArrayCollection();
        $this->roomServiceOrders = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckInDate(): ?\DateTimeInterface
    {
        return $this->check_in_date;
    }

    public function setCheckInDate(\DateTimeInterface $check_in_date): static
    {
        $this->check_in_date = $check_in_date;

        return $this;
    }

    public function getCheckOutDate(): ?\DateTimeInterface
    {
        return $this->check_out_date;
    }

    public function setCheckOutDate(\DateTimeInterface $check_out_date): static
    {
        $this->check_out_date = $check_out_date;

        return $this;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): static
    {
        $this->guest = $guest;

        return $this;
    }

    public function getIsCheckedOut(): ?bool
    {
        return $this->is_checked_out;
    }

    public function setIsCheckedOut(bool $is_checked_out): static
    {
        $this->is_checked_out = $is_checked_out;

        return $this;
    }

    /**
     * @return Collection<int, ServiceOrder>
     */
    public function getServiceOrders(): Collection
    {
        return $this->serviceOrders;
    }

    public function addServiceOrder(ServiceOrder $serviceOrder): static
    {
        if (!$this->serviceOrders->contains($serviceOrder)) {
            $this->serviceOrders->add($serviceOrder);
            $serviceOrder->setBooking($this);
        }

        return $this;
    }

    public function removeServiceOrder(ServiceOrder $serviceOrder): static
    {
        if ($this->serviceOrders->removeElement($serviceOrder)) {
            // set the owning side to null (unless already changed)
            if ($serviceOrder->getBooking() === $this) {
                $serviceOrder->setBooking(null);
            }
        }

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
            $roomServiceOrder->setBooking($this);
        }

        return $this;
    }

    public function removeRoomServiceOrder(RoomServiceOrder $roomServiceOrder): static
    {
        if ($this->roomServiceOrders->removeElement($roomServiceOrder)) {
            // set the owning side to null (unless already changed)
            if ($roomServiceOrder->getBooking() === $this) {
                $roomServiceOrder->setBooking(null);
            }
        }

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }
}
