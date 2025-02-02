<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function getProduct(ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->findAll();
        return $this->json($product);
    }

    #[Route('/product', methods={"POST"})]
    public function createProduct(Request $request, EntityManagerInterface $em): J
    {
        $data = json_decode($request->getContent(), true);
        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $em->persist($product);
        $em->flush();
        return $this->json($product);
    }
}

