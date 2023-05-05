<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('admin/categories/add', name: 'add_categories')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $cat = new Categories();
        $form = $this->createForm(CategoriesType::class, $cat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($cat);
            $em->flush();
            return new Response('categ ajoute avec succees');
        }
        return $this->render('categories/add.html.twig', [
            'f' => $form
        ]);
    }
}
