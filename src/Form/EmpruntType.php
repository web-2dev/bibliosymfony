<?php

namespace App\Form;

use App\Entity\Emprunt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Abonne, App\Entity\Livre;

class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_emprunt', DateType::class, [
                "widget" => "single_text",
                "label" => "Emprunté le"
            ])
            ->add('date_retour', DateType::class, [
                "widget" => "single_text",
                "label" => "Rendu le",
                "required" => false
            ])
            ->add('abonne', EntityType::class, [
                "class" => Abonne::class,
                "choice_label" => "pseudo", // choice_label: nom du champ qui va être affiché dans le select
                "label" => "Abonné",
                "placeholder" => ""
            ])
            ->add('livre', EntityType::class, [
                "class" => Livre::class,
                "choice_label" => function(Livre $livre){
                    return $livre->getTitre() . " - " . $livre->getAuteur();  //si le choice_label est une fonction, le résultat de cette fonction sera affiché
                                                                              // dans le select (le livre concerné est passé en argument)
                },
                "placeholder" => ""
            ])
            ->add("enregistrer", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
