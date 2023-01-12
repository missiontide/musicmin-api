<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Table;
use Filament\Tables;

class ListTags extends ListRecords
{
    protected static string $resource = TagResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\TextColumn::make('type')->sortable()->searchable(isIndividual: true, isGlobal: false),
            ])
            ->defaultSort('name', 'asc');
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
