<?php

namespace App\Doctrine\Listener;

use App\Entity\Product;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;



class ProductSlugListener {

    protected $slugger;

    public function __construct(SluggerInterface $slugger){
        $this->slugger = $slugger;
    }
 
    public function prePersist(Product $entity,LifecycleEventArgs $event)
    {
        if( empty($entity->getSlug()) ){
            $entity->setSlug(strtolower($this->slugger->slug($entity->getName())));
        }
    }
}