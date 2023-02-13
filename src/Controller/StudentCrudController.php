<?php

namespace App\Controller;

use App\Entity\Students;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student/crud")
 */
class StudentCrudController extends AbstractController
{
    /**
     * @Route("/", name="app_student_crud_index", methods={"GET"})
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('student_crud/index.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_student_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, StudentRepository $studentRepository): Response
    {
        $student = new Students();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentRepository->add($student, true);

            return $this->redirectToRoute('app_student_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student_crud/new.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_student_crud_show", methods={"GET"})
     */
    public function show(Students $student): Response
    {
        return $this->render('student_crud/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_student_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Students $student, StudentRepository $studentRepository): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentRepository->add($student, true);

            return $this->redirectToRoute('app_student_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student_crud/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_student_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Students $student, StudentRepository $studentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $studentRepository->remove($student, true);
        }

        return $this->redirectToRoute('app_student_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
