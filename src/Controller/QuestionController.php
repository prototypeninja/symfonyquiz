<?php

namespace App\Controller;

use App\Entity\Questiontab;
use App\Entity\Reponsetab;
use App\Entity\Score;
use App\Repository\QuestiontabRepository;
use App\Repository\ReponsetabRepository;
use App\Repository\ScoreRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends Controller
{

  //cette fonction permet de calculer le score et de retourne le score


    public function findScore($post){
        if (isset($post)){
            $i = 0;
            $score=0;
            $nbrQuestion=count($post)-1;
            foreach ($post as $key => $value){
                if ($key!="pseudo"){
                    $Reponses=$this->repReponse->find($value);
                    $reponseStatu=$Reponses->getStatu();
                }
                if ($reponseStatu){
                    $score++;
                }
                $i++;
                if ($i==count($post)){

                    break;

                }

                //echo intval(substr($key,-1));

            }

            $scoreFinale=$score."/".$nbrQuestion;
        }
        return $scoreFinale;

    }

    /**
     * @var $repScore;
     * @var QuestionsRepository;
     * @var ReponsesRepository;

     */
    private $repQuestion;
    private $repReponse;
    private $repScore;
    public function __construct(QuestiontabRepository $repQuestion, ReponsetabRepository $repReponse, ScoreRepository $repScore )
    {
        $this->repQuestion=$repQuestion;
        $this->repReponse=$repReponse;
        $this->repScore=$repScore;
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('pages/home.html.twig');
    }
    /**
     * @Route("/question", name="quiz")
     */
    public function question()
    {
        $questions=$this->repQuestion->findAll();//recuperation des questions

        return $this->render('pages/quiz.html.twig',['questions'=>$questions]);
    }
    /**
     * @Route("/score", name="score")
     */
    public function score()
    {
        $scoresUser=$this->repScore->findAll();//recuperation des scores

        return $this->render('pages/score.html.twig',['scores'=>$scoresUser]);
    }
    /**
     * @Route("/result", name="result")
     */
    public function result()
    {
        /*
         si le formulaire n'est pas soumit ou si on accès d'accedé a la vue result
        par url, une redirection est encrenché vers la page d'acceuile.

         */
        if (!isset($_POST['pseudo'])){
            return $this->redirectToRoute('home');
        }else{
            $score=$this->findScore($_POST);// on appelle fontions  traitement post =>score
            $em=$this->getDoctrine()->getManager();//initialisation atity manager de doctrine
            $pseudo=$this->repScore->findOneBy(array('pseudo'=>$_POST['pseudo']));//essai recupération pseudo de l'entité score = post['pseudo']
            if (!$pseudo){ //false! enregistrer le  pseudo et le score dans la base
                $repScore=new Score();
                $repScore->setPseudo($_POST['pseudo'])
                    ->setScore($score);
                $em=$this->getDoctrine()->getManager();
                $em->persist($repScore);
                $em->flush();
            }else{
                //true! mettre a jour le score du pseudo
                $pseudo->setScore($score);
                $em->flush();
            }
            //envoie du score a la vue
            return $this->render('pages/result.html.twig',['score'=>$score]);
        }

    }



}
