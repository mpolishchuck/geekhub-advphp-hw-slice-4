<?php

namespace PaulMaxwell\StudentsAccountingBundle\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="group")
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
     * @param AcademicYear $idFoundingYear
     */
    public function setFoundingYear($idFoundingYear)
    {
        $this->foundingYear = $idFoundingYear;
    }

    /**
     * @return AcademicYear
     */
    public function getFoundingYear()
    {
        return $this->foundingYear;
    }

    /**
     * @param Speciality $idSpeciality
     */
    public function setSpeciality($idSpeciality)
    {
        $this->speciality = $idSpeciality;
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


}
