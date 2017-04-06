<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @Route("/task")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(TaskType::class);
        return $this->render('AppBundle:Task:index.html.twig', array(
            'list' => $em->getRepository(Task::class)->findAll(),
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/task/add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($form->isValid()) {

            $task = $form->getData();
            $em->persist($task);
            $em->flush();
            $this->addFlash('success', 'Added');
        }
        $this->addFlash('warning', 'Somethign wrong');

        return $this->redirectToRoute('/task');
    }

}
