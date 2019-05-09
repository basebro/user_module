<?php

namespace Key\ActionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KeyActionBundle:Default:index.html.twig');
    }
}
