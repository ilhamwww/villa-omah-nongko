<?php
namespace App\Filament\Resources\JourneyCategoryResource\Pages;
use App\Filament\Resources\JourneyCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListJourneyCategories extends ListRecords
{
    protected static string $resource = JourneyCategoryResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}