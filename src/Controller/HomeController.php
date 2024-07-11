<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 class HomeController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(EntityManagerInterface $em){

        $productRepository = $em->getRepository(Product::class);
        $product = $productRepository->find(3);
        $em->remove($product);
        $em->flush();
        return $this->render('home.html.twig');
    }
 }