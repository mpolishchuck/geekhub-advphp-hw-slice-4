<?php

namespace PaulMaxwell\StudentsAccountingBundle\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="academic_year")
 */
class AcademicYear
{

    /**
     * @Mapping\Column(type="integer")
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Mapping\Column(type="string", length=32)
     */
    protected $title;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
