<?php

namespace App\Form;

use App\Entity\Shoes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ShoesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class,[
                'choices'=>[

                    'Homme'=>'male',
                    'Femme'=> 'female',
                    'Unisex'=> 'unisex'
                ]
            ])
           
            // ->add('size', ChoiceType::class,[
            //     'choices'=> [

            //         '38'=>'38',
            //         '39'=>'39',
            //         '40'=>'40',
            //         '41'=>'41',
            //         '42'=>'42',
            //         '43'=>'43',
            //         '44'=>'44',
            //         '45'=>'45',
            //         '46'=>'46'
            //     ]
                
            // ])
            ->add('price', )
            ->add('type', ChoiceType::class, [
                'choices'=> [

                    'Running'=>'Running',
                    'Sneakers'=>'Sneakers',
                    'Chaussures de ville'=>'Chaussure de ville'
                ]
            ])
            ->add('name')
            ->add ('description')
            ->add('imageFile', VichImageType::class, [
                'required' => true,
                'allow_delete' => true,
                'asset_helper' => true,
                'label' => false,
                'required' => false,
                'empty_data' => ''
            ])
          
          
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Shoes::class,
        ]);
    }
}
