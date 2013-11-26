<?php

namespace PaulMaxwell\StudentsAccountingBundle;

use PaulMaxwell\StudentsAccountingBundle\Entity\Student;
use Psr\Log\LoggerInterface;

class StudentRemovalReporter
{
    protected $mailer = null;
    protected $adminEmail = null;
    protected $logger = null;

    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function reportStudentRemoved(Student $student)
    {
        if ($this->logger instanceof LoggerInterface) {
            $this->logger->info(sprintf(
               "Student removed: %s - %s %s %s",
                $student->getAccountingNumber(),
                $student->getPerson()->getNameLast(),
                $student->getPerson()->getNameFirst(),
                $student->getPerson()->getNamePatronymic()
            ));
        }

        if ($this->mailer instanceof \Swift_Mailer) {
            /**
             * @var \Swift_Message $message
             */
            $message = $this->mailer->createMessage();
            $message->setTo(array($this->adminEmail));
            $message->setFrom($this->adminEmail);
            $message->setSubject("Student removal reporting");
            $message->setBody(sprintf(
                "Student removed: %s - %s %s %s",
                $student->getAccountingNumber(),
                $student->getPerson()->getNameLast(),
                $student->getPerson()->getNameFirst(),
                $student->getPerson()->getNamePatronymic()
            ));
            $this->mailer->send($message);
        }
    }
}
