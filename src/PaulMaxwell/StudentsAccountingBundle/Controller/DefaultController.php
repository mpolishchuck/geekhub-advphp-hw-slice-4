<?php

namespace PaulMaxwell\StudentsAccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:index.html.twig');
    }

    public function specialitiesListAction()
    {
        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:index.html.twig');
    }

    public function groupsListAction()
    {
        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:index.html.twig');
    }

    public function studentsListAction()
    {
        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:index.html.twig');
    }
}
