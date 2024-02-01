<?php

namespace App\Controller;

use App\Entity\Adopt;
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
    #[Route('/new', name: 'app_adopt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
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

                return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('adopt/new.html.twig', [
                'adopt' => $adopt,
                'form' => $form,
            ]);
        } else {
            return $this->redirectToRoute('app_orang_outan_index', [], Response::HTTP_SEE_OTHER);
        }
    }
}
