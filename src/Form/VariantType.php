<?php

namespace App\Form;

use App\Entity\Variant;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $model = $event->getData()->getModel();
                $form = $event->getForm();
                if($model->getGender() == 'male') {
                    $form->add('size', ChoiceType::class,[
                        'choices'=> [
                            '41'=>'41',
                            '42'=>'42',
                            '43'=>'43',
                            '44'=>'44',
                            '45'=>'45',
                            '46'=>'46'
                        ]
                    ]);
                } else if($model->getGender() == 'female') {
                    $form->add('size', ChoiceType::class,[
                        'choices'=> [
                            '38'=>'38',
                            '39'=>'39',
                            '40'=>'40',
                            '41'=>'41',
                            '42'=>'42',
                        ]
                    ]);
                } else {
                    $form->add('size', ChoiceType::class,[
                        'choices'=> [
                            '38'=>'38',
                            '39'=>'39',
                            '40'=>'40',
                            '41'=>'41',
                            '42'=>'42',
                            '43'=>'43',
                            '44'=>'44',
                            '45'=>'45',
                            '46'=>'46'
                        ]
                    ]);
                }
            })
            ->add('stock')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Variant::class,
        ]);
    }
}
