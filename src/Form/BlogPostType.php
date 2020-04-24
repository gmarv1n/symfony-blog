<?php

namespace App\Form;

use App\Entity\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;
use DateTime;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogPostType extends AbstractType
{
    /**
     * @var User
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $todayDate = new DateTime("NOW");
        $authorNick = $this->security->getUser()->getUserNickName();
        $authorId = $this->security->getUser()->getId();

        $builder
            ->add('title')
            ->add('slug')
            ->add('image_name')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'download_file',
                'download_uri' => true,
                'image_uri' => true,
                //'imagine_pattern' => '...',
                'asset_helper' => true,
            ])
            ->add('short_content')
            ->add('content')
            ->add('category')
            ->add('tags')
            ->add('date', DateTimeType::class, [
                'data' => $todayDate,
            ])
            ->add('author_nick', TextType::class, [
                'data' => $authorNick,
            ])
            ->add('author_id', TextType::class, [
                'data' => $authorId,
            ])
            ->add('likes_count') //, HiddenType::class
            ->add('comments_count') //, HiddenType::class
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BlogPost::class,
        ]);
    }
}
