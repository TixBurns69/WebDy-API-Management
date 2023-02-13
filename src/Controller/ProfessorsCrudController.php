<?php

namespace App\Controller;

use App\Entity\Professors;
use App\Form\ProfessorsType;
use App\Repository\ProfessorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professors/crud")
 */
class ProfessorsCrudController extends AbstractController
{
    /**
     * @Route("/", name="app_professors_crud_index", methods={"GET"})
     */
    public function index(ProfessorsRepository $professorsRepository): Response
    {
        return $this->render('professors_crud/index.html.twig', [
            'professors' => $professorsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_professors_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProfessorsRepository $professorsRepository): Response
    {
        $professor = new Professors();
        $form = $this->createForm(ProfessorsType::class, $professor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professorsRepository->add($professor, true);

            return $this->redirectToRoute('app_professors_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('professors_crud/new.html.twig', [
            'professor' => $professor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_professors_crud_show", methods={"GET"})
     */
    public function show(Professors $professor): Response
    {
        return $this->render('professors_crud/show.html.twig', [
            'professor' => $professor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_professors_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Professors $professor, ProfessorsRepository $professorsRepository): Response
    {
        $form = $this->createForm(ProfessorsType::class, $professor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professorsRepository->add($professor, true);

            return $this->redirectToRoute('app_professors_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('professors_crud/edit.html.twig', [
            'professor' => $professor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_professors_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Professors $professor, ProfessorsRepository $professorsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professor->getId(), $request->request->get('_token'))) {
            $professorsRepository->remove($professor, true);
        }

        return $this->redirectToRoute('app_professors_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
