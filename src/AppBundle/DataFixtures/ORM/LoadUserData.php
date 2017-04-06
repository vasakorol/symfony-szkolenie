<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager) {

        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('user');
        $user->setEmail('email@email.com');
        $user->setPlainPassword('password');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_USER']);
        $user->setReference('user', $user);

        $userManager->updateUser($user, true);
    }
}