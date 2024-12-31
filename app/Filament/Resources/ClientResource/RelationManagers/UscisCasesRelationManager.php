<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class UscisCasesRelationManager extends RelationManager
{
    protected static string $relationship = 'uscisCases';

    protected static ?string $recordTitleAttribute = 'case_number';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('case_number')->required(),
                           
                Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'denied' => 'Denied',
                ])
                ->default('pending')
                ->required(),
                Forms\Components\Textarea::make('last_status')->nullable(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('case_number')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'primary' => 'pending',
                    'success' => 'approved',
                    'danger' => 'denied',
                ])
                ->sortable(),
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
