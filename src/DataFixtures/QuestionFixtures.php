<?php

namespace App\DataFixtures;

use App\Entity\Questiontab;
use App\Entity\Reponsetab;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=\Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 4; $i++){
            $question=new Questiontab();
            $question->setQuestions($faker->paragraph(1));
            $manager->persist($question);
            for ($j=1; $j<=mt_rand(3,4); $j++){

                $reponse=new Reponsetab();
                $reponse->setReponses($faker->paragraph(1))
                    ->setQuestion($question)
                    ->setStatu(false);

                $manager->persist($reponse);
            }
        }

        $manager->flush();
    }
}
