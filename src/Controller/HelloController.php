<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
     /**
     * @Route("/hello/{name?World}", name="hello")
     */
    public function hello($name){
        
        return new Response("Hello $name");
    };
}

?>