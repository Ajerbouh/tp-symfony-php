<?php

namespace App\Controller;

use App\Repository\VideosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(VideosRepository $videosRepository)
    {
        $videos = $videosRepository->findAll();
        return $this->render('home/index.html.twig', [
            'videos' => $videos,
        ]);
    }
}
