<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\Sculpture;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $commentaire = new Commentaire();
        $dateTime = new DateTimeImmutable();
        $blogPost = new BlogPost();
        $peinture = new Peinture();
        $sculpture = new Sculpture();

        $commentaire->setAuteur('auteur')
                    ->setEmail('email@test.fr')
                    ->setContenu('contenu')
                    ->setCreatedAt($dateTime)
                    ->setBlogPost($blogPost)
                    ->setPeinture($peinture)
                    ->setSculpture($sculpture);

        $this->assertTrue($commentaire->getAuteur() === 'auteur');
        $this->assertTrue($commentaire->getEmail() === 'email@test.fr');
        $this->assertTrue($commentaire->getContenu() === 'contenu');
        $this->assertTrue($commentaire->getCreatedAt() === $dateTime);
        $this->assertTrue($commentaire->getBlogPost() === $blogPost);
        $this->assertTrue($commentaire->getPeinture() === $peinture);
    }

    public function testIsFalse()
    {
        $commentaire = new Commentaire();
        $dateTime = new DateTimeImmutable();
        $blogPost = new BlogPost();
        $peinture = new Peinture();

        $commentaire->setAuteur('auteur')
                    ->setEmail('email@test.fr')
                    ->setContenu('contenu')
                    ->setCreatedAt($dateTime)
                    ->setBlogPost($blogPost)
                    ->setPeinture($peinture);

        $this->assertFalse($commentaire->getAuteur() === 'false');
        $this->assertFalse($commentaire->getEmail() === 'false@test.fr');
        $this->assertFalse($commentaire->getContenu() === 'false');
        $this->assertFalse($commentaire->getCreatedAt() === new DateTimeImmutable());
        $this->assertFalse($commentaire->getBlogPost() === new BlogPost);
        $this->assertFalse($commentaire->getPeinture() === new Peinture);
    }

    public function testIsEmpty()
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getEmail());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getCreatedAt());
        $this->assertEmpty($commentaire->getBlogPost());
        $this->assertEmpty($commentaire->getPeinture());
    }
}
