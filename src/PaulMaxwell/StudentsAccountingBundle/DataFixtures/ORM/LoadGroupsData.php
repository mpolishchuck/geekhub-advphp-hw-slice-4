<?php

namespace PaulMaxwell\StudentsAccountingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaulMaxwell\StudentsAccountingBundle\Entity\AcademicYear;
use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use PaulMaxwell\StudentsAccountingBundle\Entity\Speciality;

class LoadGroupsData implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        /**
         * @var Speciality[] $specialities
         */
        $specialities = $manager->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Speciality')->findAll();
        /**
         * @var AcademicYear[] $academicYears
         */
        $academicYears = $manager->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\AcademicYear')->findAll();

        for ($i = 0, $j = count($academicYears); $i < $j; $i++) {
            /**
             * @var Speciality $speciality
             */
            $speciality = $specialities[mt_rand(0, count($specialities) - 1)];
            /**
             * @var AcademicYear $academicYear
             */
            $academicYear = $academicYears[mt_rand(0, count($academicYears) - 1)];

            $group = new Group();
            $group->setSpeciality($speciality);
            $group->setFoundingYear($academicYear);
            $group->setCourse(1);
            $group->setTitle(substr($speciality->getTitle(), 0, 2) . '-' . substr($academicYear->getTitle(), 2, 2));

            $manager->persist($group);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
