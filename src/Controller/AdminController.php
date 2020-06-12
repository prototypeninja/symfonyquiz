<?php

namespace App\Controller;

use App\Entity\Questiontab;
use App\Form\AddQuestionFormType;
use App\Repository\QuestiontabRepository;
use App\Repository\ReponsetabRepository;
use App\Repository\ScoreRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @var $repScore;
     * @var QuestionsRepository;
     * @var ReponsesRepository;

     */
    private $repQuestion;
    private $repReponse;
    private $repScore;
    private $em;

    public function __construct(QuestiontabRepository $repQuestion, ReponsetabRepository $repReponse, ScoreRepository $repScore, \Doctrine\Common\Persistence\ObjectManager $em)
    {
        $this->repQuestion=$repQuestion;
        $this->repReponse=$repReponse;
        $this->repScore=$repScore;
        $this->em=$em;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $questions=$this->repQuestion->findAll();
        return $this->render('admin/index.html.twig',['questions'=>$questions]);
    }
    /**
     * @Route("/admin/edit{id}", name="edit")
     */
    public function edit()
    {
        $questions=$this->repQuestion->findAll();
        return $this->render('admin/edit.html.twig',['questions'=>$questions]);
    }
    /**
     * @Route("/admin/delete{id}", name="delete")
     */
    public function delet($id)
    {
        $question=$this->repQuestion->find($id);
        $this->em->remove($question);
        $this->em->flush();
        $questions=$this->repQuestion->findAll();
        return $this->redirectToRoute('admin',['questions'=>$questions]);
    }
    /**
     * @Route("/admin/add", name="add")
     */
    public function add(Request $request)
    {
        $questiontab=new Questiontab();
        $form=$this->createForm(AddQuestionFormType::class,$questiontab);
        $form->handleRequest($request);
        if ($form-> isSubmitted()){

            $this->em->persist($questiontab);
            $this->em->flush();
            $idQuestion=$questiontab->getId();
            return $this->redirectToRoute('addReponse',['id'=>$idQuestion]);
        }else{
            return $this->render('admin/add.html.twig',['form'=>$form->createView()]);
        }


    }
    /**
     * @Route("/admin/addReponse{id}", name="addReponse")
     */
    public function addreponse()
    {

        return $this->render('admin/addReponse.html.twig');
    }

}