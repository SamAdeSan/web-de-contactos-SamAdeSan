<?php

namespace App\Controller;

use App\Entity\Contacto;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactoFormType as ContactoType;

final class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PageController.php',
        ]);
    }
    #[Route('/{codigo?1}', name: 'inicio')]
    public function ficha(ManagerRegistry $doctrine, $codigo, Request $request): Response
    {
        $em = $doctrine->getManager();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); // login check

        $repositorio = $doctrine->getRepository(Contacto::class);
        $contacto = $repositorio->find($codigo);

        if (!$contacto) {
            throw $this->createNotFoundException("Contacto $codigo no encontrado");
        }

        $form = $this->createForm(ContactoType::class, $contacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('guardar')->isClicked()) {
                $em = $doctrine->getManager();
                $em->flush();
            } else if ($form->get('borrar')->isClicked()) {
                $em = $doctrine->getManager();
                $em->remove($contacto);
                $em->flush();
                return $this->redirectToRoute('portada');
            }
        }

        return $this->render('ficha_contacto.html.twig', [
            'contacto' => $contacto,
            'form' => $form->createView()
        ]);
    }


}