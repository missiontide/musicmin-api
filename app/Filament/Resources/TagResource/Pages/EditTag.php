<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;

class EditTag extends EditRecord
{
    protected static string $resource = TagResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('type')->required(),
            ]);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
