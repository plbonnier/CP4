<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user = $this->getUser();

        if ($user !== null) {
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        } else {
        // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            ]);
        }
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // throw new \LogicException('This method can be blank - it will be
        //intercepted by the logout key on your firewall.');
    }

    #[Route('/mon_profil', name: 'app_profile')]
    public function profile(): Response
    {
        $user = $this->getUser();
        return $this->render('security/mon_profil.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/mon_profil/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function editProfile(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $user = $this->getUser();

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('security/profil_edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/mon_profil/delete/{id}', name: 'app_profile_delete')]
    public function deleteProfile(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash('danger', 'Votre compte a été supprimé');
        }
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
