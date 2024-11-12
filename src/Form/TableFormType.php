<?php

namespace App\Form;

use App\Entity\MyTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TableFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('Number',NumberType::class,['attr'=>['class'=>'form-control'],'html5'=>true])
            ->add('Data',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('Info',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('Submit',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MyTable::class,
            'csrf_protection'=> true ,
            'csrf_field_name'=> '_token',
            'csrf_tocken_id'=> 'myTable_value',

        ]);
    }
}
