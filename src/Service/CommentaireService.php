<?php

namespace App\Service;

use App\entity\BlogPost;
use App\entity\Commentaire;
use App\entity\Peinture;
use App\entity\Sculpture;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireService
{
    private $manager;

    public function __construct(
        EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function persistCommentaire(
        Commentaire $commentaire,
        BlogPost $blogPost = null,
        Peinture $peinture = null,
        Sculpture $sculpture = null,
    ):void {
        $commentaire->setIsPublished(false)
                    ->setBlogPost($blogPost)
                    ->setPeinture($peinture)
                    ->setSculpture($sculpture)
                    ->setCreatedAt(new DateTimeImmutable('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();
    }
}