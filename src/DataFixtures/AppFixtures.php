<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Category;
use App\Entity\Peinture;
use App\Entity\Sculpture;
use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $encoder;
    protected $slugger;

    public function __construct(UserPasswordHasherInterface $hasher, SluggerInterface $slugger)
    {
        $this->hasher = $hasher;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        //utilisation de Faker
        $faker = Factory::create('fr_FR');
        //
        $user = new User();

        $user->setEmail('user@test.fr')
             ->setPrenom($faker->firstName())
             ->setNom($faker->lastName())
             ->setTelephone($faker->phoneNumber())
             ->setAPropos($faker->text(200))
             ->setInstagram('instagram')
             ->setRoles(['ROLE_PEINTRE']);

        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        // Créations de 10 blogpost
        for ($i =0;$i <10;$i++) {
            $blogPost = new BlogPost();

            $blogPost->setTitre($faker->words(3, true))
                     ->setCreatedAt(new DateTimeImmutable('-6 month'))
                     ->setContenu($faker->text(350))
                     ->setSlug(strtolower($this->slugger->slug($blogPost->getTitre())))
                     ->setUser($user);

            $manager->persist($blogPost);
        }

        //ici on se crée un tableau de peinture
        $peinture = [];

        //Créations de 5 catégories
        for ($k=0; $k < 5; $k++) {
            $categorie = new Category();

            $categorie->setNom($faker->words(3, true))
                    ->setDescription($faker->words(10, true))
                    ->setSlug(strtolower($this->slugger->slug($categorie->getNom())));

            $manager->persist($categorie);

            //Création de 3 peintures/categories
            for ($j = 0; $j < 3; $j++) {
                $peinture = new Peinture();

                $peinture->setNom($faker->words(3, true))
                        ->setLargeur($faker->randomFloat(2, 20, 60))
                        ->setHauteur($faker->randomFloat(2, 20, 60))
                        ->setEnVente($faker->randomElement([true, false]))
                        ->setDateRealisation(new DateTimeImmutable('-3 month'))
                        ->setCreatedAt(new DateTimeImmutable('-3 month'))
                        ->setDescription($faker->text(50))
                        ->setPortfolio($faker->randomElement([true, false]))
                        ->setSlug(strtolower($this->slugger->slug($peinture->getNom())))
                        ->setFile('/img/8cf81d_d7b4ff0e1e5ddc7b7e7c5ec8bc23e2a1.webp')
                        ->addCategorie($categorie)
                        ->setPrix($faker->randomFloat(2, 100, 9999))
                        ->setUser($user);

                $manager->persist($peinture);
            }

            //Création de 3 sculptures/categories
            for ($l = 0; $l < 3; $l++) {
                $sculpture = new Sculpture();

                $sculpture->setNom($faker->words(3, true))
                        ->setLargeur($faker->randomFloat(2, 20, 60))
                        ->setHauteur($faker->randomFloat(2, 20, 60))
                        ->setEnVente($faker->randomElement([true, false]))
                        ->setDateRealisation(new DateTimeImmutable('-4 month'))
                        ->setCreatedAt(new DateTimeImmutable('-2 month'))
                        ->setDescription($faker->text(50))
                        ->setPortfolio($faker->randomElement([true, false]))
                        ->setSlug(strtolower($this->slugger->slug($sculpture->getNom())))
                        ->setFile('/img/16358539_zero-gravity-01-61x24x10cm-2-3kg-iron-tufa-2022-450.jpeg')
                        ->addCategorie($categorie)
                        ->setPrix($faker->randomFloat(2, 100, 9999))
                        ->setUser($user);

                $manager->persist($sculpture);
            }

            
        }
        $manager->flush();

    }
}