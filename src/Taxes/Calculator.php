<?php

namespace App\Taxes;

use Psr\Log\LoggerInterface;

class Calculator 
{
    protected $logger;
    protected $tva;

    public function __construct(LoggerInterface $logger, float $tva)
    {
        $this->logger = $logger;
        $this->tva = $tva;
    }
    
    public function calcul(float $prix): float
    {
        $this->logger->info("Un calcul a lieu : $prix");
        return $prix * (20 / 100);
    }

    public function detect(int $amount){
        if($amount>100){
            return true;
        } else {
            return false;
        }
    }
}