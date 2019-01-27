<?php

namespace App\Controller;

use App\Entity\Videos;
use App\Form\VideosType;
use App\Repository\VideosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VideosController extends AbstractController
{
    /**
     * @Route("/videos", name="videos")
     * @param VideosRepository $videosRepository
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, VideosRepository $videosRepository, EntityManagerInterface $entityManager)
    {
        //replace by findBy when user log created
       $videos =  $videosRepository->findAll();
        $video = new Videos();
        $form = $this->createForm(VideosType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($video);
            $entityManager->flush();
        }
        return $this->render('videos/index.html.twig', [
            'controller_name' => 'VideosController',
            'form' => $form->createView(),
            'videos' => $videos,
        ]);
    }
}
