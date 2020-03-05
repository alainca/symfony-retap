<?php
namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtelierController extends AbstractController
 {
 /**
  * @Route("/les_ateliers" ,name= "presentation.index" )
  * @return Response
  */


    public function index(): Response
    { 



return $this->render ( 'presentation/index.html.twig',[
    'current_menu1'=> 'ateliers']);
   }
}