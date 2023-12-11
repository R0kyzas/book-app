<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $book = new Book();
            $book->setTitle('Book title' . $i);
            $book->setAuthor('Author' . $i);

            $releaseYear = new DateTime();
            $releaseYear->setDate(1800 + $i, 1, 1);
            $book->setReleaseYear($releaseYear);

            $book->setIsbn('ISBN' . $i);

            $manager->persist($book);
        }
        $manager->flush();
    }
}
