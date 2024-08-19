<?php

namespace App\Entity\Main;

use ApiPlatform\Metadata\ApiResource;
use App\Config\OrderStatus;
use App\Repository\RoomServiceOrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomServiceOrderRepository::class)]
#[ApiResource]
class RoomServiceOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'roomServiceOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Booking $booking = null;

    #[ORM\ManyToOne(inversedBy: 'roomServiceOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RoomService $room_service = null;

    // #[ORM\Column(length: 50)]
    // private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $request_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $completion_date = null;

    #[ORM\ManyToOne(inversedBy: 'roomServiceOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    #[ORM\Column(enumType: OrderStatus::class)]
    private ?OrderStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): static
    {
        $this->booking = $booking;

        return $this;
    }

    public function getRoomService(): ?RoomService
    {
        return $this->room_service;
    }

    public function setRoomService(?RoomService $room_service): static
    {
        $this->room_service = $room_service;

        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->request_date;
    }

    public function setRequestDate(\DateTimeInterface $request_date): static
    {
        $this->request_date = $request_date;

        return $this;
    }

    public function getCompletionDate(): ?\DateTimeInterface
    {
        return $this->completion_date;
    }

    public function setCompletionDate(?\DateTimeInterface $completion_date): static
    {
        $this->completion_date = $completion_date;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
