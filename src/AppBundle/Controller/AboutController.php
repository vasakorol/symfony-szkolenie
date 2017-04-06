<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AboutController extends Controller
{
    /**
     * @Route("/about/add")
     */
    public function addAction()
    {



        return $this->render('AppBundle:About:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/about/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:About:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/about/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:About:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/about")
     */
    public function indexAction()
    {

        return $this->render('AppBundle:About:index.html.twig', array(
            // ...
        ));
    }

}
