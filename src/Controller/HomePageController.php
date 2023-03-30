<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ShoesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(Request $request, ShoesRepository $shoesRepository): Response
    {
        $form = $this->createForm(SearchType::class,);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $shoesRepository->save($shoe, true);
            $data = $form->getData();
        }
        $shoes = $shoesRepository->search($data ?? []);
    
        return $this->render('home_page/index.html.twig', [
            // 'controller_name' => 'HomePageController',
            'search_form' => $form,
            'shoes'=> $shoes,
        ]);
    }
}
