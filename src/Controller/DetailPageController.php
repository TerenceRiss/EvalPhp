<?php

namespace App\Controller;

use App\Entity\Shoes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailPageController extends AbstractController
{
    #[Route('/{id}/page', name: 'app_detail_page')]
    public function index(Shoes $shoes): Response
    {
        return $this->render('detail_page/index.html.twig', [
            'controller_name' => 'DetailPageController',
            'shoes'=> $shoes
        ]);
    }
}
