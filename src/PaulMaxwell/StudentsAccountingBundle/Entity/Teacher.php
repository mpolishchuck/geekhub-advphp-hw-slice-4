<?php

namespace PaulMaxwell\StudentsAccountingBundle\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="teacher")
 */
class Teacher
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
     * @Mapping\Column(type="string")
     */
    protected $subject;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
