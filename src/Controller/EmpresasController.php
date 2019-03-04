<?php

    namespace App\Controller;

    use App\Entity\Empresas;
    use App\Entity\Pessoas;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;

    class EmpresasController extends Controller 
    {

        /**
         * @Route("/empresas/listar" ,name="listarEmpresas")
         * @Method({"GET"})
         */
        public function listarEmpresas()
        {
            $empresas = $this->getDoctrine()->getRepository(Empresas::class)->findAll();
            return $this->render('Empresas/IndexEmpresas.html.twig',array('empresas'=>$empresas));
        }

        /**
         * @Route("/empresas/criar", name="criarEmpresa")
         * Method({"GET", "POST"})
         */
        public function criarEmpresa(Request $request)
        {
            $empresa = new Empresas();
            $form = $this->createFormBuilder($empresa)
            ->add('coCnpj', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'max' => 14,'onblur'=>'javascript: formatarCampo(this);','onfocus'=>'javascript: retirarFormatacao(this);')))
            ->add('razaoSocial', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'maxlength' => 100)))
            ->add('salvar', SubmitType::class, array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $empresa = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($empresa);
                $entityManager->flush();
                return $this->redirectToRoute('listarEmpresas');
            }
            return $this->render('Empresas/abrirEmpresa.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/empresas/baixar/{nuSeqEmpresa}", name="baixarEmpresa")
         * @Method({"DELETE"})
         */
        public function baixarEmpresa(Request $request, $nuSeqEmpresa) 
        {
            $empresa = $this->getDoctrine()->getRepository(Empresas::class)->find($nuSeqEmpresa);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($empresa);
            $entityManager->flush();
            $response = new Response();
            $response->send();
            return $this->redirectToRoute('listarEmpresas');
        }

        /**
        * @Route("/empresas/editar/{nuSeqEmpresa}", name="editarEmpresa")
        * Method({"GET", "POST"})
        */
        public function editarEmpresas(Request $request, $nuSeqEmpresa) 
        {
            $empresa = new Empresas();
            $empresa = $this->getDoctrine()->getRepository(Empresas::class)->find($nuSeqEmpresa);
            $form = $this->createFormBuilder($empresa)
            ->add('coCnpj', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'max' => 14,'onblur'=>'javascript: formatarCampo(this);','onfocus'=>'javascript: retirarFormatacao(this);')))
            ->add('razaoSocial', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'maxlength' => 100)))
            ->add('atualizar', SubmitType::class, array('label' => 'Atualizar','attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                return $this->redirectToRoute('listarEmpresas');
            }

            return $this->render('Empresas/editarEmpresas.html.twig', array('form' => $form->createView()));
        }

        /**
        * @Route("/empresas/{nuSeqEmpresa}", name="verEmpresa")
        */
        public function VerEmpresa($nuSeqEmpresa) 
        {
        $empresa = $this->getDoctrine()->getRepository(Empresas::class)->find($nuSeqEmpresa);
        $pessoas= $this->getDoctrine()->getRepository(Pessoas::class)->findBy(['nuSeqEmpresa' => (int)$empresa->getNuSeqEmpresa()]);
        return $this->render('Empresas/verEmpresas.html.twig', array('empresa' => $empresa,'pessoas'=>$pessoas));
        }
    }



