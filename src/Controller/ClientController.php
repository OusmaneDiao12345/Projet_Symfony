<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ClientController extends AbstractController
{
    #[Route('/client/add', name: 'client_add')]
    public function addClient(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        // Handle the form request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the client to the database
            $entityManager->persist($client);
            $entityManager->flush();

            // Add a flash message for success
            $this->addFlash('success', 'Client ajouté avec succès.');

            // Redirect to the client list
            return $this->redirectToRoute('client_index');
        }

        // Render the form
        return $this->render('client/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/clients', name: 'client_index')]
    public function index(ClientRepository $clientRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Fetch all clients query
        $query = $clientRepository->createQueryBuilder('c')
            ->getQuery();
    
        // Paginate the results
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            3 /* limit per page */
        );
    
        // Render the list of clients with pagination
        return $this->render('client/index.html.twig', [
            'clients' => $pagination,
        ]);
    }

    #[Route('/client/search', name: 'client_search')]
    public function search(Request $request, ClientRepository $clientRepository): Response
    {
        $searchTerm = $request->query->get('telephone');
        $clients = [];

        if ($searchTerm) {
            $clients = $clientRepository->findBy(['telephone' => $searchTerm]);
        }

        return $this->render('client/search.html.twig', [
            'clients' => $clients,
            'searchTerm' => $searchTerm,
        ]);
    }
}
