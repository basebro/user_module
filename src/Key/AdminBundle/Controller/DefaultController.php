<?php

namespace Key\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KeyAdminBundle:Default:index.html.twig');
    }
    public function usersAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        dump($users[0]->getPasswordRequestedAt());

        return $this->render('KeyAdminBundle:Default:users.html.twig', array('users' => $users));
    }
}
