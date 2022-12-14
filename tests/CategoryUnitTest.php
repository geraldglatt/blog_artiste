<?php

namespace App\Tests;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $category = new Category();

        $category->setNom('nom')
                 ->setDescription('description')
                 ->setSlug('slug');

        $this->assertTrue($category->getNom() === 'nom');
        $this->assertTrue($category->getDescription() === 'description');
        $this->assertTrue($category->getSlug() === 'slug');
    }

    public function testIsFalse()
    {
        $category = new Category();

        $category->setNom('nom')
                 ->setDescription('description')
                 ->setSlug('slug');

        $this->assertFalse($category->getNom() === 'false');
        $this->assertFalse($category->getDescription() === 'false');
        $this->assertFalse($category->getSlug() === 'false');
    }

    public function testIsEmpty()
    {
        $category = new Category();

        $this->assertEmpty($category->getNom());
        $this->assertEmpty($category->getDescription());
        $this->assertEmpty($category->getSlug());
    }
}
