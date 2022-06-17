<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Uzsakymai;
use App\Form\OrdersType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends AbstractController
{

    /**
     * @Route("/orders", name = "orders")
     * @Method({"GET"})             
     */
    public function index(PaginatorInterface $paginator, Request $request) 
    {
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT vardas, pavarde, pavadinimas, UZ.id
                FROM Filmai
                INNER JOIN Uzsakymai AS UZ ON Filmai.id = UZ.fk_Filmasid
                INNER JOIN Pirkejai ON UZ.fk_Pirkejasid = Pirkejai.id';

        

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $pagination = $paginator->paginate(
            $stmt->fetchAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('orders/index.html.twig', ['uzsakymai' => $pagination]);
    }


    /**
    * @Route("/orders/insert", name ="insertOrder")         
    */
    public function insert(Request $request)
    {
        $order = new Uzsakymai();
        $form = $this->createForm(OrdersType::class, $order, 
            ['action' => $this->generateURL('insertOrder')]);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($order);
                    $entityManager->flush();
                    return $this->redirectToRoute('orders');
            }

            return $this->render('orders/insert.html.twig', array('orders_form' => $form->createView()));
    }

    /**
    * @Route("/orders/edit/{id?}", name ="editOrder")         
    */
    public function edit($id, Request $request)
    {
        $order = $this->getDoctrine()
        ->getRepository(Uzsakymai::class)
        ->find(intval($id));

        $form = $this->createForm(OrdersType::class, $order, 
            ['action' => $this->generateURL('editOrder', ['id' => intval($id)])]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('orders');
        }

        return $this->render('orders/edit.html.twig', array('orders_form' => $form->createView()));
    }


    /**
     * @Route("/orders/delete/{id?}", name ="deleteOrder")         
     */
    public function delete($id)
    {
        $order = $this->getDoctrine()
        ->getRepository(Uzsakymai::class)
        ->find(intval($id));

        $entityManager = $this->getDoctrine()->getManager();       
        $entityManager->remove($order);
        $entityManager->flush();
        return $this->redirectToRoute('orders');
    }


    /**
     * @Route("/orders/shoppingCard/{id}", requirements={"id"="\d+"}, name="shoppingCard")
     * @Method({"GET"})
     */
    public function shoppingCard(SessionInterface $session, $id)
    {
        $arr = $session->get('shopping_card', []);
        if($arr != [])
        {
            $arr[] = $id;
            $session->set('shopping_card', $arr);
        }
        else
        {
            $session->set('shopping_card', [$id]);
        }        
        return $this->redirectToRoute('movies');
    }

    /**
     * @Route("/orders/check")
     * @Method({"GET"})
     */
    public function check(SessionInterface $session)
    {
        $list = $session->get('shopping_card', []);
        return $this->json(['shopping_card' => $list]);

        //return $this->redirect('/php-darbai/filmuSvetaine/public/movies/');
    }
}
