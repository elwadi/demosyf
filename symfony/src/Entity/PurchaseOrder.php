<?php

namespace App\Entity;

use App\Repository\PurchaseOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ApiResource]
#[ORM\Entity(repositoryClass: PurchaseOrderRepository::class)]
class PurchaseOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $price = null;

    /**
     * @var Collection<int, PurchaseOrderLine>
     */
    #[ORM\OneToMany(targetEntity: PurchaseOrderLine::class, mappedBy: 'purchaseOrder')]
    private Collection $purchaseOrderLines;

    #[ORM\ManyToOne(inversedBy: 'purchaseOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function __construct()
    {
        $this->purchaseOrderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, PurchaseOrderLine>
     */
    public function getPurchaseOrderLines(): Collection
    {
        return $this->purchaseOrderLines;
    }

    public function addPurchaseOrderLine(PurchaseOrderLine $purchaseOrderLine): static
    {
        if (!$this->purchaseOrderLines->contains($purchaseOrderLine)) {
            $this->purchaseOrderLines->add($purchaseOrderLine);
            $purchaseOrderLine->setPurchaseOrder($this);
        }

        return $this;
    }

    public function removePurchaseOrderLine(PurchaseOrderLine $purchaseOrderLine): static
    {
        if ($this->purchaseOrderLines->removeElement($purchaseOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($purchaseOrderLine->getPurchaseOrder() === $this) {
                $purchaseOrderLine->setPurchaseOrder(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
