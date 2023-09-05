<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\InvoiceLine;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class InvoiceLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class, [
                'required' => true,
            ])
            ->add('quantity', IntegerType::class, [
                'required' => true,
            ])
            ->add('amount', MoneyType::class, [
                'scale' => 2,
                'required' => true,
            ])
            ->add('vatAmount', MoneyType::class, [
                'scale' => 2,
                'required' => true,
            ])
            ->add('totalWithVat', MoneyType::class, [
                'scale' => 2,
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InvoiceLine::class,
        ]);
    }
}
