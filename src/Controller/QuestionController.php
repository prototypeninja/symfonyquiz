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
        $questions=$this->repQuestion->findAll();

        return $this->render('pages/quiz.html.twig',['questions'=>$questions]);
    }
    /**
     * @Route("/score", name="score")
     */
    public function score()
    {
        $scoresUser=$this->repScore->findAll();

        return $this->render('pages/score.html.twig',['scores'=>$scoresUser]);
    }
    /**
     * @Route("/result", name="result")
     */
    public function result()
    {
        if (!isset($_POST['pseudo'])){
            return $this->redirectToRoute('home');
        }
        $score=$this->findScore($_POST);
        $em=$this->getDoctrine()->getManager();
        $pseudo=$this->repScore->findOneBy(array('pseudo'=>$_POST['pseudo']));

        if (!$pseudo){
            $repScore=new Score();
            $repScore->setPseudo($_POST['pseudo'])
                ->setScore($score);
            $em=$this->getDoctrine()->getManager();
            $em->persist($repScore);
            $em->flush();
        }else{
            $pseudo->setScore($score);
            $em->flush();
        }

        return $this->render('pages/result.html.twig',['score'=>$score]);
    }



}
