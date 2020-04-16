<?php
namespace App\Controller;

use App\Entity\Espaces;
use App\Form\EspacesType;
use App\Repository\EspacesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class EspacesController extends AbstractController
{
    /**
     * @var EspacesRepository
     */
    private $repository;

    public function __construct(EspacesRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
         $this->em = $em;
    }
 /**
     * @Route("/espaces", name="espaces")
     */

    public function index()
    {
        $lesespaces =  $this->repository->findAll();
        return $this->render ( 'pages/espaces.html.twig', compact('lesespaces') );
    }
    /**
 * @return Response 
 * @Route("/espaces{id}" ,name= "espaces.show" )
 */

public function show($id): Response
{
    $espaces = $this->repository->find($id);
return $this-> render('espaces/show.html.twig',[
    'espaces'=>$espaces,
    'current_menu'=> 'lesespaces'

]);

   
}
}