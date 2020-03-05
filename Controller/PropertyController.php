<?php
namespace App\Controller;
use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
 {

    /**
     * @var CoursRepository
     */

     private $repository;


     public function __construct(CoursRepository $repository, EntityManagerInterface $em)
     {
         $this->repository = $repository;
         $this->em = $em;
        
     }


 /**
  * @Route("/cours" ,name= "cours.index" )
  */


    public function index()
    {
      $lescours =  $this->repository->findAll();
   
        
        
return $this->render ( 'cours/index.html.twig', compact('lescours'));
    }

/**
 * @return Response 
 * @Route("/cours{id}" ,name= "cours.show" )
 */

    public function show($id): Response
{
    $cours = $this->repository->find($id);
return $this-> render('cours/show.html.twig',[
    'cours'=>$cours,
    'current_menu'=> 'lescours'

]);
}


}

