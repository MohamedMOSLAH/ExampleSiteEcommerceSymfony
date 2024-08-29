<?php

namespace App\Controller\Purchase;

use App\Repository\PurchaseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasePaymentController extends AbstractController {

    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     */
    public function showCardForm($id, PurchaseRepository $purchaseRepository) {

        $purchase = $purchaseRepository->find($id);
        \Stripe\Stripe::setApiKey("sk_test_51PrS77HCnGw85cxmyi3MPluXYFsAlIVYVpYcJYwd4IZgiDS7dUc2Fa4yVeyKjO6va4BurAGFy77tVJFHkkmsrcNT00PEUPhiwV");
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $purchase->getTotal(),
            'currency' => 'eur'
        ]);


        return $this->render('purchase/payment.html.twig', [
            'clientSecret' => $intent->client_secret,
            'purchase' => $purchase
        ]);
    }
}