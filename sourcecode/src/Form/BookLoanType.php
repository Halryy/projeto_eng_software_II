<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\BookLoan;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookLoanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('loanDate', DateType::class, [
                'label' => 'Data do Empréstimo',
                'widget' => 'single_text',
            ])
            ->add('dueDate', DateType::class, [
                'label' => 'Data de Vencimento',
                'widget' => 'single_text',
            ])
            ->add('returnDate', DateType::class, [
                'label' => 'Data de Retorno',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('status', null, [
                'label' => 'Status',
            ])
            ->add('notes', TextareaType::class, [
                'label' => 'Notas',
                'required' => false,
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'firstName',
                'label' => 'Cliente',
            ])
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'title',
                'label' => 'Livro',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookLoan::class,
        ]);
    }
}
