<?php

namespace App\Controller;

use App\Entity\MyTable;
use App\Form\TableFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Main2Controller extends AbstractController
{
    #[Route('/main2', name: 'app_main2')]
    public function index(): Response
    {
        return $this->render('main2/index.html.twig', [
            'controller_name' => 'Main2Controller',
        ]);
    }


   #[Route('/test/{name}', name: 'app_test')]
    public function test(Request $info): Response
    {
        $name=$info->get('name');

       return $this->render('main3/my_demo.html.twig',['title'=> "Home Page"]);
    }


    #[Route('/test2', name: 'app_test2')]
    public function info(): Response
    {
        $record1=[
            'name' => 'Anas',
            'age'=> 30 ,
            'profession'=> 'Doctor' ,
        ];
        $record2=[
            'name' => 'Hadi',
            'age'=> 40 ,
            'profession'=> 'Engineer' ,
        ];
        $record3=[
            'name' => 'Fadi',
            'age'=> 50 ,
            'profession'=> 'Teacher' ,
        ];



       return $this->render('main3/my_demo2.html.twig',[
        'users' =>[$record1 , $record2 ,$record3] ,
        'x' => 4,
        'list'=> ["1","2","3","4","5","6","7","8","9","10"]
    ]);
    }




    #[Route('/addData', name: 'app_add_data')]
    public function save(EntityManagerInterface $manager): Response
    {
        if(isset($_POST['name']) && isset($_POST['number']) && isset($_POST['data']) && isset($_POST['info']))
         {
           $name=  $_POST['name'];
           $number=  $_POST['number'];
           $data=  $_POST['data'];
           $info=  $_POST['info'];

           $myTable=new MyTable();
           $myTable->setName($name);
           $myTable->setNumber($number);
           $myTable->setData($data);
           $myTable->setInfo($info);

           $manager->persist($myTable);
           $manager->flush();
        }
        return $this->render('main3/demo_database.html.twig');

    }


    
    #[Route('/addData2', name: 'app_add_data2')]
    public function save2(EntityManagerInterface $manager , Request $request): Response
    {

           $myTable=new MyTable();
           $form =$this->createForm(TableFormType::class, $myTable,['attr'=>['style'=>'margin:30px;']]);
           $form->handleRequest($request);
           if($form->isSubmitted() && $form->isValid())
           {
            //echo' Done';
            $manager->persist($myTable);
           $manager->flush(); 
           return $this->redirect($request->getUri());
           }
          
        
        return $this->render('main3/demo_database2.html.twig',[
            'TableForm' =>$form->createView()
        ]
    );

    }



    #[Route('/showData', name: 'app_show_data')]
    public function fetch(EntityManagerInterface $manager ,ManagerRegistry $repository, Request $request): Response
    {
        $registry=$repository->getRepository(MyTable::class);
        $columns=$manager->getClassMetadata('App\Entity\MyTable')->getColumnNames(); //to get name of columns and render them
       //$data= $registry->find(1);
       //$data= $registry->findAll();


       $query= $manager->createQuery('SELECT p from App\Entity\MyTable p  where p.id > 3 ');
       $data = $query->getResult();
         //dd($data) ;
        
        return $this->render('main3/demo_database3.html.twig',[
            'data' =>$data,
            'columns' =>$columns,
        ]
    );

    }
}
