<?php
namespace App\Controller\Admin;

use App\Entity\Espaces;
use App\Form\EspacesType;
use App\Repository\EspacesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminEspacesController extends AbstractController {

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
     * @Route("/texteespaces", name="admin.espaces.index")
     
     */

    public function index ()
    {
        $lesespaces = $this->repository->findAll();
        return $this->render('admin/espaces/index.html.twig', compact('lesespaces'));
    }

    /**
     * @Route("/createespaces", name="admin.espaces.new")
     */
    public function new(Request $request)
    {
       $espaces = new Espaces();
       $form = $this->createForm( EspacesType::class,$espaces );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($espaces);
            $this->em->flush();
            return $this->redirectToRoute('admin.espaces.index');
        }
        return $this->render('admin/espaces/new.html.twig', [
            'espaces'=>$espaces,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/editespaces{id}", name="admin.espaces.edit", methods="GET|POST")
     * @param Espaces $Espaces
     * @param Request $request
     * @return Response
     */
    public function edit(Espaces $espaces, Request $request)
    {
        $form = $this->createForm( EspacesType::class,$espaces );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.espaces.index');

        }
        return $this->render('admin/espaces/edith.html.twig', [
            'espaces'=>$espaces,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/espaces/{id}",
     * name="admin.espaces.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Espaces $espaces, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $espaces->getId(), $request->get('_token'))) {
        $this->em->remove($espaces);
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.espaces.index');
    }

}