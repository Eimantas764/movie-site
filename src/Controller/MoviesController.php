<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Filmai;
use App\Form\MoviesType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;

class MoviesController extends AbstractController{
    /**
     * @Route("/movies", name="movies")
     * @Method({"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request){
        $filmai = $this->getDoctrine()->getRepository(Filmai::class)->findAll();
        $pagination = $paginator->paginate(
            $filmai, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $this->getParameter('items_number')  /*limit per page*/
        );

        return $this->render('movies/index.html.twig', array('filmai' => $pagination));
    }


    /**
    * @Route("/movies/insert", name ="insertMovie")         
    */
    public function insert(Request $request)
    {
        $movie = new Filmai();
        $form = $this->createForm(MoviesType::class, $movie, 
            ['action' => $this->generateURL('insertMovie')]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $file = $form['paveikslelis']->getData();
                $file->move($this->getParameter('kernel.project_dir') . "\\public\\movies-images", $file->getClientOriginalName());
                $movie->setPaveikslelis("movies-images/" . $file->getClientOriginalName());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($movie);
                $entityManager->flush();
                return $this->redirectToRoute('moviesList');
        }

        return $this->render('movies/insert.html.twig', array('movies_form' => $form->createView()));
    }


    /**
    * @Route("/movies/edit/{id?}", name ="editMovie")         
    */
    public function edit($id, Request $request)
    {
        $movie = $this->getDoctrine()
        ->getRepository(Filmai::class)
        ->find(intval($id));
        $laikpav = $movie->getPaveikslelis();

        $form = $this->createForm(MoviesType::class, $movie, 
            ['action' => $this->generateURL('editMovie', ['id' => intval($id)])]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {    
            $file = $form['paveikslelis']->getData();

            if($file != null){
                
                $file->move($this->getParameter('kernel.project_dir') . '\\public\\movies-images', $file->getClientOriginalName());
                $movie->setPaveikslelis("movies-images/" . $file->getClientOriginalName());
            }
            else
            {
                $movie->setPaveikslelis($laikpav);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('moviesList');
        }

        return $this->render('movies/edit.html.twig', array('movies_form' => $form->createView()));
    }


    /**
     * @Route("/movies/delete/{id?}", name ="deleteMovie")         
     */
    public function delete($id)
    {
        $movie = $this->getDoctrine()
        ->getRepository(Filmai::class)
        ->find(intval($id));

        $entityManager = $this->getDoctrine()->getManager();       
        $entityManager->remove($movie);
        $entityManager->flush();
        return $this->redirectToRoute('moviesList');
    }

    /**
     * @Route("/movies-list", name="moviesList")
     * @Method({"GET"})
     */
    public function MoviesList(PaginatorInterface $paginator, Request $request){
        $filmai = $this->getDoctrine()->getRepository(Filmai::class)->findAll();
        $pagination = $paginator->paginate(
            $filmai, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $this->getParameter('items_number')  /*limit per page*/
        );

        return $this->render('movies/movies-list.html.twig', array('filmai' => $pagination));
    }


    /**
     * @Route("movies/about-us", name="about-us")
     * @Method({"GET"})
     */
    public function aboutUs(){

        return $this->render('movies/about-us.html.twig');
    }

    /**
     * @Route("movies/contacts", name="contacts")
     * @Method({"GET"})
     */
    public function contancts(){
        return $this->render('movies/contacts.html.twig');
    }

    /**
     * @Route("movies/{id}", name="show-movie")
     * @Method({"GET"})
     */
    public function showMovie($id)
    {
        $movie = $this->getDoctrine()->getRepository(Filmai::class)->find($id);
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT vardas, pavarde
                FROM Filmai
                INNER JOIN Vaidinimai AS AF ON Filmai.id = AF.fk_Filmasid
                INNER JOIN Aktoriai ON AF.fk_Aktoriusid = Aktoriai.id_Aktorius
                WHERE Filmai.id = :id;';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $this->render('movies/movie.html.twig', ['aktoriai' => $stmt->fetchAll(), 'movie' => $movie]);
    }
}