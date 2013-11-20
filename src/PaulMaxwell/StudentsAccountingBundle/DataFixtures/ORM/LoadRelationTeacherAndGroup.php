<?php

namespace PaulMaxwell\StudentsAccountingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use PaulMaxwell\StudentsAccountingBundle\Entity\Teacher;

class LoadRelationTeacherAndGroup implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $groupRepository = $manager->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group');
        $teacherRepository = $manager->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Teacher');

        /**
         * @var Group[] $groups
         */
        $groups = $groupRepository->findAll();
        /**
         * @var Teacher[] $teachers
         */
        $teachers = $teacherRepository->findAll();
        foreach ($groups as $group) {
            $teacherKeys = array_keys($teachers);
            for ($i = 0, $j = mt_rand(3,5); $i < $j; $i++) {
                $teacherKeyIndex = mt_rand(0, count($teacherKeys) - 1);

                $teacher = $teachers[$teacherKeys[$teacherKeyIndex]];
                /* Build bidirectional many-to-many link */
                $group->getTeachers()->add($teacher);
                $teacher->getGroups()->add($group);

                unset($teacherKeys[$teacherKeyIndex]);
                $teacherKeys = array_values($teacherKeys);
            }
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
        return 6;
    }
}