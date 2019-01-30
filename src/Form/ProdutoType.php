<?php

namespace App\Form;

use App\Entity\Produto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo', TextType::class, [
                'required' => true,
                'label' => 'Código:',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('descricao', TextType::class, [
                'required' => true,
                'label' => "Descrição:",
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('preco', MoneyType::class, [
                'required' => true,
                'label' => "Preço:",
                'currency' => '',
                'attr' => [
                    'class' => 'form-control text-right'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Salvar',
                'attr'  => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ])
        ;

        return $builder->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produto::class,
        ]);
    }
}
