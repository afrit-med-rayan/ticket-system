<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Reviews';
    protected static ?string $modelLabel = 'Review';

    // Define the form for creating/editing reviews
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // The rating is now a star-based selection
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
                    ->default(5),

                Forms\Components\Textarea::make('comment')
                    ->label('Comment')
                    ->columnSpanFull(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.firstname')
                    ->label('User')
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . ' Stars'),
                    Tables\Columns\TextColumn::make('comment')
                    ->label('Comment')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                ViewAction::make(),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                   
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [

        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),

            'view' => Pages\ViewReview::route('/{record}'),

        ];
    }


    public static function afterSave(Review $review)
    {
        $review->user_id = auth()->id();
        $review->ticket_id = request()->route('ticket_id');
        $review->save();
    }
}
