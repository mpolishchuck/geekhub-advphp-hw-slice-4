<?php

namespace PaulMaxwell\StudentsAccountingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="ls_group")
 */
class Group
{

    /**
     * @Mapping\Column(type="integer")
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Mapping\JoinColumn(name="id_speciality", nullable=false)
     * @Mapping\ManyToOne(targetEntity="Speciality", cascade={"persist"})
     */
    protected $speciality;

    /**
     * @Mapping\Column(type="string", length=32)
     */
    protected $title;

    /**
     * @Mapping\Column(type="integer")
     */
    protected $course;

    /**
     * @Mapping\JoinColumn(name="id_founding_year", nullable=false)
     * @Mapping\ManyToOne(targetEntity="AcademicYear", cascade={"persist"})
     */
    protected $foundingYear;

    /**
     * @Mapping\ManyToMany(targetEntity="Teacher", mappedBy="groups")
     */
    protected $teachers;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    /**
     * @return integer
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param AcademicYear $foundingYear
     */
    public function setFoundingYear($foundingYear)
    {
        $this->foundingYear = $foundingYear;
    }

    /**
     * @return AcademicYear
     */
    public function getFoundingYear()
    {
        return $this->foundingYear;
    }

    /**
     * @param Speciality $speciality
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;
    }

    /**
     * @return Speciality
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return ArrayCollection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }
}
