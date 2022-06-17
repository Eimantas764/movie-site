<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Vaidinimai;
use App\Form\PerformancesType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PerformancesController extends AbstractController
{
    /**
     * @Route("/performances", name="performances")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT vardas, pavarde, pavadinimas
                FROM Filmai
                INNER JOIN Vaidinimai AS AF ON Filmai.id = AF.fk_Filmasid
                INNER JOIN Aktoriai ON AF.fk_Aktoriusid = Aktoriai.id_Aktorius;';

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $pagination = $paginator->paginate(
            $stmt->fetchAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('performances/index.html.twig', ['vaidinimai' => $pagination]);
    }

    /**
    * @Route("/performances/insert", name ="insertPerformance")         
    */
    public function insert(Request $request)
    {
        $performance = new Vaidinimai();
        $form = $this->createForm(PerformancesType::class, $performance, 
            ['action' => $this->generateURL('insertPerformance')]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($performance);
                $entityManager->flush();
                return $this->redirectToRoute('performances');
        }

        return $this->render('performances/insert.html.twig', array('performances_form' => $form->createView()));
    }

}
