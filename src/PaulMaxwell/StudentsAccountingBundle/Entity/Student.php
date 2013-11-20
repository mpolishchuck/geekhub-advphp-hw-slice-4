<?php

namespace PaulMaxwell\StudentsAccountingBundle\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="ls_student")
 */
class Student
{

    /**
     * @Mapping\Column(type="integer")
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Mapping\JoinColumn(name="id_person", nullable=false)
     * @Mapping\ManyToOne(targetEntity="Person", cascade={"persist"})
     */
    protected $person;

    /**
     * @Mapping\JoinColumn(name="id_group", nullable=false)
     * @Mapping\ManyToOne(targetEntity="Group", cascade={"persist"})
     */
    protected $group;

    /**
     * @Mapping\JoinColumn(name="id_entrant_year", nullable=false)
     * @Mapping\ManyToOne(targetEntity="AcademicYear", cascade={"persist"})
     */
    protected $entrantYear;

    /**
     * @Mapping\Column(name="accounting_number", type="integer")
     */
    protected $accountingNumber;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $accountingNumber
     */
    public function setAccountingNumber($accountingNumber)
    {
        $this->accountingNumber = $accountingNumber;
    }

    /**
     * @return integer
     */
    public function getAccountingNumber()
    {
        return $this->accountingNumber;
    }

    /**
     * @param AcademicYear $entrantYear
     */
    public function setEntrantYear($entrantYear)
    {
        $this->entrantYear = $entrantYear;
    }

    /**
     * @return AcademicYear
     */
    public function getEntrantYear()
    {
        return $this->entrantYear;
    }

    /**
     * @param Group $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
