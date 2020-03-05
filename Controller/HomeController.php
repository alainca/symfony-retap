<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
	/**
     * @Route("/", name="home")
     */

public function home(){
	return $this->render('pages/home.html.twig',[ 'title'=> "Bienvenu sur Retap ta Recup"]);
}




}