<?php

namespace App\Controller;

use App\Entity\Players;
use App\Form\Players1Type;
use App\Repository\PlayersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/players")
 */
class PlayersController extends AbstractController
{
    /**
     * @Route("/", name="players_index", methods={"GET"})
     */
    public function index(PlayersRepository $playersRepository): Response
    {
        return $this->render('players/index.html.twig', [
            'players' => $playersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="players_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $player = new Players();
        $form = $this->createForm(Players1Type::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('players_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('players/new.html.twig', [
            'player' => $player,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/search", name="players_search", methods={"GET","POST"})
     */
    public function search(Request $request) : Response
    {
      $lastName = $request->query->get('role');
        $players = $this->getDoctrine()->getRepository(Players::class)->findBy(['role'=>$lastName]);
        return $this->render('players/search.html.twig', [
            'players' => $players,
        ]);

    }
    /**
     * @Route("/{id}", name="players_show", methods={"GET"})
     */
    public function show(Players $player): Response
    {
        return $this->render('players/show.html.twig', [
            'player' => $player,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="players_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Players $player): Response
    {
        $form = $this->createForm(Players1Type::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('players_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('players/edit.html.twig', [
            'player' => $player,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="players_delete", methods={"POST"})
     */
    public function delete(Request $request, Players $player): Response
    {
        if ($this->isCsrfTokenValid('delete'.$player->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($player);
            $entityManager->flush();
        }

        return $this->redirectToRoute('players_index', [], Response::HTTP_SEE_OTHER);
    }
}
