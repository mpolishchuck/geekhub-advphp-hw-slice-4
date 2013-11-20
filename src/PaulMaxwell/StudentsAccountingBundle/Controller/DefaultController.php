<?php

namespace PaulMaxwell\StudentsAccountingBundle\Controller;

use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use PaulMaxwell\StudentsAccountingBundle\Entity\Speciality;
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

    public function groupsListAction($id_speciality = null)
    {
        $specialityRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Speciality');
        $groupRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group');

        if ($id_speciality === null) {
            $groups = $groupRepository->findAll();
            $twigContext = array(
                'groups' => $groups,
            );
        } else {
            /**
             * @var Speciality $speciality
             */
            $speciality = $specialityRepository->findOneById($id_speciality);
            $groups = $groupRepository->findBySpeciality($speciality);
            $twigContext = array(
                'groups' => $groups,
                'criteria' => array(
                    sprintf('Displaying groups from "%s" speciality', $speciality->getCode() . ' ' . $speciality->getTitle()),
                ),
            );
        }

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:groups_list.html.twig', $twigContext);
    }

    public function studentsListAction($id_group = null)
    {
        $studentRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Student');
        $groupRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group');

        if ($id_group === null) {
            $students = $studentRepository->findAll();
            $twigContext = array(
                'students' => $students,
            );
        } else {
            /**
             * @var Group $group
             */
            $group = $groupRepository->findOneById($id_group);
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

    public function studentsRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $studentRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Student');
        $student = $studentRepository->findOneById($id);
        $em->remove($student);
        $em->flush();

        return $this->redirect($this->generateUrl('paul_maxwell_students_accounting_students'));
    }

    public function teachersListAction()
    {
        $teacherRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Teacher');

        $teachers = $teacherRepository->findAll();

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:teachers_list.html.twig', array(
            'teachers' => $teachers,
        ));
    }
}
