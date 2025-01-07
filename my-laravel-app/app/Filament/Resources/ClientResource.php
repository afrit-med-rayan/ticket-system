<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ViewAction;

class ClientResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Clients';
    protected static ?string $modelLabel = 'Clients';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $slug = 'Clients';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->description('Provide details about the user.')
                    ->schema([
                        Forms\Components\TextInput::make('firstname')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('lastname')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('adresse')
                            ->label('Address')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Hidden::make('role')
                            ->default('client')
                            ->required(),
                    ])->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->query(
                fn () => User::query()->where('role', 'client')
            )
            ->columns([
                Tables\Columns\TextColumn::make('firstname')
                    ->label('First Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->label('Last Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('adresse')
                    ->label('Address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->default('client'),
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
            ->filters([])
            ->actions([
                ViewAction::make(),
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
            'index' => Pages\ListClients::route('/'),
            'view' => Pages\ViewClients::route('/{record}'),
        ];
    }
}
