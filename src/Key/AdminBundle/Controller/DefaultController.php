<?php

namespace Key\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


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

        return $this->render('KeyAdminBundle:Default:users.html.twig', array('users' => $users));
    }
//    public function pdfAction()
//    {
//        $container->get('knp_snappy.pdf')->generate(array('http://www.google.fr', 'http://www.knplabs.com', 'http://www.google.com'), '/path/to/the/file.pdf');
//
//    }

    public function pdfAction()
    {
        $html = $this->render('KeyAdminBundle:Default:index.html.twig');

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );
    }

}
