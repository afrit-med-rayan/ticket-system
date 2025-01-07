<?php

namespace App\Filament\EmployeePanel\Resources\TicketResource\Pages;

use App\Filament\EmployeePanel\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
