<?php

namespace App\Filament\Resources\SongResource\Pages;

use App\Filament\Resources\SongResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Table;
use Filament\Tables;

class ListSongs extends ListRecords
{
    protected static string $resource = SongResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\TextColumn::make('artist')->sortable()->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\IconColumn::make('has_chords')
                    ->getStateUsing(function ($record): bool { return !empty($record->chords); })
                    ->boolean(),
                Tables\Columns\TextColumn::make('tags.name')->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\TextColumn::make('times_used')->sortable(),
            ])
            ->defaultSort('times_used', 'desc');
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
