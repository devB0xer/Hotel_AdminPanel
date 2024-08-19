<?php

namespace App\Entity\Main;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $decription = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    /**
     * @var Collection<int, ServiceOrder>
     */
    #[ORM\OneToMany(targetEntity: ServiceOrder::class, mappedBy: 'service', orphanRemoval: true)]
    private Collection $serviceOrders;

    /**
     * @var Collection<int, ServicePrice>
     */
    #[ORM\OneToMany(targetEntity: ServicePrice::class, mappedBy: 'service', orphanRemoval: true)]
    private Collection $servicePrices;

    public function __construct()
    {
        $this->serviceOrders = new ArrayCollection();
        $this->servicePrices = new ArrayCollection();
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

    public function getDecription(): ?string
    {
        return $this->decription;
    }

    public function setDecription(string $decription): static
    {
        $this->decription = $decription;

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
            $serviceOrder->setService($this);
        }

        return $this;
    }

    public function removeServiceOrder(ServiceOrder $serviceOrder): static
    {
        if ($this->serviceOrders->removeElement($serviceOrder)) {
            // set the owning side to null (unless already changed)
            if ($serviceOrder->getService() === $this) {
                $serviceOrder->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ServicePrice>
     */
    public function getServicePrices(): Collection
    {
        return $this->servicePrices;
    }

    public function addServicePrice(ServicePrice $servicePrice): static
    {
        if (!$this->servicePrices->contains($servicePrice)) {
            $this->servicePrices->add($servicePrice);
            $servicePrice->setService($this);
        }

        return $this;
    }

    public function removeServicePrice(ServicePrice $servicePrice): static
    {
        if ($this->servicePrices->removeElement($servicePrice)) {
            // set the owning side to null (unless already changed)
            if ($servicePrice->getService() === $this) {
                $servicePrice->setService(null);
            }
        }

        return $this;
    }
}
