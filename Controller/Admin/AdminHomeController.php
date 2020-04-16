<?php
namespace App\Controller\Admin;

use App\Entity\Home;
use App\Form\HomeType;
use App\Repository\HomeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminHomeController extends AbstractController {

    /**
     * @var AtelierRepository
     */
    private $repository;

    public function __construct(HomeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/textehome", name="admin.home.index")
     
     */

    public function index ()
    {
        $leshomes = $this->repository->findAll();
        return $this->render('admin/home/index.html.twig', compact('leshomes'));
    }

    /**
     * @Route("/createhome", name="admin.home.new")
     */
    public function new(Request $request)
    {
       $home = new Home();
       $form = $this->createForm( HomeType::class,$home );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($home);
            $this->em->flush();
            return $this->redirectToRoute('admin.home.index');
        }
        return $this->render('admin/home/new.html.twig', [
            'home'=>$home,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/edithome{id}", name="admin.home.edit", methods="GET|POST")
     * @param Home $Home
     * @param Request $request
     * @return Response
     */
    public function edit(Home $home, Request $request)
    {
        $form = $this->createForm( HomeType::class,$home );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.home.index');

        }
        return $this->render('admin/home/edith.html.twig', [
            'home'=>$home,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/home/{id}",
     * name="admin.home.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Home $home, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $home->getId(), $request->get('_token'))) {
        $this->em->remove($home);
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.home.index');
    }

}