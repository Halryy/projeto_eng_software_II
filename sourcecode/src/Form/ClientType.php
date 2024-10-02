<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'label' => 'Nome',
            ])
            ->add('lastName', null, [
                'label' => 'Sobrenome',
            ])
            ->add('dateOfBirth', DateType::class, [
                'label' => 'Data de Nascimento',
                'widget' => 'single_text',
            ])
            ->add('email', null, [
                'label' => 'Email',
            ])
            ->add('phoneNumber', null, [
                'label' => 'Telefone',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
