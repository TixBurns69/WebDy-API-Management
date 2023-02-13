<?php

namespace App\Controller;

use App\Entity\ExamsMean;
use App\Form\ExamsMean1Type;
use App\Repository\ExamsMeanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exams/mean")
 */
class ExamsMeanController extends AbstractController
{
    /**
     * @Route("/", name="app_exams_mean_index", methods={"GET"})
     */
    public function index(ExamsMeanRepository $examsMeanRepository): Response
    {
        //die('test pour classe active');
        return $this->render('exams_mean/index.html.twig', [
            'exams_means' => $examsMeanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_exams_mean_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExamsMeanRepository $examsMeanRepository): Response
    {
        $examsMean = new ExamsMean();
        $form = $this->createForm(ExamsMean1Type::class, $examsMean);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examsMeanRepository->add($examsMean, true);

            return $this->redirectToRoute('app_exams_mean_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exams_mean/new.html.twig', [
            'exams_mean' => $examsMean,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_exams_mean_show", methods={"GET"})
     */
    public function show(ExamsMean $examsMean): Response
    {
        return $this->render('exams_mean/show.html.twig', [
            'exams_mean' => $examsMean,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_exams_mean_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ExamsMean $examsMean, ExamsMeanRepository $examsMeanRepository): Response
    {
        $form = $this->createForm(ExamsMean1Type::class, $examsMean);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $examsMeanRepository->add($examsMean, true);

            return $this->redirectToRoute('app_exams_mean_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exams_mean/edit.html.twig', [
            'exams_mean' => $examsMean,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_exams_mean_delete", methods={"POST"})
     */
    public function delete(Request $request, ExamsMean $examsMean, ExamsMeanRepository $examsMeanRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$examsMean->getId(), $request->request->get('_token'))) {
            $examsMeanRepository->remove($examsMean, true);
        }

        return $this->redirectToRoute('app_exams_mean_index', [], Response::HTTP_SEE_OTHER);
    }
}
