<?php
namespace App\Controller\Admin;

use App\Entity\Galerie;
use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminGalerieControlleur extends AbstractController {

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
     * @Route("/galerieadmin", name="admin.galerie.index")
     
     */

    public function index ()
    {
        $lesgaleries = $this->repository->findAll();
        return $this->render('admin/galerie/index.html.twig', compact('lesgaleries'));
    }

    /**
     * @Route("/creategalerie", name="admin.galerie.new")
     */
    public function new(Request $request)
    {
       $galerie = new Galerie();
       $form = $this->createForm( GalerieType::class,$galerie );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($galerie);
            $this->em->flush();
            return $this->redirectToRoute('admin.galerie.index');
        }
        return $this->render('admin/galerie/new.html.twig', [
            'galerie'=>$galerie,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/galerieadmin{id}", name="admin.galerie.edit", methods="GET|POST")
     * @param Galerie $galerie
     * @param Request $request
     * @return Response
     */
    public function edit(Galerie $galerie, Request $request)
    {
        $form = $this->createForm( GalerieType::class,$galerie );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success',"La galerie a été modifié avec succés");
            return $this->redirectToRoute('admin.galerie.index');

        }
        return $this->render('admin/galerie/edith.html.twig', [
            'galerie'=>$galerie,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/galerie/{id}",
     * name="admin.galerie.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Galerie $galerie, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $galerie->getId(), $request->get('_token'))) {
        $this->em->remove($galerie);
        $this->addFlash('success',"La galerie a été supprimé avec succés");
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.galerie.index');
    }

}