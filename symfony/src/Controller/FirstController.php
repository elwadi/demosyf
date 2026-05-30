<?php

namespace App\Controller;

use App\Entity\Product;
use App\Message\Tracking;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Messenger\MessageBusInterface;


final class FirstController extends AbstractController
{
    #[Route('/', name: 'app_first')]
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $product= new Product();
        $product->setName("Produit A");
        $product->setDescription("Product description");
        $product->setPrice(1000);

        $managerRegistry->getManager()->persist($product);
        $managerRegistry->getManager()->flush();

        $data=$managerRegistry->getManager()->getRepository(Product::class)->find(1);
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    
    #[Route('/messages', name: 'app_message')]
    public function mymessages(MessageBusInterface $bus): Response
    {
        for($i=0;$i<100;$i++){
        $bus->dispatch(new Tracking("Trackin #".$i));

        }
        return new Response('Ok messages');
    }
}
