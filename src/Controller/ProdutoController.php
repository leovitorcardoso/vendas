<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController
{
    /**
     * @Route("/produtos", name="produtos")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $collProdutos  = $entityManager->getRepository(Produto::class)->findAll();

        return $this->render('produto/index.html.twig', [
            'collProdutos' => $collProdutos,
        ]);
    }

    /**
     * @Route("/produto/registration/{id}", name="produto_registration")
     * @param Request|null $request
     * @param null         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request = null, $id = null)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $produto = new Produto();

        if (!is_null($id)) {
            $produto = $entityManager->find(Produto::class, $id);
        }

        $type = new ProdutoType();
        $form = $type->buildForm($this->createFormBuilder($produto), []);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produto = $form->getData();

            $entityManager->persist($produto);
            $entityManager->flush();

            return $this->redirectToRoute('produtos');
        }

        return $this->render('produto/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/produto/delete/{id}", name="produto_delete")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $produto = $entityManager->find(Produto::class, $id);

        $entityManager->remove($produto);
        $entityManager->flush();

        return $this->redirectToRoute('produtos');
    }
}
