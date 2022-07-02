<?php

namespace App\Form;

use App\Entity\Product;
use App\Repository\TypeProductRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\TypeProduct;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ProductType extends AbstractType
{
    private $em;
    private $typeProductRepository;

    public function __construct(ManagerRegistry $registry, TypeProductRepository $typeProductRepository)
    {
        $this->em = $registry;
        $this->typeProductRepository = $typeProductRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NameProduct')
            ->add('Quantity')
            ->add('Information')
            ->add('Price')

            ->add('typeProduct', EntityType::class,[
                'class' => TypeProduct::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
