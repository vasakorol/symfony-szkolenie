<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\LoadUserData;

class TaskControllerTest extends WebTestCase
{
    public function testAddTask()
    {
        $fixtures = $this->loadFixtures([LoadUserData::class])->getReferenceRepository();
        $client = static::createClient();
        $crawler = $client->request('GET', '/task');
        $this->assertEquals(
            1,
            $crawler->filter('html:contains("Welcome to the Task:index page")')->count()
        );
        $form = $crawler->selectButton('Create')->form();
        $crawler = $client->submit($form, ['appbundle_task[name]' => 'foo']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('ol li')->count());
        $this->assertEquals('foo', $crawler->filter('ol li')->first()->text());

    }
}