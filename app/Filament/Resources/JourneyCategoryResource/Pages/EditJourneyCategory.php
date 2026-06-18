<?php
namespace App\Filament\Resources\JourneyCategoryResource\Pages;
use App\Filament\Resources\JourneyCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditJourneyCategory extends EditRecord
{
    protected static string $resource = JourneyCategoryResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}