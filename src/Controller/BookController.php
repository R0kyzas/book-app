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
     * @Route("/books", name="book_list_action")
     */
    public function list(): Response
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();

        return $this->render('pages/book/list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/books/create", name="book_create_action")
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

            return $this->redirectToRoute('book_list_action');
        }

        return $this->render('pages/book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/books/edit/{id}", name="book_edit_action")
     */
    public function edit(Request $request, Book $book): Response
    {
        if (!$book) {
            $this->addFlash('error', 'Book not found.');
            return $this->redirectToRoute('book_list_action');
        }

        $form = $this->createForm(BookType::class, $book);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Book updated successfully.');

            return $this->redirectToRoute('book_list_action');
        }else {
            dump($form->getErrors(true, false));
        }
        return $this->render('pages/book/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/books/delete/{id}", name="book_delete_action")
     */
    public function delete(Book $book): Response
    {
        if (!$book) {
            $this->addFlash('error', 'Book not found.');
            return $this->redirectToRoute('book_list_action');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($book);
        $entityManager->flush();

        $this->addFlash('success', 'Book deleted successfully.');

        return $this->redirectToRoute('book_list_action');
    }
}