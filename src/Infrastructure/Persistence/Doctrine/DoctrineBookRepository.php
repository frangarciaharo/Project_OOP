<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Book\BookId;
use App\Domain\Book\Book;
use App\Domain\Book\IBookRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineBookRepository implements IBookRepository{
    public function __construct(
        private EntityManagerInterface $em
    ){
        
    }  
    public function find(BookId $id): ?Book
    {
        return $this->em->find(Book::class, $id);
    } 
    public function save(Book $book): void
    {
        $this->em->persist($book);
    
    }
}