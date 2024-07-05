<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HelloController
{
    
     /**
     * @Route("/hello/{name?World}", name="hello")
     */
    public function hello($name, LoggerInterface $logger,Calculator $calculator, Slugify $slug,
    Environment $twig
    ){
        dump($twig);
        dump($slug->slugify("Hello world"));
        $logger->error("Mon message de log !");
        $tva = $calculator->calcul(100);
        dump($tva);
        return new Response("Hello $name");
    }
}

?>