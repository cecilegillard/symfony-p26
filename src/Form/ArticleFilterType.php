<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Tag;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
            ])

            ->add('Filtrer', SubmitType::class, ['attr' => ['class' => 'form-control btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
