<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Book;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class BooksWithReview implements ProviderInterface
{
    private $entityManager;
    public function __construct(
        
        EntityManagerInterface $entityManager
        )
    {
        $this->entityManager = $entityManager;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Object|array|null
    {
        if ($operation instanceof CollectionOperationInterface) {
        $data = $this->entityManager->getRepository(Book::class)->findAll();
        $book = [];
             foreach ($data as $key => $value) {
                $author  = $value->getAuthor();
                if(is_null($author))
                $value->setAuthor("unknow");
                $book[] = $value; 
             }
             return $book;
        }
        return new Book();
    }
}
