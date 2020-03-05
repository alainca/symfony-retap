<?php
namespace App\Controller\Admin;

use App\Entity\Atelier;
use App\Form\AtelierType;
use App\Repository\AtelierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminAtelierControlleur extends AbstractController {

    /**
     * @var AtelierRepository
     */
    private $repository;

    public function __construct(AtelierRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/adminatelier", name="admin.atelier.index")
     
     */

    public function index ()
    {
        $lesateliers = $this->repository->findAll();
        return $this->render('admin/categorie/index.html.twig', compact('lesateliers'));
    }

    /**
     * @Route("/createatelier", name="admin.atelier.new")
     */
    public function new(Request $request)
    {
       $atelier = new Atelier();
       $form = $this->createForm( AtelierType::class,$atelier );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($atelier);
            $this->em->flush();
            return $this->redirectToRoute('admin.atelier.index');
        }
        return $this->render('admin/categorie/new.html.twig', [
            'atelier'=>$atelier,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/adminatelier{id}", name="admin.atelier.edit", methods="GET|POST")
     * @param Atelier $Atelier
     * @param Request $request
     * @return Response
     */
    public function edit(Atelier $atelier, Request $request)
    {
        $form = $this->createForm( AtelierType::class,$atelier );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.atelier.index');

        }
        return $this->render('admin/categorie/edith.html.twig', [
            'atelier'=>$atelier,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/atelier/{id}",
     * name="admin.atelier.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Atelier $atelier, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $atelier->getId(), $request->get('_token'))) {
        $this->em->remove($atelier);
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.atelier.index');
    }

}