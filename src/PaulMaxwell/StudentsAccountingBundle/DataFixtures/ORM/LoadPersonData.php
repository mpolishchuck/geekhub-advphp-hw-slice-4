<?php

namespace PaulMaxwell\StudentsAccountingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaulMaxwell\StudentsAccountingBundle\Entity\Person;
use Symfony\Component\Yaml\Yaml;

class LoadPersonData implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $personData = Yaml::parse(__DIR__ . '/data/persondata.yml');

        for ($i = 0; $i < 50; $i++) {
            $nameLast = $personData['last'][mt_rand(0, count($personData['last']) - 1)];
            if (mt_rand(0, 10) > 5) {
                $nameFirst = $personData['first']['male'][mt_rand(0, count($personData['first']['male']) - 1)];
                $namePatronymic = $personData['patronymic']['male'][mt_rand(0, count($personData['patronymic']['male']) - 1)];
            } else {
                $nameFirst = $personData['first']['female'][mt_rand(0, count($personData['first']['female']) - 1)];
                $namePatronymic = $personData['patronymic']['female'][mt_rand(0, count($personData['patronymic']['female']) - 1)];
            }

            $person = new Person();
            $person->setNameLast($nameLast);
            $person->setNameFirst($nameFirst);
            $person->setNamePatronymic($namePatronymic);
            $dateOfBirth = new \DateTime();
            $dateOfBirth->setDate(mt_rand(1950, 2000), mt_rand(1,12), mt_rand(1,25));
            $person->setDateOfBirth($dateOfBirth);

            $manager->persist($person);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
