<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ActorsType;
use App\Entity\Aktoriai;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class ActorsController extends AbstractController
{
    /**
     * @Route("/actors", name="actors")
     * @Method({"GET"})             
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $aktoriai = $this->getDoctrine()->getRepository(Aktoriai::class)->findAll();
        $pagination = $paginator->paginate(
            $aktoriai, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('actors/index.html.twig', array('aktoriai' => $pagination));
    }

    /**
     * @Route("/actors/insert", name ="insertActor")         
     */
    public function insert(Request $request)
    {
        $actor = new Aktoriai();
        $form = $this->createForm(ActorsType::class, $actor, 
            ['action' => $this->generateURL('insertActor')]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actor);
            $entityManager->flush();
            return $this->redirectToRoute('actors');
        }

        return $this->render('actors/insert.html.twig', array('actors_form' => $form->createView()));
    }

    /**
     * @Route("/actors/edit/{id?}", name ="editActor")         
     */
    public function edit($id, Request $request)
    {
        $actor = $this->getDoctrine()
        ->getRepository(Aktoriai::class)
        ->find(intval($id));

        $form = $this->createForm(ActorsType::class, $actor, 
            ['action' => $this->generateUrl('editActor', ['id' => intval($id)])]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('actors');
        }

        return $this->render('actors/edit.html.twig', array('actors_form' => $form->createView()));
    }

    /**
     * @Route("/actors/delete/{id?}", name ="deleteActor")         
     */
    public function delete($id)
    {
        $actor = $this->getDoctrine()
        ->getRepository(Aktoriai::class)
        ->find(intval($id));

        $entityManager = $this->getDoctrine()->getManager();       
        $entityManager->remove($actor);
        $entityManager->flush();
        return $this->redirectToRoute('actors');
    }
}
