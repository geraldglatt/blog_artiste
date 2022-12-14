<?php

namespace App\Tests;

use App\Entity\BlogPost;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class BlogPostUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $BlogPost = new BlogPost();
        $dateTime = new DateTimeImmutable();

        $BlogPost->setTitre('titre')
                 ->setCreatedAt($dateTime)
                 ->setContenu('contenu')
                 ->setSlug('slug');

        $this->assertTrue($BlogPost->getTitre() === 'titre');
        $this->assertTrue($BlogPost->getCreatedAt() === $dateTime);
        $this->assertTrue($BlogPost->getContenu() === 'contenu');
        $this->assertTrue($BlogPost->getSlug() === 'slug');
    }

    public function testIsFalse()
    {
        $BlogPost = new BlogPost();
        $dateTime = new DateTimeImmutable();

        $BlogPost->setTitre('titre')
                 ->setCreatedAt($dateTime)
                 ->setContenu('contenu')
                 ->setSlug('slug');

        $this->assertFalse($BlogPost->getTitre() === 'false');
        $this->assertFalse($BlogPost->getCreatedAt() === new DateTimeImmutable());
        $this->assertFalse($BlogPost->getContenu() === 'false');
        $this->assertFalse($BlogPost->getSlug() === 'false');
    }

    public function testIsEmpty()
    {
        $BlogPost = new BlogPost();

        $this->assertEmpty($BlogPost->getTitre());
        $this->assertEmpty($BlogPost->getCreatedAt());
        $this->assertEmpty($BlogPost->getContenu());
        $this->assertEmpty($BlogPost->getSlug());
    }
}
