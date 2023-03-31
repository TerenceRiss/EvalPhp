<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('field_name')
            ->add('size', ChoiceType::class, [
                'choices' => [

                    '38' => '38',
                    '39' => '39',
                    '40' => '40',
                    '41' => '41',
                    '42' => '42',
                    '43' => '43',
                    '44' => '44',
                    '45' => '45',
                    '46' => '46'
                ],
                'required' => false

            ])
            ->add('type', ChoiceType::class, [
                'choices' => [

                    'Running' => 'running',
                    'Sneakers' => 'Sneakers',
                    'Chaussure de ville' => 'Chaussure de ville'
                ],
                'required' => false
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [


                    'Homme' => 'male',
                    'Femme' => 'female',
                    'Unisex' => 'unisex'
                ],
                'required' => false
            ])
            ->add('date', ChoiceType::class, [
                'choices'=>[
                    'date asc'=> 'r.date asc',
                    'date desc' => 'r.date desc'
                ],
                'required' => false

            ])
            ->add('price', ChoiceType::class, [
                'choices' => [
                    '50 à 100 €' => json_encode(['min' => 50, 'max' => 100]),
                    '100 à 200€' => json_encode(['min' => 100, 'max' => 200]),
                    '200 à 250€' => json_encode(['min' => 200, 'max' => 250]),
                    '250 à 300€' => json_encode(['min' => 250, 'max' => 300]),
                    '300 à 350€' => json_encode(['min' => 300, 'max' => 350])
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-outline-success'
                ]
            ])
            ->add('search', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Entrer un mot clé'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
