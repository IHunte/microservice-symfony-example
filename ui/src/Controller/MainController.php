<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return new Response('new Post with ID : ' .$post->getId() . ' have been created!..');
        }

        return $this->render('main/index.html.twig', [
            'post_form' => $form->createView()
        ]);
    }
    
    #[Route('/list', name: 'post_list')]
    public function show(): Response
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:90/api/posts?page=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Access-Control-Allow-Origin: *",
            "Content-type: application/json",
            //"Accept: application/ld+json",
            "Access-Control-Allow-Methods: GET"
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        return $this->render('main/list.html.twig', [
            'post_list' => $result
        ]);
    }
}