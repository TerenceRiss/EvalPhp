<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Like;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Shoes;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user
                ->setFirstname($faker->firstName() . '_' . $faker->lastName())
                ->setLastname($faker->lastname() . '_' . $faker->lastname())
                ->setAdresse1($faker->text())
                ->setAdresse2($faker->text())
                ->setVille($faker->city())
                ->setCp($faker->numberBetween(1000,9000))
                ->setEmail($faker->safeEmail())
                ->setPassword($faker->sha256())
                ->setTelephone($faker->numberBetween(1000,1264))
                ->setRole(['ROLE_USER']);

                $users[] = $user;
                $manager->persist($user);
            }

            $Allshoes = [];

            for ($i = 0; $i < 10; $i++) {
                $shoes = new Shoes;
                $shoes
                ->setName($faker->word())
                ->setGender($faker->randomElement(['male', 'female','unisex']))
                ->setStock($faker->numberBetween(1,100))
                ->setPrice($faker->numberBetween(50,600))
                ->setSize($faker->numberBetween(36,56))
                ->setType($faker->randomElement(['sneakers', 'running', 'chaussure de ville']))
                ->setDescription($faker->text())
                ->setImage($faker->imageUrl(640, 480, 'shoes', true))
                ->setDate(new DateTimeImmutable())
                ;
                $Allshoes []=$shoes;
                $manager->persist($shoes);
            }

            $comments = [];
            for ($i = 0; $i < 10; $i++){

                $comment = new Comment;
                $comment 
                ->setContent($faker->text())
                ->setUser($faker->randomElement($users))
                ->setShoes($faker->randomElement($Allshoes));

                $comments=$comment;
                $manager->persist($comments);
            }

            $likes = [];
            for ($i = 0; $i < 10; $i++) {

            $like = new Like;
            $like
            ->setUser($faker->randomElement($users))
            ->setShoes($faker->randomElement($Allshoes));
            
            $likes=$like;
            $manager->persist($likes);
           }

            $manager->flush();
}

}
