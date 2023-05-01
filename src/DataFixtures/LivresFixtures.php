<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Livres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr-FR');
        for ($j = 1; $j <= 3; $j++) {
            $cat = new Categories();
            $cat->setLibelle($faker->name());
            $cat->setDescription($faker->text());
            $manager->persist($cat);
            for ($i = 1; $i <= random_int(5, 15); $i++) {

                $livre = new Livres();
                $livre->setLibelle($faker->name())
                    ->setPrix(random_int(50, 400))
                    ->setDateEdition(new \DateTime("01-01-2022"))
                    ->setImage("https://via.placeholder.com/300")
                    ->setEditeur($faker->company())
                    ->setResume($faker->text())
                    ->setCategorie($cat);
                $manager->persist($livre);
            }
        }

        $manager->flush();
    }
}
