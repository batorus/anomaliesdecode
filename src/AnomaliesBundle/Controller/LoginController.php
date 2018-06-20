<?php

namespace AnomaliesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('AnomaliesBundle:Login:login.html.twig', array(
                // ...
            ));    }

}
