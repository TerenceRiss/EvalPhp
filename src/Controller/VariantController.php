<?php

namespace App\Controller;

use App\Entity\Shoes;
use App\Entity\Variant;
use App\Form\VariantType;
use App\Repository\VariantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/variant')]
class VariantController extends AbstractController
{
    #[Route('/', name: 'app_variant_index', methods: ['GET'])]
    public function index(VariantRepository $variantRepository): Response
    {
        return $this->render('variant/index.html.twig', [
            'variants' => $variantRepository->findAll(),
        ]);
    }

    #[Route('/new/{shoe}', name: 'app_variant_new', methods: ['GET', 'POST'])]
    public function new(Shoes $shoe, Request $request, VariantRepository $variantRepository): Response
    {
        $variant = new Variant();
        $variant->setModel($shoe);
        $form = $this->createForm(VariantType::class, $variant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $variantRepository->save($variant, true);

            return $this->redirectToRoute('app_shoes_edit', ['id' => $shoe->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('variant/new.html.twig', [
            'variant' => $variant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_variant_show', methods: ['GET'])]
    public function show(Variant $variant): Response
    {
        return $this->render('variant/show.html.twig', [
            'variant' => $variant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_variant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Variant $variant, VariantRepository $variantRepository): Response
    {
        $form = $this->createForm(VariantType::class, $variant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $variantRepository->save($variant, true);

            return $this->redirectToRoute('app_shoes_edit', ['id' => $variant->getModel()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('variant/edit.html.twig', [
            'variant' => $variant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_variant_delete', methods: ['POST'])]
    public function delete(Request $request, Variant $variant, VariantRepository $variantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$variant->getId(), $request->request->get('_token'))) {
            $variantRepository->remove($variant, true);
        }

        return $this->redirectToRoute('app_variant_index', [], Response::HTTP_SEE_OTHER);
    }
}
