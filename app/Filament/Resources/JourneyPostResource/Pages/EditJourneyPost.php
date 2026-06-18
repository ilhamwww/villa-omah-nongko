<?php
namespace App\Filament\Resources\JourneyPostResource\Pages;
use App\Filament\Resources\JourneyPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditJourneyPost extends EditRecord
{
    protected static string $resource = JourneyPostResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}