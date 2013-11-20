<?php

namespace PaulMaxwell\StudentsAccountingBundle\Controller;

use PaulMaxwell\StudentsAccountingBundle\Entity\Group;
use PaulMaxwell\StudentsAccountingBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    public function groupsOfTeacherAction($id_teacher)
    {
        $teacherRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Teacher');
        $groupRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group');

        /**
         * @var Teacher $teacher
         */
        $teacher = $teacherRepository->findOneById($id_teacher);

        /**
         * Shaman three hands
         * Don't touch, works exclusively on magic
         */
        $groupsId = array_map(function (Group $group) {
            return $group->getId();
        }, $teacher->getGroups()->toArray());
        $groups = $groupRepository->findById($groupsId);

        return $this->render('PaulMaxwellStudentsAccountingBundle:Report:groups_of_teacher.html.twig', array(
            'groups' => $groups,
        ));
    }

    public function teachersOfGroupAction($id_group)
    {
        $groupRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Group');
        $teacherRepository = $this->getDoctrine()->getRepository('PaulMaxwell\StudentsAccountingBundle\Entity\Teacher');

        /**
         * @var Group $group
         */
        $group = $groupRepository->findOneById($id_group);

        /**
         * Shaman three hands
         * Don't touch, works exclusively on magic
         */
        $teachersId = array_map(function (Teacher $teacher) {
            return $teacher->getId();
        }, $group->getTeachers()->toArray());
        $teachers = $teacherRepository->findById($teachersId);

        return $this->render('PaulMaxwellStudentsAccountingBundle:Report:teachers_of_group.html.twig', array(
            'teachers' => $teachers,
        ));
    }

}
