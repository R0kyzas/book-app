<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $book = new Book();
            $book->setTitle('Book title' . $i);
            $book->setAuthor('Author' . $i);
            $book->setReleaseYear(1800 + $i);
            $book->setIsbn('ISBN' . $i);

            $manager->persist($book);
        }
        $manager->flush();
    }
}
