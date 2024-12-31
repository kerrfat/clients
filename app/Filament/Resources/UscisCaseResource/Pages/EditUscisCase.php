<?php

namespace App\Filament\Resources\UscisCaseResource\Pages;

use App\Filament\Resources\UscisCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUscisCase extends EditRecord
{
    protected static string $resource = UscisCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
