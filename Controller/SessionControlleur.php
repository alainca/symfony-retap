<?php
namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Form\CoursType;
use App\Entity\Cours;
use App\Repository\SessionRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SessionControlleur extends AbstractController {

    /**
     * @var SessionRepository
     */
    private $repository;

    public function __construct(SessionRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/les_sessions", name="session.index")
     
     */

    public function index ()
    {
        $lessessions = $this->repository->findAll();
        return $this->render('session/index.html.twig', compact('lessessions'));
    }

   
        

   
     
        
   

}