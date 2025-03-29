<?php

namespace App\Entity;

use ApiPlatform\Metadata\Post;
use App\Repository\OrderRepository;
use App\State\CheckoutProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[Post(uriTemplate: '/checkout', name: 'checkout',processor: CheckoutProcessor::class, denormalizationContext: ['groups' => ['write']])]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $status = null;

    #[ORM\Column(length: 128)]
    private ?string $orderStatus = null;

    #[ORM\Column]
    #[Groups(['write'])]
    #[Assert\NotBlank]
    private ?int $bookId = null;

    #[ORM\Column]
    #[Groups(['write'])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(string $orderStatus): static
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    public function getBookId(): ?int
    {
        return $this->bookId;
    }

    public function setBookId(int $bookId): static
    {
        $this->bookId = $bookId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }
}
