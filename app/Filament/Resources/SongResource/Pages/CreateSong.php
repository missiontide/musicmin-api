<?php

namespace App\Filament\Resources\SongResource\Pages;

use App\Filament\Resources\SongResource;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateSong extends CreateRecord
{
    protected static string $resource = SongResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('artist')->required(),
                Forms\Components\TextInput::make('key'),
                Forms\Components\TextInput::make('tempo'),
                Forms\Components\MarkdownEditor::make('lyrics')
                    ->required()
                    ->disableAllToolbarButtons()
                    ->hint('new slide is indicated by placing --- on its own line'),
                Forms\Components\RichEditor::make('chords')->toolbarButtons(['bold', 'undo', 'redo'])
                    ->hint('anything in Bold will be interpreted as a chord. Shift + Space to make a new line'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->hint('must be format: lowercase-title-lowercase-artist-chords'),
                Forms\Components\Select::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name'),
            ]);
    }
}
