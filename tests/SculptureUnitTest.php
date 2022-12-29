<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Sculpture;
use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class SculptureUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $sculpture = new Sculpture();
        $dateTime = new DateTimeImmutable();
        $category = new Category();
        $user = new User();

        $sculpture->setNom('nom')
                 ->setLargeur(20.20)
                 ->setHauteur(20.20)
                 ->setEnVente(true)
                 ->setDateRealisation($dateTime)
                 ->setCreatedAt($dateTime)
                 ->setDescription('description')
                 ->setPortfolio(true)
                 ->setSlug('slug')
                 ->setFile('file')
                 ->addCategorie($category)
                 ->setPrix(20.20)
                 ->setUser($user);

        $this->assertTrue($sculpture->getNom() === 'nom');
        $this->assertTrue($sculpture->getLargeur() == 20.20);
        $this->assertTrue($sculpture->getHauteur() == 20.20);
        $this->assertTrue($sculpture->isEnVente() === true);
        $this->assertTrue($sculpture->getDateRealisation() === $dateTime);
        $this->assertTrue($sculpture->getCreatedAt() === $dateTime);
        $this->assertTrue($sculpture->getDescription() === 'description');
        $this->assertTrue($sculpture->isPortfolio() === true);
        $this->assertTrue($sculpture->getSlug() === 'slug');
        $this->assertTrue($sculpture->getFile() === 'file');
        $this->assertContains($category, $sculpture->getCategorie());
        $this->assertTrue($sculpture->getPrix() == 20.20);
        $this->assertTrue($sculpture->getUser() === $user);

    }

    public function testIsFalse()
    {
        $sculpture = new Sculpture();
        $dateTime = new DateTimeImmutable();
        $category = new Category();
        $user = new User();

        $sculpture->setNom('nom')
                 ->setLargeur(20.20)
                 ->setHauteur(20.20)
                 ->setEnVente(true)
                 ->setDateRealisation($dateTime)
                 ->setCreatedAt($dateTime)
                 ->setDescription('description')
                 ->setPortfolio(true)
                 ->setSlug('slug')
                 ->setFile('file')
                 ->addCategorie($category)
                 ->setPrix(20.20)
                 ->setUser($user);

        $this->assertFalse($sculpture->getNom() === 'false');
        $this->assertFalse($sculpture->getLargeur() == 22.20);
        $this->assertFalse($sculpture->getHauteur() == 22.20);
        $this->assertFalse($sculpture->isEnVente() === false);
        $this->assertFalse($sculpture->getDateRealisation() === new DateTimeImmutable());
        $this->assertFalse($sculpture->getCreatedAt() === new DateTimeImmutable());
        $this->assertFalse($sculpture->getDescription() === 'false');
        $this->assertFalse($sculpture->isPortfolio() === false);
        $this->assertFalse($sculpture->getSlug() === 'false');
        $this->assertFalse($sculpture->getFile() === 'false');
        $this->assertNotContains(new Category, $sculpture->getCategorie());
        $this->assertFalse($sculpture->getPrix() == 22.20);
        $this->assertFalse($sculpture->getUser() === new User);

    }

    public function testIsEmpty()
    {
        $sculpture = new Sculpture();

        $this->assertEmpty($sculpture->getNom());
        $this->assertEmpty($sculpture->getLargeur());
        $this->assertEmpty($sculpture->getHauteur());
        $this->assertEmpty($sculpture->isEnVente());
        $this->assertEmpty($sculpture->getDateRealisation());
        $this->assertEmpty($sculpture->getCreatedAt());
        $this->assertEmpty($sculpture->getDescription());
        $this->assertEmpty($sculpture->isPortfolio());
        $this->assertEmpty($sculpture->getSlug());
        $this->assertEmpty($sculpture->getFile());
        $this->assertEmpty($sculpture->getCategorie());
        $this->assertEmpty($sculpture->getPrix());
        $this->assertEmpty($sculpture->getUser());

    }
}
