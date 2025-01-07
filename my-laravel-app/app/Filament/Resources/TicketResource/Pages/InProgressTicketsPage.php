<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class InProgressTicketsPage extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->whereIn('status', ['initialized', 'being_processed']);
    }
}
