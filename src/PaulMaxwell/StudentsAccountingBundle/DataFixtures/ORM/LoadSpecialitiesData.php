<?php

namespace PaulMaxwell\StudentsAccountingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaulMaxwell\StudentsAccountingBundle\Entity\Speciality;
use Symfony\Component\Yaml\Yaml;

class LoadSpecialitiesData implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $specialities = Yaml::parse(__DIR__ . '/data/specialities.yml');

        for ($i = 0, $j = count($specialities); $i < $j; $i++) {
            $speciality = new Speciality();
            $speciality->setCode($specialities[$i]['code']);
            $speciality->setTitle($specialities[$i]['title']);

            $manager->persist($speciality);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
