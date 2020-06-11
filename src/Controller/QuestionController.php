<?php

namespace App\Controller;

use App\Entity\Questiontab;
use App\Entity\Reponsetab;
use App\Repository\QuestiontabRepository;
use App\Repository\ReponsetabRepository;
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
     * @var QuestionsRepository;
     * @var ReponsesRepository;
     */
    private $repQuestion;
    private $repReponse;
    public function __construct(QuestiontabRepository $repQuestion, ReponsetabRepository $repReponse )
    {
        $this->repQuestion=$repQuestion;
        $this->repReponse=$repReponse;
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
        return $this->render('pages/score.html.twig');
    }
    /**
     * @Route("/result", name="result")
     */
    public function result()
    {

    $score=$this->findScore($_POST);


        return $this->render('pages/result.html.twig',['score'=>$score]);
    }

}
