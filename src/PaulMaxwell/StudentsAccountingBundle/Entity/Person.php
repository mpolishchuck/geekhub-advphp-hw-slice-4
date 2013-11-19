<?php

namespace PaulMaxwell\StudentsAccountingBundle\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="person")
 */
class Person
{

    /**
     * @Mapping\Column(type="integer")
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Mapping\Column(name="name_last", type="string", length=64)
     */
    protected $nameLast;

    /**
     * @Mapping\Column(name="name_first", type="string", length=64)
     */
    protected $nameFirst;

    /**
     * @Mapping\Column(name="name_patronymic", type="string", length=64)
     */
    protected $namePatronymic;

    /**
     * @Mapping\Column(name="date_of_birth", type="date")
     */
    protected $dateOfBirth;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $nameFirst
     */
    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;
    }

    /**
     * @return string
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * @param string $nameLast
     */
    public function setNameLast($nameLast)
    {
        $this->nameLast = $nameLast;
    }

    /**
     * @return string
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * @param string $namePatronymic
     */
    public function setNamePatronymic($namePatronymic)
    {
        $this->namePatronymic = $namePatronymic;
    }

    /**
     * @return string
     */
    public function getNamePatronymic()
    {
        return $this->namePatronymic;
    }


}
