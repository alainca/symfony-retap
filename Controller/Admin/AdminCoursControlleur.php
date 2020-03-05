<?php
namespace App\Controller\Admin;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminCoursControlleur extends AbstractController {

    /**
     * @var CoursRepository
     */
    private $repository;

    public function __construct(CoursRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
   
    /**
     * @Route("/admin", name="admin.cours.index")
     
     */

    public function index ()
    {
        $lescours = $this->repository->findAll();
        return $this->render('admin/cours/index.html.twig', compact('lescours'));
    }

    /**
     * @Route("/create", name="admin.cours.new")
     */
    public function new(Request $request)
    {
       $cours = new Cours();
       $form = $this->createForm( CoursType::class,$cours );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($cours);
            $this->em->flush();
            return $this->redirectToRoute('admin.cours.index');
        }
        return $this->render('admin/cours/new.html.twig', [
            'cours'=>$cours,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/admin{id}", name="admin.cours.edit", methods="GET|POST")
     * @param Cours $Cours
     * @param Request $request
     * @return Response
     */
    public function edit(Cours $cours, Request $request)
    {
        $form = $this->createForm( CoursType::class,$cours );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.cours.index');

        }
        return $this->render('admin/cours/edith.html.twig', [
            'cours'=>$cours,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/cours/{id}",
     * name="admin.cours.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Cours $cours, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $cours->getId(), $request->get('_token'))) {
        $this->em->remove($cours);
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.cours.index');
    }

}