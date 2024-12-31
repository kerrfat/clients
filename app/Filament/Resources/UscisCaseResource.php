<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UscisCaseResource\Pages;
use App\Filament\Resources\UscisCaseResource\RelationManagers;
use App\Models\UscisCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UscisCaseResource extends Resource
{
    protected static ?string $model = UscisCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Client Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('client_id')
                ->relationship('client', 'name')
                ->required(),
            Forms\Components\TextInput::make('case_number')->required(),
             // Allow null
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'denied' => 'Denied',
                ])
                ->default('pending') // Default value
                ->required(),
                Forms\Components\Textarea::make('last_status')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('client.name')->label('Client')->sortable(),
            Tables\Columns\TextColumn::make('case_number')->sortable()->searchable(),
            Tables\Columns\BadgeColumn::make('status')
            ->colors([
                'primary' => 'pending',
                'success' => 'approved',
                'danger' => 'denied',
            ])
            ->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUscisCases::route('/'),
            'create' => Pages\CreateUscisCase::route('/create'),
            'edit' => Pages\EditUscisCase::route('/{record}/edit'),
        ];
    }
}
