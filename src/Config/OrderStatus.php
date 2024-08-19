<?php

namespace App\Config;

enum OrderStatus: string
{
    case ordered = 'Заказан';
    case inProgress = 'В процессе';
    case completed = 'Выполнен';
}
