<?php

namespace App\Filament\Resources\SongResource\Pages;

use App\Filament\Resources\SongResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Filament\Resources\Form;

class EditSong extends EditRecord
{
    protected static string $resource = SongResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('artist')->required(),
                Forms\Components\MarkdownEditor::make('lyrics')
                    ->required()
                    ->toolbarButtons([])
                    ->hint('new slide is indicated by placing --- on its own line'),
            ]);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
