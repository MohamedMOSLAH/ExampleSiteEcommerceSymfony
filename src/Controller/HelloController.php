<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
     /**
     * @Route("/hello/{name}", name="hello", methods={"GET", "POST"},   requirements={"name"="[a-zA-Z]+"}, defaults={"name"="Wold"} )
     */
    public function hello($name){
        
        return new Response("Hello $name");
    }
}

?>