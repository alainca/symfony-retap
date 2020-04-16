<?php
namespace App\Controller\Admin;

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


class AdminSessionControlleur extends AbstractController {

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
     * @Route("/session", name="admin.session.index")
     
     */

    public function index ()
    {
        $lessessions = $this->repository->findAll();
        return $this->render('admin/session/index.html.twig', compact('lessessions'));
    }

    /**
     * @Route("/createsession", name="admin.session.new")
     */
    public function new(Request $request)
    {
       $session = new Session();
       $form = $this->createForm( SessionType::class,$session );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($session);
            $this->em->flush();
            return $this->redirectToRoute('admin.session.index');
        }
        return $this->render('admin/session/new.html.twig', [
            'session'=>$session,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/session{id}", name="admin.session.edit", methods="GET|POST")
     * @param Session $Session
     * @param Request $request
     * @return Response
     */
    public function edit(Session $session, Request $request)
    {
        $form = $this->createForm( SessionType::class,$session );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.session.index');

        }
        return $this->render('admin/session/edith.html.twig', [
            'session'=>$session,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/sessiondelete{id}",
     * name="admin.session.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Session $session, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $session->getId(), $request->get('_token'))) {
        $this->em->remove($session);
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.session.index');
    }

}