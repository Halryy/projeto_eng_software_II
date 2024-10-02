<?php

namespace App\Controller\Admin;

use App\Entity\BookLoan;
use App\Form\BookLoanType;
use App\Repository\BookLoanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/book/loan')]
class BookLoanController extends AbstractController
{
    #[Route('/', name: 'app_admin_book_loan_index', methods: ['GET'])]
    public function index(BookLoanRepository $bookLoanRepository): Response
    {
        return $this->render('admin/book_loan/index.html.twig', [
            'book_loans' => $bookLoanRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_book_loan_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bookLoan = new BookLoan();
        $form = $this->createForm(BookLoanType::class, $bookLoan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bookLoan);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_book_loan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/book_loan/new.html.twig', [
            'book_loan' => $bookLoan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_book_loan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BookLoan $bookLoan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookLoanType::class, $bookLoan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_book_loan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/book_loan/edit.html.twig', [
            'book_loan' => $bookLoan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_loan_delete', methods: ['POST'])]
    public function delete(Request $request, BookLoan $bookLoan, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bookLoan->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bookLoan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_book_loan_index', [], Response::HTTP_SEE_OTHER);
    }
}
