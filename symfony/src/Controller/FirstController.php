<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FirstController extends AbstractController
{
    #[Route('/', name: 'app_first')]
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $product= new Product();
        $product->setName("Produit A");
        $product->setDescription("Product description");

        $managerRegistry->getManager()->persist($product);
        $managerRegistry->getManager()->flush();

        $data=$managerRegistry->getManager()->getRepository(Product::class)->find(1);
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
}
