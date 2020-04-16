<?php
namespace App\Controller;

use App\Entity\Footer;
use App\Form\FooterType;
use App\Repository\FooterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FooterController extends AbstractController
{
    /**
     * @var FooterRepository
     */
    private $repository;

    public function __construct(FooterRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
         $this->em = $em;
    }
 /**
     * @Route("/footers", name="footer")
     */

    public function index()
    {
        $lesfooters =  $this->repository->findAll();
        return $this->render ( 'pages/footer.html.twig', compact('lesfooters') );
    }
   
}