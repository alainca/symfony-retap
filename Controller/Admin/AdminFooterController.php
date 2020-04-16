<?php
namespace App\Controller\Admin;

use App\Entity\Footer;
use App\Form\FooterType;
use App\Repository\FooterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminFooterController extends AbstractController {

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
     * @Route("/textefooter", name="admin.footer.index")
     
     */

    public function index ()
    {
        $lesfooters = $this->repository->findAll();
        return $this->render('admin/footer/index.html.twig', compact('lesfooters'));
    }

    /**
     * @Route("/createfooter", name="admin.footer.new")
     */
    public function new(Request $request)
    {
       $footer = new Footer();
       $form = $this->createForm( FooterType::class,$footer );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($footer);
            $this->em->flush();
            return $this->redirectToRoute('admin.footer.index');
        }
        return $this->render('admin/footer/new.html.twig', [
            'footer'=>$footer,
            'form' => $form ->createView()
            ]);

    }

    /**
     * @Route("/editfooter{id}", name="admin.footer.edit", methods="GET|POST")
     * @param Footer $Footer
     * @param Request $request
     * @return Response
     */
    public function edit(Footer $footer, Request $request)
    {
        $form = $this->createForm( FooterType::class,$footer );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.footer.index');

        }
        return $this->render('admin/footer/edith.html.twig', [
            'footer'=>$footer,
            'form' => $form ->createView()
            ]);
    }
    /**
     * @Route(
     * "/admin/footer/{id}",
     * name="admin.footer.delete",
     * methods="DELETE"
     * )
     */

    public function delete(Footer $footer, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $footer->getId(), $request->get('_token'))) {
        $this->em->remove($footer);
        $this->em->flush();
        }
     
        
        return $this->redirectToRoute('admin.footer.index');
    }

}