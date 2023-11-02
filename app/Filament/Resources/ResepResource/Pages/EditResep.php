<?php

namespace App\Filament\Resources\ResepResource\Pages;

use Filament\Actions;
use App\Models\Resep;

use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ResepResource;

class EditResep extends EditRecord
{
    protected static string $resource = ResepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (Resep $record) {
                // delete single
                if ($record->foto) {
                    Storage::disk('public')->delete($record->foto);
                }
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
