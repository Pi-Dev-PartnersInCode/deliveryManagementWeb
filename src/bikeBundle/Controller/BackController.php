<?php

namespace bikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BackController extends Controller
{

    public function indexAction()
    {
        return $this->render('@bike/Back/admin1.html.twig');
    }
}
