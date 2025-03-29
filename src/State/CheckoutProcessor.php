<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Order;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckoutProcessor implements ProcessorInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data instanceof Order) {
            $book = $this->entityManager->getRepository(Book::class)->find($data->getBookId());
            if ($book) {
                $data->setPrice($book->getPrice() * $data->getQuantity());
                $data->setStatus('OK');
                $data->setOrderStatus('pending');
            } else {
                throw new \Exception('Book not found');
            }
        }

        // Save the order to the database
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        $responceArr = [
            'status' => $data->getStatus(),
            'orderId' => $data->getId(),
            'orderStatus' => $data->getOrderStatus(),
        ];
        return new JsonResponse($responceArr);
    }
}
