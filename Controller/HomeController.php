<?php
namespace App\Controller;

use App\Entity\Footer;
use App\Form\FooterType;
use App\Repository\FooterRepository;
use App\Entity\Home;
use App\Form\HomeType;
use App\Repository\HomeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @var HomeRepository
     */
    private $repository;

    public function __construct(HomeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
         $this->em = $em;
    }
 /**
     * @Route("/", name="home")
     */

    public function index()
    {
        $leshomes =  $this->repository->findAll();
        return $this->render ( 'pages/home.html.twig', compact('leshomes') );
    }
   

   
}
