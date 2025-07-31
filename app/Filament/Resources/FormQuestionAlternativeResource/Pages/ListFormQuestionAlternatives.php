<?php

namespace App\Filament\Resources\FormQuestionAlternativeResource\Pages;

use App\Filament\Resources\FormQuestionAlternativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormQuestionAlternatives extends ListRecords
{
    protected static string $resource = FormQuestionAlternativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
