<?php

namespace App\Form;

use App\Entity\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;
use DateTime;

class BlogPostType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $todayDate = new DateTime("NOW");
        $authorName = $this->security->getUser()->getUserName();

        $builder
            ->add('title')
            ->add('slug')
            ->add('image_name')
            ->add('short_content')
            ->add('content')
            ->add('category')
            ->add('tags')
            ->add('date', DateTimeType::class, [
                'data' => $todayDate,
            ])
            ->add('author_name', HiddenType::class, [ /// MAKE IT NON-HIDDEN
                'data' => $authorName,
            ])
            ->add('likes_count')
            ->add('comments_count')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BlogPost::class,
        ]);
    }
}
