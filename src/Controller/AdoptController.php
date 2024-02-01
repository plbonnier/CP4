<?php

namespace App\Controller;

use App\Entity\Adopt;
use App\Entity\User;
use App\Form\AdoptType;
use App\Repository\AdoptRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adopt')]
class AdoptController extends AbstractController
{
    #[Route('/', name: 'app_adopt_index', methods: ['GET'])]
    public function index(AdoptRepository $adoptRepository): Response
    {
        return $this->render('adopt/index.html.twig', [
            'adopts' => $adoptRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adopt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adopt = new Adopt();
        $user = $this->getUser();
        $adoptDate = new DateTime();
        $form = $this->createForm(AdoptType::class, $adopt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adopt->setUser($user);
            $adopt->setDate($adoptDate);
            $entityManager->persist($adopt);
            $entityManager->flush();

            return $this->redirectToRoute('app_adopt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adopt/new.html.twig', [
            'adopt' => $adopt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adopt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adopt $adopt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdoptType::class, $adopt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adopt/edit.html.twig', [
            'adopt' => $adopt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adopt_delete', methods: ['POST'])]
    public function delete(Request $request, Adopt $adopt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $adopt->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adopt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adopt_index', [], Response::HTTP_SEE_OTHER);
    }
}
