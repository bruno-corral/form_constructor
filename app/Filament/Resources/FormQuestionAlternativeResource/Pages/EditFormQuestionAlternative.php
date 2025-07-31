<?php

namespace App\Filament\Resources\FormQuestionAlternativeResource\Pages;

use App\Filament\Resources\FormQuestionAlternativeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormQuestionAlternative extends EditRecord
{
    protected static string $resource = FormQuestionAlternativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
