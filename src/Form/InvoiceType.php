<?php
namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('invoiceDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => true,
            ])
            ->add('invoiceNumber', IntegerType::class, [
                'required' => true,
            ])
            ->add('customerId', ChoiceType::class, [
                'required' => true,
                'choices'  => [
                    'Mulwana Invetivements' => 1,
                    'Jovan Innovations' => 2,
                    'Ssaka Joseph' => 3,
                ],
            ])
            ->add('invoiceLines', CollectionType::class, [
                'entry_type' => InvoiceLineType::class,
                'allow_add' => true, // Allow adding new invoice lines dynamically
                'by_reference' => false, // Set this to false to handle InvoiceLines as objects
                 'allow_delete' => true,
                 'attr' => [
                    'data-entry-add-label' => 'Add Invoice Line',
                    'data-entry-remove-label' => 'Rm Invoice Line',
                  ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
