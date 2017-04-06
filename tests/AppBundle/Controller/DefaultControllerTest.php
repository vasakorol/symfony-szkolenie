<?php

namespace Tests\AppBundle\Controller;

use AppBundle\DataFixtures\ORM\LoadUserData;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexNotLogged()
    {
        $fixtures = $this->loadFixtures([LoadUserData::class])->getReferenceRepository();

        $client = $this->makeClient();
        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(200, $client);
    }

    public function testIndexLogged()
    {
        $fixtures = $this->loadFixtures([LoadUserData::class])->getReferenceRepository();
        $user = $fixtures->getReference('user');

        $client = $this->makeClient(['username' => $user->getUsername(), 'password' => 'password']);
        $crawler = $client->request('GET', '/task');

        $this->assertStatusCode(200, $client);
    }
}
