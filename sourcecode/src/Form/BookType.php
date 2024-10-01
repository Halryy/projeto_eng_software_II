<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => 'Título'])
            ->add('isbn', null, ['label' => 'ISBN'])
            ->add('numberOfPages', null, ['label' => 'Número de Páginas'])
            ->add('availableQuantity', null, ['label' => 'Quantidade Disponível'])
            ->add('language', null, ['label' => 'Idioma'])
            ->add('publisher', null, ['label' => 'Editora'])
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'firstName',
                'multiple' => true,
                'label' => 'Autores',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
