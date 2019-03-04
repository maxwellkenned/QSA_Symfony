<?php

    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class AppController extends Controller 
    {
        /**
         * @Route("/" ,name="indexGeral")
         * @Method({"GET"})
         */
        public function listarEmpresas()
        {
            
            return $this->render('inc/Index.html.twig');
        }

    }
