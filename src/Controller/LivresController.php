<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('/admin/livres', name: 'app_livres_findall')]
    public function index(LivresRepository $rep): Response
    {
        //  $rep = $doctrine->getRepository(Livres::class);
        $livres = $rep->findAll();

        dd($livres);
    }

    #[Route('/admin/livres/find/{id}', name: 'app_livres_find')]
    public function chercher(Livres $livre): Response
    {

        dd($livre);
    }

    #[Route('/admin/livres/add', name: 'app_livres_add')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $date = new DateTime('2022-01-01');
        $livre = new Livres();
        $livre->setLibelle("reseau")
            ->setImage("https://via.placeholder.com/300")
            ->setPrix(150)
            ->setEditeur("DUNOO")
            ->setResume("resume de reseau ................")
            ->setDateEdition($date);
        $em = $doctrine->getManager();
        $em->persist($livre);
        $em->flush();
        dd($livre);
    }

    #[Route('/admin/livres/update/{id}', name: 'app_livres_update')]
    public function update_price(Livres $livre, ManagerRegistry $doctrine): Response
    {
        $livre->setPrix(250);
        $em = $doctrine->getManager();
        $em->flush();
        dd($livre);
    }

    #[Route('/admin/livres/delete/{id}', name: 'app_livres_delete')]
    public function delete(Livres $livre, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        dd($livre);
    }
}
