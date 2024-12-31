<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use App\Models\Account;

class AccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $recordTitleAttribute = 'full_name';

    public  function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')->required(),
                Forms\Components\TextInput::make('email_address')->email()->required(),
                Forms\Components\TextInput::make('email_password')->password()->required(),
                Forms\Components\TextInput::make('uscis_password')->password()->required(),
            ]);
    }

    public  function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name'),
                Tables\Columns\TextColumn::make('email_address'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ]);
            
            
           
    }
}
