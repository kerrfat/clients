<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),
                Forms\Components\TextInput::make('full_name')->required(),
                Forms\Components\TextInput::make('email_address')->email()->required(),
                Forms\Components\TextInput::make('email_password')->password()->required(),
                Forms\Components\TextInput::make('uscis_password')->password()->required(),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')->label('Client')->sortable(),
                Tables\Columns\TextColumn::make('full_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email_address')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),

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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
