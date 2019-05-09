<?php

namespace Key\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KeyAdminBundle:Default:index.html.twig');
    }
}
