<?php

namespace App\Filament\Resources\AnalitycsResource\Pages;

use App\Filament\Resources\AnalitycsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnalitycs extends ListRecords
{
    protected static string $resource = AnalitycsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
