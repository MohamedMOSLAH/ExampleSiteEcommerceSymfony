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
 
    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getObject();

        if(! $entity instanceof Product) {
            return;
        }

        if( empty($entity->getSlug()) ){
            // SluggerInterface
          //  $entity->setSlug(strtolower($this->slugger->slug($entity->getName())));
            $entity->setSlug(strtolower($this->slugger->slug($entity->getName())));
        }
    }
}