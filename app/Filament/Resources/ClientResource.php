<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\Textarea::make('address'),
                Forms\Components\TextInput::make('company'),
                Forms\Components\Textarea::make('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('company'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
        ->headerActions([
            Tables\Actions\CreateAction::make(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\Action::make('View Accounts')
                    ->url(fn (Client $record) => route('filament.admin.resources.accounts.index', ['record' => $record->id]))
                    ->icon('heroicon-o-eye'),
            
        ])
        ->filters([
            Tables\Filters\Filter::make('Created Today')
                ->query(fn ($query) => $query->whereDate('created_at', now()->toDateString())),
            Tables\Filters\SelectFilter::make('Company')
                ->options(fn () => Client::query()
                    ->pluck('company', 'company')
                    ->filter()
                    ->toArray()),
            Tables\Filters\Filter::make('Email Verified')
                ->query(fn ($query) => $query->whereNotNull('email_verified_at')),
        ])
        ->bulkActions([
            Tables\Actions\BulkAction::make('Delete')
                ->action(function (Collection $records) {
                    $records->each->delete();
                })
                ->color('danger')
                ->icon('heroicon-o-trash'),

            Tables\Actions\BulkAction::make('Export PDF')
                ->action(function (Collection $records) {
                    $pdf = Pdf::loadView('clients.pdf', ['clients' => $records]);
                    return response()->streamDownload(fn () => print($pdf->output()), 'clients.pdf');
                })
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray'),

                
        ]);
    }

    public static function getRelations(): array
    {
        return [
              \App\Filament\Resources\ClientResource\RelationManagers\AccountsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
