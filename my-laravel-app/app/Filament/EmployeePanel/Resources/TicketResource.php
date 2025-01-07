<?php

namespace App\Filament\EmployeePanel\Resources;

use App\Filament\EmployeePanel\Resources\TicketResource\Pages;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Tickets';
    protected static ?string $navigationGroup = 'Support';
    protected static ?string $slug = 'tickets';

    
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'being_processed' => 'Being Processed',
                        'accepted' => 'Accepted',
                        'not_accepted' => 'Not Accepted',
                    ])
                    ->required()
                    ->rules(function ($get) {
                        return $get('status') === 'initialized'
                            ? ['status' => 'The status cannot be set to "initialized".']
                            : [];
                    }),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Type')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
                TextColumn::make('ticket_text')
                    ->label('Description')
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('user.firstname')
                    ->label('Client Name')
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Client Email')
                    ->sortable(),
                TextColumn::make('user.phone_number')
                    ->label('Client Phone Number')
                    ->sortable(),
            ])
            ->filters([])
            ->searchable()
            ->actions([
                EditAction::make()
            ])
            ->bulkActions([]);
    }


    public static function getRelations(): array
    {
        return [];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}
