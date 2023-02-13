<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeanStudentsController extends AbstractController
{
    /**
     * @Route("/mean/students", name="app_mean_students")
     */
    public function index(): Response
    {
        return $this->render('mean_students/index.html.twig', [
            'controller_name' => 'MeanStudentsController',
        ]);
    }
}
