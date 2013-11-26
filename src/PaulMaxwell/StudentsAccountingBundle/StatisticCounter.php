<?php

namespace PaulMaxwell\StudentsAccountingBundle;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query;

class StatisticCounter
{
    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $doctrine;

    protected $studentsCount = null;
    protected $teachersCount = null;
    protected $groupsCount = null;
    protected $specialitiesCount = null;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getStudentsCount($force = false)
    {
        if (($this->studentsCount === null) || $force) {
            /**
             * @var Query $query
             */
            $query = $this->doctrine->getManager()
                ->createQuery('SELECT COUNT(t) FROM PaulMaxwellStudentsAccountingBundle:Student t');
            $this->studentsCount = $query->getSingleScalarResult();
        }

        return $this->studentsCount;
    }

    public function getTeachersCount($force = false)
    {
        if (($this->teachersCount === null) || $force) {
            /**
             * @var Query $query
             */
            $query = $this->doctrine->getManager()
                ->createQuery('SELECT COUNT(t) FROM PaulMaxwellStudentsAccountingBundle:Teacher t');
            $this->teachersCount = $query->getSingleScalarResult();
        }

        return $this->teachersCount;
    }

    public function getGroupsCount($force = false)
    {
        if (($this->groupsCount === null) || $force) {
            /**
             * @var Query $query
             */
            $query = $this->doctrine->getManager()
                ->createQuery('SELECT COUNT(t) FROM PaulMaxwellStudentsAccountingBundle:Group t');
            $this->groupsCount = $query->getSingleScalarResult();
        }

        return $this->groupsCount;
    }

    public function getSpecialitiesCount($force = false)
    {
        if (($this->specialitiesCount === null) || $force) {
            /**
             * @var Query $query
             */
            $query = $this->doctrine->getManager()
                ->createQuery('SELECT COUNT(t) FROM PaulMaxwellStudentsAccountingBundle:Speciality t');
            $this->specialitiesCount = $query->getSingleScalarResult();
        }

        return $this->specialitiesCount;
    }
}
