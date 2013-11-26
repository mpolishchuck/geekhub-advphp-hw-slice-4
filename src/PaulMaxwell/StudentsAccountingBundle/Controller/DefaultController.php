<?php

namespace PaulMaxwell\StudentsAccountingBundle\Controller;

use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use PaulMaxwell\StudentsAccountingBundle\Entity\Speciality;
use PaulMaxwell\StudentsAccountingBundle\StatisticCounter;
use PaulMaxwell\StudentsAccountingBundle\StudentRemovalReporter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /**
         * @var StatisticCounter $statisticCounter
         */
        $statisticCounter = $this->get('students_accounting.stat_counter');

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:index.html.twig', array(
            'students' => $statisticCounter->getStudentsCount(),
            'teachers' => $statisticCounter->getTeachersCount(),
            'groups' => $statisticCounter->getGroupsCount(),
            'specialities' => $statisticCounter->getSpecialitiesCount(),
        ));
    }

    public function specialitiesListAction()
    {
        /**
         * @var StatisticCounter $statisticCounter
         */
        $statisticCounter = $this->get('students_accounting.stat_counter');

        $specialities = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Speciality')->findAll();

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:specialities_list.html.twig', array(
            'specialities' => $specialities,
            'top_msg' => sprintf(
                'Totally we have %d specialities and %d groups.',
                $statisticCounter->getSpecialitiesCount(),
                $statisticCounter->getGroupsCount()
            ),
        ));
    }

    public function groupsListAction($id_speciality = null)
    {
        /**
         * @var StatisticCounter $statisticCounter
         */
        $statisticCounter = $this->get('students_accounting.stat_counter');

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
        $twigContext['top_msg'] = sprintf(
            'Totally we have %d groups, %d students and %d teachers.',
            $statisticCounter->getGroupsCount(),
            $statisticCounter->getStudentsCount(),
            $statisticCounter->getTeachersCount()
        );

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:groups_list.html.twig', $twigContext);
    }

    public function studentsListAction($id_group = null)
    {
        /**
         * @var StatisticCounter $statisticCounter
         */
        $statisticCounter = $this->get('students_accounting.stat_counter');

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
        $twigContext['top_msg'] = sprintf(
            'Totally we have %d students in %d groups.',
            $statisticCounter->getStudentsCount(),
            $statisticCounter->getGroupsCount()
        );

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:students_list.html.twig', $twigContext);
    }

    public function studentsRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $studentRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Student');
        $student = $studentRepository->findOneById($id);

        /**
         * @var StudentRemovalReporter $removalReporter
         */
        $removalReporter = $this->get('students_accounting.stud_remove_reporter');
        $removalReporter->reportStudentRemoved($student);

        $em->remove($student);
        $em->flush();

        return $this->redirect($this->generateUrl('paul_maxwell_students_accounting_students'));
    }

    public function teachersListAction()
    {
        /**
         * @var StatisticCounter $statisticCounter
         */
        $statisticCounter = $this->get('students_accounting.stat_counter');

        $teacherRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Teacher');

        $teachers = $teacherRepository->findAll();

        return $this->render('PaulMaxwellStudentsAccountingBundle:Default:teachers_list.html.twig', array(
            'teachers' => $teachers,
            'top_msg' => sprintf(
                'Totally we have %d teachers involved into %d groups.',
                $statisticCounter->getTeachersCount(),
                $statisticCounter->getGroupsCount()
            ),
        ));
    }
}
