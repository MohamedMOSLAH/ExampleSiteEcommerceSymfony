<?php

namespace App\EventDisptacher;

use App\Event\ProductViewEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class ProductViewEmailSubscriber implements EventSubscriberInterface {

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

    public function sendEmail(ProductViewEvent $productViewEvent)
    {
        $this->logger->info("Le produit  n° ". $productViewEvent->getProduct()->getId(). " est vue");
    }
}