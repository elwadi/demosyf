<?php

namespace App\Controller;

use App\Entity\PurchaseOrder;
use App\Form\PurchaseOrderType;
use App\Repository\PurchaseOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/purchase/order')]
final class PurchaseOrderController extends AbstractController
{
    #[Route(name: 'app_purchase_order_index', methods: ['GET'])]
    public function index(PurchaseOrderRepository $purchaseOrderRepository): Response
    {
        return $this->render('purchase_order/index.html.twig', [
            'purchase_orders' => $purchaseOrderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_purchase_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $purchaseOrder = new PurchaseOrder();
        $form = $this->createForm(PurchaseOrderType::class, $purchaseOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($purchaseOrder);
            $entityManager->flush();

            return $this->redirectToRoute('app_purchase_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('purchase_order/new.html.twig', [
            'purchase_order' => $purchaseOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_purchase_order_show', methods: ['GET'])]
    public function show(PurchaseOrder $purchaseOrder): Response
    {
        return $this->render('purchase_order/show.html.twig', [
            'purchase_order' => $purchaseOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_purchase_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PurchaseOrder $purchaseOrder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PurchaseOrderType::class, $purchaseOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_purchase_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('purchase_order/edit.html.twig', [
            'purchase_order' => $purchaseOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_purchase_order_delete', methods: ['POST'])]
    public function delete(Request $request, PurchaseOrder $purchaseOrder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$purchaseOrder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($purchaseOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_purchase_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
