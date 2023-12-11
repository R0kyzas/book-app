<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Book;
use App\Form\BookType;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="app_book")
     */
    public function list(): Response
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();

        return $this->render('pages/book/list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/book/create", name="create_book")
     */
    public function create(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            $this->addFlash('success', 'Book added successfully.');

            return $this->redirectToRoute('app_book');
        }

        return $this->render('pages/book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/book/edit/{id}", name="edit_book")
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Book updated successfully.');

            return $this->redirectToRoute('app_book');
        }else {
            dump($form->getErrors(true, false));
        }
        return $this->render('pages/book/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/book/delete/{id}", name="delete_book")
     */
    public function delete(Book $book): Response
    {
        if (!$book) {
            $this->addFlash('error', 'Book not found.');
            return $this->redirectToRoute('app_book');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($book);
        $entityManager->flush();

        $this->addFlash('success', 'Book deleted successfully.');

        return $this->redirectToRoute('app_book');
    }
}