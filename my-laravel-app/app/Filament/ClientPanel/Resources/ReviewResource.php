<?php

namespace App\Filament\ClientPanel\Resources;

use App\Filament\ClientPanel\Resources\ReviewResource\Pages;
use App\Models\Review;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'My Reviews'; // Client-specific label

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ticket_id')
                    ->label('Ticket')
                    ->options(
                        Ticket::where('user_id', auth()->id()) // Only tickets owned by the client
                            ->whereIn('status', ['accepted', 'not_accepted']) // Only tickets in accepted or not_accepted status
                            ->pluck('ticket_text', 'id')
                    )
                    ->required(),

                Forms\Components\Select::make('rating')
                    ->label('Rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->required()
                    ->rules('in:1,2,3,4,5') // Validation for allowed values (1 to 5)
                    ->default(5), // Default to 5 stars

                Forms\Components\Textarea::make('comment')
                    ->label('Comment')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ticket.ticket_text')->label('Ticket'),
                Tables\Columns\TextColumn::make('rating')->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . ' Stars'),
                Tables\Columns\TextColumn::make('comment')->label('Comment'),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id()); // Only show reviews for the logged-in client
    }
}
