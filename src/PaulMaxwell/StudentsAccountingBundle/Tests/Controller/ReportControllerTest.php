<?php

namespace PaulMaxwell\StudentsAccountingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testGroupsofteacher()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groups/byteacher/{id_teacher}');
    }

    public function testTeachersofgroup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/teachers/bygroup/{id_group}');
    }

}
