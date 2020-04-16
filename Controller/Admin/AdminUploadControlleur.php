<?php
namespace App\Controller\Admin;

use App\Entity\Upload;
use App\Form\UploadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Forms;


 

class AdminUploadControlleur extends AbstractController {
    /**
     * @Route("/upload", name="admin.upload.index")
     
     */

    public function index (Request $request)
    {
       $upload = new Upload();
       $form = $this ->createForm(UploadType::class, $upload);
       $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $file =$upload->getName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $upload-> setName ($fileName);
            return $this->redirectToRoute('admin.upload.index');
        }
        return $this->render('admin/upload/index.html.twig', [
            'form'=>$form->createView()],
        );
    }

}