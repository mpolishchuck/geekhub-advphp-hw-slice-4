<?php

namespace PaulMaxwell\StudentsAccountingBundle\Controller;

use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:index.html.twig');
    }

    public function specialitiesListAction()
    {
        $specialities = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Speciality')->findAll();

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:specialities_list.html.twig', array(
            'specialities' => $specialities,
        ));
    }

    public function groupsListAction()
    {
        $groups = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group')->findAll();

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:groups_list.html.twig', array(
            'groups' => $groups,
        ));
    }

    public function studentsListAction($id_group = null)
    {
        $studentRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Student');
        $groupRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group');

        /**
         * @var Group $group
         */
        $group = $groupRepository->findOneById($id_group);
        if ($id_group === null) {
            $students = $studentRepository->findAll();
            $twigContext = array(
                'students' => $students,
            );
        } else {
            $students = $studentRepository->findByGroup($group);
            $twigContext = array(
                'students' => $students,
                'criteria' => array(
                    sprintf('Displaying students from "%s" group', $group->getTitle()),
                ),
            );
        }

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:students_list.html.twig', $twigContext);
    }
}
