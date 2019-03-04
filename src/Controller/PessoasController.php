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

    class PessoasController extends Controller {

        /**
         * @Route("/pessoas/listar" ,name="listarPessoa")
         * @Method({"GET"})
         */
        public function listarEmpresas()
        {
            $pessoas = $this->getDoctrine()->getRepository(Pessoas::class)->findAll();
            return $this->render('Pessoas/indexPessoas.html.twig',array('pessoas'=>$pessoas));
        }

        /**
         * @Route("/pessoas/criar", name="criarPessoa")
         * Method({"GET", "POST"})
         */
        public function criarPessoa(Request $request)
        {
            $pessoas = new Pessoas();
            $form = $this->createFormBuilder($pessoas)
            ->add('coCpfCnpj', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'min'=>11,'max' => 14,'onblur'=>'javascript: formatarCampo(this);','onfocus'=>'javascript: retirarFormatacao(this);')))
            ->add('nuSeqEmpresa', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'onblur'=>'javascript: formatarCampo(this);','onfocus'=>'javascript: retirarFormatacao(this);')))
            ->add('dsNome', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'maxlength' => 100)))
            ->add('salvar', SubmitType::class, array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $pessoa = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pessoa);
                $entityManager->flush();
                return $this->redirectToRoute('listarPessoa');
            }
            return $this->render('Pessoas/criarPessoas.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/pessoas/deletar/{nuSeqPessoa}", name="baixarPessoa")
         * @Method({"DELETE"})
         */
        public function deletarPessoa (Request $request, $nuSeqPessoa) 
        {
            $pessoa = $this->getDoctrine()->getRepository(Pessoas::class)->find($nuSeqPessoa);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pessoa);
            $entityManager->flush();
            $response = new Response();
            $response->send();
            return $this->redirectToRoute('listarPessoa');
        }

        /**
        * @Route("/pessoas/editar/{nuSeqPessoa}", name="editarPessoa")
        * Method({"GET", "POST"})
        */
        public function editarPessoa(Request $request, $nuSeqPessoa) 
        {
            $pessoa = new Pessoas();
            $pessoa = $this->getDoctrine()->getRepository(Pessoas::class)->find($nuSeqPessoa);
            $form = $this->createFormBuilder($pessoa)
            ->add('nuSeqEmpresa', NumberType::class, array('attr' => array('class' => 'form-control','required'=> true,'onblur'=>'javascript: formatarCampo(this);','onfocus'=>'javascript: retirarFormatacao(this);')))
            ->add('coCpfCnpj', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'min'=>11,'max' => 14,'onblur'=>'javascript: formatarCampo(this);','onfocus'=>'javascript: retirarFormatacao(this);')))
            ->add('dsNome', TextType::class, array('attr' => array('class' => 'form-control','required'=> true,'maxlength' => 100)))
            ->add('atualizar', SubmitType::class, array('label' => 'Atualizar','attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                return $this->redirectToRoute('listarPessoa');
            }
            return $this->render('Pessoas/editarPessoas.html.twig', array('form' => $form->createView()));
        }

        /**
        * @Route("/pessoas/{nuSeqPessoa}", name="verPessoa")
        */
        public function showPessoa($nuSeqPessoa) 
        {
            $pessoa = $this->getDoctrine()->getRepository(Pessoas::class)->find($nuSeqPessoa);
            $empresa= $this->getDoctrine()->getRepository(Empresas::class)->find((int)$pessoa->getNuSeqEmpresa());
            return $this->render('Pessoas/verPessoas.html.twig', array('pessoa' => $pessoa,'empresa'=>$empresa));
        }
    }



