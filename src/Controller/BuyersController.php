<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pirkejai;
use App\Form\BuyersType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class BuyersController extends AbstractController
{
    /**
     * @Route("/buyers", name="buyers")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $pirkejai = $this->getDoctrine()->getRepository(Pirkejai::class)->findAll();

        $pagination = $paginator->paginate(
            $pirkejai, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('buyers/index.html.twig', array('pirkejai' => $pagination));
    }

    /**
    * @Route("/buyers/insert", name ="insertBuyer")         
    */
    public function insert(Request $request)
    {
    $buyer = new Pirkejai();
    $form = $this->createForm(BuyersType::class, $buyer, 
        ['action' => $this->generateURL('insertBuyer')]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($buyer);
                $entityManager->flush();
                return $this->redirectToRoute('buyers');
        }

        return $this->render('buyers/insert.html.twig', array('buyers_form' => $form->createView()));
    }

    /**
    * @Route("/buyers/edit/{id?}", name ="editBuyer")         
    */
    public function edit($id, Request $request)
    {   
        $buyer = $this->getDoctrine()
        ->getRepository(Pirkejai::class)
        ->find(intval($id));

        $form = $this->createForm(BuyersType::class, $buyer, 
            ['action' => $this->generateURL('editBuyer', ['id' => intval($id)])]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('buyers');
        }

        return $this->render('buyers/edit.html.twig', array('buyers_form' => $form->createView()));
    }

    /**
     * @Route("/buyers/delete/{id?}", name ="deleteBuyer")         
     */
    public function delete($id)
    {
        $buyer = $this->getDoctrine()
        ->getRepository(Pirkejai::class)
        ->find(intval($id));

        $entityManager = $this->getDoctrine()->getManager();       
        $entityManager->remove($buyer);
        $entityManager->flush();
        return $this->redirectToRoute('buyers');
    }

}
