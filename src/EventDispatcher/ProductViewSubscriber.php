<?php

namespace App\EventDisptacher;

use Psr\Log\LoggerInterface;
use App\Event\ProductViewEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductViewEventSubscriber implements EventSubscriberInterface {

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            'product.view' => 'sendEmail'
        ];
    }
    public function sendEmail(ProductViewEvent $roductViewEvent) {
       $this->logger->info("Email envoyé à l'admin pour le produit ".$roductViewEvent->getProduct()->getId());
    }

}