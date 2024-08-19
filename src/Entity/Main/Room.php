<?php

namespace App\Entity\Main;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Main\Booking;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
#[ApiResource]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $room_number = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $room_type = null;

    #[ORM\Column]
    private ?bool $is_active = false;

    /**
     * @var Collection<int, RoomPrices>
     */
    #[ORM\OneToMany(targetEntity: RoomPrices::class, mappedBy: 'room', orphanRemoval: true)]
    private Collection $roomPrices;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'room', orphanRemoval: true)]
    private Collection $bookings;

    public function __construct()
    {
        $this->roomPrices = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->room_number;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getRoomNumber(): ?string
    {
        return $this->room_number;
    }

    public function setRoomNumber(string $room_number): static
    {
        $this->room_number = $room_number;

        return $this;
    }

    public function getRoomType(): ?string
    {
        return $this->room_type;
    }

    public function setRoomType(?string $room_type): static
    {
        $this->room_type = $room_type;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, RoomPrices>
     */
    public function getRoomPrices(): Collection
    {
        return $this->roomPrices;
    }

    public function addRoomPrice(RoomPrices $roomPrice): static
    {
        if (!$this->roomPrices->contains($roomPrice)) {
            $this->roomPrices->add($roomPrice);
            $roomPrice->setRoom($this);
        }

        return $this;
    }

    public function removeRoomPrice(RoomPrices $roomPrice): static
    {
        if ($this->roomPrices->removeElement($roomPrice)) {
            // set the owning side to null (unless already changed)
            if ($roomPrice->getRoom() === $this) {
                $roomPrice->setRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setRoom($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getRoom() === $this) {
                $booking->setRoom(null);
            }
        }

        return $this;
    }

}
