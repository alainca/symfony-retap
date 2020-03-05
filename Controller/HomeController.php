<?php
namespace App\Controller;
use App\Controller\CoursRepository;
use App\Repository\CoursRepository as RepositoryCoursRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController
{
    /**
     * @var Environement
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): Response
    {
        return new Response( $this->twig->render ('pages/home.html.twig') );
    }
     /**
     * @Route("/", name="home")
     * @param CoursRepository $repository
     * @return Response
     */

   
}