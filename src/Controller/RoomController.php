<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Main\Room;

class RoomController extends AbstractController
{
    #[Route('/room', name: 'app_room')]
    public function index(): JsonResponse
    {
        $nameCntrl = 'rom';
        return $this->json([
            'message' => 'Welcome to' . ' ' . $nameCntrl . ' ' . 'controller!',
        ]);
    }

    #[Route('/room/create', name: 'room_create')]
    public function createRoom(EntityManagerInterface $entityManager): Response
    {
        for ($i = 1; $i <= 20; $i++) {
            $room = new Room();
            if ($i < 10) {
                $room->setRoomNumber('D0' . $i);
            } else {
                $room->setRoomNumber('D' . $i);
            }
            $room->setRoomType('standart');
            $entityManager->persist($room);
        }

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new room with id ' . $room->getId());
    }

    #[Route('/room/current/{id}', name: 'room_show_id')]
    public function showId(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $room = $entityManager->getRepository(Room::class)->find($id);

        if (!$room) {
            throw $this->createNotFoundException(
                'No room found for id ' . $id
            );
        }

        // return new Response($room->getRoomNumber() . $room->getRoomType());

        return $this->json([
            'room_number' => $room->getRoomNumber(),
            'room_type' => $room->getRoomType(),
        ]);
    }

    #[Route('/room/all', name: 'room_show_all')]
    public function showAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $rooms = $entityManager->getRepository(Room::class)->findAll();

        $jsonData = [];
        foreach ($rooms as $room) {
            $roomData = [
                'id' => $room->getId(),
                'room_number' => $room->getRoomNumber(),
                'room_type' => $room->getRoomType(),
            ];
            $jsonData[] = $roomData;
        }

        return $this->json($jsonData);
    }
}
