<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

//         //.......................test nom message erreur si nul....................................................

//         //par défaut, on affiche le formulaire (quand il validera le formulaire sans erreur avec l'inscription validée, on l'affichera plus)
//         //$AfficherFormulaire=1;
//         //traitement du formulaire:
//     if(isset($_POST['nom']))
//     {//,$_POST['mdp'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
//         if(empty($_POST['nom']))
//         {//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
//         echo "Le champ nom est vide.";
//    // } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
//        // echo "Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
//     //} elseif(strlen($_POST['pseudo'])>25){//le pseudo est trop long, il dépasse 25 caractères
//       //  echo "Le pseudo est trop long, il dépasse 25 caractères.";
//    // } elseif(empty($_POST['mdp'])){//le champ mot de passe est vide
//      //   echo "Le champ Mot de passe est vide.";
//    // } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='".$_POST['pseudo']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
//      //   echo "Ce pseudo est déjà utilisé.";
//         } else 
//         {
//         //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
//         //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
//       //  if(!mysqli_query($mysqli,"INSERT INTO membres SET pseudo='".$_POST['pseudo']."', mdp='".md5($_POST['mdp'])."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
//        //     echo "Une erreur s'est produite: ".mysqli_error($mysqli);//je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
//        // } else {
//             echo "Vous êtes inscrit avec succès!";
//             //on affiche plus le formulaire
         
         
//      //  $AfficherFormulaire=0;
        
//     }
// }






        //.............................................................................................................

                

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
