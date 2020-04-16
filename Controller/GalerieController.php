<?php
namespace App\Controller;
use App\Entity\Galerie;
use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalerieController extends AbstractController
 {

    /**
     * @var GalerieRepository
     */

     private $repository;


     public function __construct(GalerieRepository $repository, EntityManagerInterface $em)
     {
         $this->repository = $repository;
         $this->em = $em;
        
     }


 /**
  * @Route("/galerie" ,name= "galerie.index" )
  */


    public function index()
    {
      $lesgaleries =  $this->repository->findAll();
   
        
        
return $this->render ( 'galerie/index.html.twig', compact('lesgaleries'));
    }

/**
 * @return Response 
 * @Route("/galerie{id}" ,name= "galerie.show" )
 */

    public function show($id): Response
{
    $galerie = $this->repository->find($id);
return $this-> render('galerie/show.html.twig',[
    'galerie'=>$galerie,
    'current_menu'=> 'lesgaleries'

]);
}


}

