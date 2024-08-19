<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Main\Booking;
use App\Entity\Main\Employee;
use App\Entity\Main\Guest;
use App\Entity\Main\Passport;
use App\Entity\Main\Position;
use App\Entity\Main\Room;
use App\Entity\Main\RoomPrices;
use App\Entity\Main\RoomService;
use App\Entity\Main\RoomServiceOrder;
use App\Entity\Main\Service;
use App\Entity\Main\ServiceOrder;
use App\Entity\Main\ServicePrice;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("HotelAdminDashboard");
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section('Guests');
        yield MenuItem::linkToCrud('Booking', 'fas fa-list', Booking::class);
        yield MenuItem::linkToCrud('Guests', 'fas fa-list', Guest::class);
        yield MenuItem::linkToCrud('Passports', 'fas fa-list', Passport::class);
        yield MenuItem::linkToCrud('ServiceOrders', 'fas fa-list', ServiceOrder::class);


        yield MenuItem::section('Rooms');
        yield MenuItem::linkToCrud('Rooms', 'fas fa-list', Room::class);
        yield MenuItem::linkToCrud('RoomPrices', 'fas fa-list', RoomPrices::class);
        yield MenuItem::linkToCrud('RoomSeviceOrders', 'fas fa-list', RoomServiceOrder::class);

        yield MenuItem::section('Services');
        yield MenuItem::linkToCrud('Services', 'fas fa-list', Service::class);
        yield MenuItem::linkToCrud('ServicePrices', 'fas fa-list', ServicePrice::class);
        yield MenuItem::linkToCrud('RoomServices', 'fas fa-list', RoomService::class);

        yield MenuItem::section('Employees');
        yield MenuItem::linkToCrud('Employees', 'fas fa-list', Employee::class);
        yield MenuItem::linkToCrud('Position', 'fas fa-list', Position::class);

    }
}
