<?php

namespace App\Controller;

use App\Entity\OrangOutan;
use App\Form\OrangOutanType;
use App\Repository\OrangOutanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orang_outan')]
class OrangOutanController extends AbstractController
{
    #[Route('/', name: 'app_orang_outan_index', methods: ['GET'])]
    public function index(
        OrangOutanRepository $orangOutanRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $orangOutan = $orangOutanRepository->findAll();
        $pagination = $paginator ->paginate(
            $orangOutan,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('orang_outan/index.html.twig', [
            'orang_outans' => $orangOutan,
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_orang_outan_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orangOutan = new OrangOutan();
        $form = $this->createForm(OrangOutanType::class, $orangOutan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orangOutan);
            $entityManager->flush();

            return $this->redirectToRoute('app_orang_outan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('orang_outan/new.html.twig', [
            'orang_outan' => $orangOutan,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_orang_outan_show', methods: ['GET'])]
    public function show(OrangOutan $orangOutan): Response
    {
        return $this->render('orang_outan/show.html.twig', [
            'orang_outan' => $orangOutan,
            'slug' => $orangOutan->getSlug(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_orang_outan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrangOutan $orangOutan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrangOutanType::class, $orangOutan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_orang_outan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('orang_outan/edit.html.twig', [
            'orang_outan' => $orangOutan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_orang_outan_delete', methods: ['POST'])]
    public function delete(Request $request, OrangOutan $orangOutan, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $orangOutan->getId(), $request->request->get('_token'))) {
            $entityManager->remove($orangOutan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_orang_outan_index', [], Response::HTTP_SEE_OTHER);
    }
}
