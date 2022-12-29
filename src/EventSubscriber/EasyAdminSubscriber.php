<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
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
            BeforeEntityPersistedEvent::class => ['setBlogPostSlugAndDateAndUser']
        ];
    }

    public function setBlogPostSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if(!($entity instanceof BlogPost)){
            return;
        }

        $slug = $this->slugger->slug($entity->getTitre());
        $entity->setSlug($slug);

        $now = new DateTimeImmutable('now');
        $entity->getCreatedAt($now);

        $user = $this->security->getUser();
        $entity->setUser($user);
    }
}