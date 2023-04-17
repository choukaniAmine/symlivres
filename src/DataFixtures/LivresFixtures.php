<?php

namespace App\DataFixtures;

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
        for ($i = 1; $i <= 100; $i++) {

            $livre = new Livres();
            $livre->setLibelle($faker->name)
                ->setPrix(random_int(50, 400))
                ->setDateEdition(new \DateTime("01-01-2022"))
                ->setImage("https://via.placeholder.com/300")
                ->setEditeur($faker->company())
                ->setResume($faker->text());
            $manager->persist($livre);
        }


        $manager->flush();
    }
}
