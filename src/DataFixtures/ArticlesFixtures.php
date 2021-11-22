<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
        $faker = Faker\Factory::create('fr_FR');

        // Creer occurence de 8 Auteurs
        for ($k = 0; $k<8; $k++) {
            $auteurs = new Auteurs();
            $auteurs->setNom($faker->firstName())
                ->setPrenom($faker->lastName())
                ->setMail($faker->sentence());
            $manager->persist($auteurs);


            for ($i = 0; $i < 5; $i++) {
                $categories = new Categorie();

                $categories->setTitre($faker->sentence())
                    ->setResume($faker->sentence());

                $manager->persist($categories);

                // Mainteannt je cree mes Articles

                for ($j = 0; $j < 10; $j++) {
                    $articles = new Articles();

                    $articles->setTitre($faker->sentence())
                        ->setImages($faker->imageUrl())
                        ->setResume($faker->sentence())
                        ->setContenu($faker->sentence())
                        ->setDate(new \DateTime())
                        ->setCategorie($categories)
                        ->setAuteurs($auteurs);
                        $manager->persist($articles);
                    
                }
            }
        }

        $manager->flush();
    }
}
