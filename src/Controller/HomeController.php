<?php

namespace App\Controller;

use App\Repository\VideosRepository;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
        const API_KEY = '18f488ccdaa81d45426ea58e82fbd31a93116285e72095b1e7296156a7baa31b';
    /**
     * @Route("/home", name="home")
     */
    public function index(VideosRepository $videosRepository)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.art.rmngp.fr/v1/works/69885', [
            'headers' => [
                'ApiKey' => self::API_KEY
            ]
        ]);
/*        echo '<pre>';
        var_dump(\GuzzleHttp\json_decode($response->getBody()));
        echo '</pre>';*/
        $data = \GuzzleHttp\json_decode($response->getBody());

        return $this->render('home/index.html.twig', [
            'videos' => $data,
        ]);
    }
}
