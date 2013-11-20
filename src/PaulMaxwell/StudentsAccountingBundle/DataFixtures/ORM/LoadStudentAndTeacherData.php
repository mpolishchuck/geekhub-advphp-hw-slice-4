<?php

namespace PaulMaxwell\StudentsAccountingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use PaulMaxwell\StudentsAccountingBundle\Entity\Person;
use PaulMaxwell\StudentsAccountingBundle\Entity\Student;
use PaulMaxwell\StudentsAccountingBundle\Entity\Teacher;
use Symfony\Component\Yaml\Yaml;

class LoadStudentAndTeacherData implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        /**
         * @var Person[] $persons
         */
        $persons = $manager->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Person')->findAll();
        /**
         * @var Group[] $groups
         */
        $groups = $manager->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group')->findAll();

        $subjects = Yaml::parse(__DIR__ . '/data/subjects.yml');
        for ($i = 0, $j = count($subjects); $i < $j; $i++) {
            $personKeys = array_keys($persons);
            $personKey = $personKeys[mt_rand(0, count($personKeys) - 1)];

            $person = $persons[$personKey];

            $teacher = new Teacher();
            $teacher->setPerson($person);
            $teacher->setSubject($subjects[$i]);

            $manager->persist($teacher);
            unset($persons[$personKey]);
        }

        $persons = array_values($persons);

        for ($i = 0, $j = count($persons); $i < $j; $i++) {
            $group = $groups[mt_rand(0, count($groups) - 1)];

            $student = new Student();
            $student->setPerson($persons[$i]);
            $student->setAccountingNumber(mt_rand(10000, 99999));
            $student->setEntrantYear($group->getFoundingYear());
            $student->setGroup($group);

            $manager->persist($student);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 5;
    }
}
