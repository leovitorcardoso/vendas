<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Entity\Venda;
use App\Entity\VendaProduto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VendaController extends AbstractController
{
    /**
     * @Route("/vendas", name="vendas")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $collVendas  = $em->getRepository(Venda::class)->findAll();

        return $this->render('venda/index.html.twig', [
            'collVendas' => $collVendas,
        ]);
    }

    /**
     * @Route("/venda/view/{id}", name="venda_view")
     */
    public function view($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Venda $venda */
        $venda  = $em->getRepository(Venda::class)->find($id);

        return $this->render('venda/view.html.twig', [
            'venda' => $venda,
            'collVendaProduto' => $venda->getVendaProdutos(),
        ]);
    }



    /**
     * @Route("/venda/registration/{id}", name="vendas_registration")
     */
    public function registration(Request $request = null, $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        if (is_null($id)) {
            $venda = new Venda();
            $venda->setStatus(Venda::STATUS_ANDAMENTO);
            $venda->setValorTotal(0);
            $em->persist($venda);
            $em->flush();

            return $this->redirect(sprintf('/venda/registration/%d', $venda->getId()));
        }

        $venda = $em->getRepository(Venda::class)->find($id);
        $collProdutos = $em->getRepository(Produto::class)->findAll();

        return $this->render('venda/registration.html.twig', [
            'venda' => $venda,
            'collProdutos' => $collProdutos,
            'collVendaProduto' => $venda->getVendaProdutos(),
        ]);
    }

    /**
     * @Route("/venda/registration/{id}/add", name="vendas_add_item")
     *
     * @param Request|null $request
     * @param null         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addItem(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Venda $venda */
        $venda = $em->getRepository(Venda::class)->find($id);

        foreach ($request->query->get('produto') as $produtoId => $quantidade) {
            if ($quantidade > 0) {
                $vendaProduto = $em->getRepository(VendaProduto::class)->findOneBy(['Produto' => $produtoId, 'Venda' => $id]);

                if (is_null($vendaProduto)) {
                    $vendaProduto = new VendaProduto();
                }

                $produto = $em->getRepository(Produto::class)->find($produtoId);

                $vendaProduto->setVenda($venda);
                $vendaProduto->setProduto($produto);
                $vendaProduto->setQuantidade($vendaProduto->getQuantidade() + $quantidade);
                $vendaProduto->setValorUnitario($produto->getPreco());

                $em->persist($vendaProduto);
                $em->flush();
            }
        }

        $this->updateValorTotal($venda);

        return $this->redirect(sprintf('/venda/registration/%d', $id));
    }

    /**
     * @Route("/venda/registration/{id}/remove/{item}", name="vendas_add_remove")
     *
     * @param Request|null $request
     * @param null         $id
     *
     * @param null         $item
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeItem(Request $request = null, $id, $item)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Venda $venda */
        $venda = $em->getRepository(Venda::class)->find($id);

        /** @var VendaProduto $vendaProduto */
        $vendaProduto = $em->getRepository(VendaProduto::class)->find($item);

        $venda->removeVendaProduto($vendaProduto);

        $em->persist($venda);
        $em->flush();

        $this->updateValorTotal($venda);

        return $this->redirect(sprintf('/venda/registration/%d', $id));
    }

    /**
     * @Route("/venda/registration/{id}/confirm", name="vendas_add_confirm")
     * @param Request|null $request
     * @param              $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function confirm(Request $request = null, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Venda $venda */
        $venda = $em->getRepository(Venda::class)->find($id);

        $venda->setStatus(Venda::STATUS_COMFIRMADO);

        $em->persist($venda);
        $em->flush();

        return $this->redirectToRoute('vendas');
    }
    
    public function updateValorTotal(Venda $venda)
    {
        $em = $this->getDoctrine()->getManager();

        $valor = 0;

        foreach ($venda->getVendaProdutos() as $vendaProduto) /** @var VendaProduto $vendaProduto */ {
            $valor += $vendaProduto->getValorTotal();
        }

        $venda->setValorTotal($valor);
        $em->persist($venda);
        $em->flush();
    }
}
