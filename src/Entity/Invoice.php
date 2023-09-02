<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $invoiceDate = null;

    #[ORM\Column(length: 100)]
    private ?string $invoiceNumber = null;

    #[ORM\Column]
    private ?int $customerId = null;

    #[ORM\OneToOne(mappedBy: 'invoice', cascade: ['persist', 'remove'])]
    private ?InvoiceLine $invoiceLine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(\DateTimeInterface $invoiceDate): static
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): static
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): static
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getInvoiceLine(): ?InvoiceLine
    {
        return $this->invoiceLine;
    }

    public function setInvoiceLine(InvoiceLine $invoiceLine): static
    {
        // set the owning side of the relation if necessary
        if ($invoiceLine->getInvoice() !== $this) {
            $invoiceLine->setInvoice($this);
        }

        $this->invoiceLine = $invoiceLine;

        return $this;
    }
}
