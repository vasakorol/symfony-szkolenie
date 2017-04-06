<?php

namespace Tests\AppBundle\Controller;

use AppBundle\DataFixtures\ORM\LoadUserData;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /*
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
    */
    
    public function testIndexNotLogged()
    {
        $fixtures = $this->loadFixtures([LoadUserData::class])->getReferenceRepository();
        
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(302, $client);
    }

    public function testIndexLogged()
    {
        $fixtures = $this->loadFixtures([LoadUserData::class])->getReferenceRepository();
        $user = $fixtures->getReference('user');
        
        $client = $this->makeClient(['username' => $user->getUsername(), 'password' => 'tester']);
        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(200, $client);
    }
    
    
    /**
     * $group functional
     */
    public function testIndex() {
        $fixtures=$this->loadFixtures([
            LoadUserData::class
        ])->getReferanceRepository();
        
        $user = $fixtures->getReferance('user');
        
        /**
         * @var $user User
         */
        $client = $this->makeClient([
            'username'=>$user->getUsername(),
            'password'=>'password',
        ]);
        
        $crawler = $client->request('GET', '/');
        $this->assertStatusCode(200, $client);
        //$this->assertContains('No tasks', $crawler->filter());
    }
}
