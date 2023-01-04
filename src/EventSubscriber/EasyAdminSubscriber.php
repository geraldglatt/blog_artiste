<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Peinture;
use App\Entity\Sculpture;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser']
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if(($entity instanceof BlogPost)){
            $now = new DateTimeImmutable('now');
            $entity->getCreatedAt($now);
    
            $user = $this->security->getUser();
            $entity->setUser($user);
        }

        if(($entity instanceof Peinture)){
            $now = new DateTimeImmutable('now');
            $entity->getCreatedAt($now);
    
            $user = $this->security->getUser();
            $entity->setUser($user);
        }

        if(($entity instanceof Sculpture)){
            $now = new DateTimeImmutable('now');
            $entity->getCreatedAt($now);
    
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    return;

    }
}