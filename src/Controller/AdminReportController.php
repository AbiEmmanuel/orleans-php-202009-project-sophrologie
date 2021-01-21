<?php

namespace App\Controller;

use App\Entity\Report;
use App\Entity\User;
use App\Form\ReportType;
use App\Repository\ReportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReportController extends AbstractController
{
    /**
     * @Route("/admin/reports", name="admin_reports")
     * @param Request $request
     * @var User $user
     * @return Response
     */
    public function index(Request $request, User $user): Response
    {
        $report = new Report();
        $formReport = $this->createForm(ReportType::class, $report);
        $formReport->handleRequest($request);

        if ($formReport->isSubmitted() && $formReport->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $report->setAuthor($user);

            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé !');
        }

        return $this->render('admin_report/index.html.twig', [
            'formReport' => $formReport->createView()
        ]);
    }
}