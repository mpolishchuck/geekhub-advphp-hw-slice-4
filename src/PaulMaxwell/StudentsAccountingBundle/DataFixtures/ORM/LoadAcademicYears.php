<?php

namespace PaulMaxwell\StudentsAccountingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaulMaxwell\StudentsAccountingBundle\Entity\AcademicYear;

class LoadAcademicYears implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $academicYear = new AcademicYear();
            $academicYear->setTitle((2000 + $i) . '/' . (2001 + $i));

            $manager->persist($academicYear);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
