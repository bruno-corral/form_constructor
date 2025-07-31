<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlternativeResource\Pages;
use App\Filament\Resources\AlternativeResource\RelationManagers;
use App\Models\Alternative;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlternativeResource extends Resource
{
    protected static ?string $model = Alternative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Content')
                    ->schema([
                        Select::make('question_id')
                            ->relationship('question', 'title')
                            ->required()
                            ->placeholder('Choose a question')
                            ->label('Question'),
                        TextInput::make('title')
                            ->placeholder('Title')
                            ->required(),
                        Checkbox::make('is_correct')
                            ->default(false),
                    ])
                    ->columns(3),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('question.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_correct')
                    ->boolean()
                    ->sortable()
                    ->label('Correct'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlternatives::route('/'),
            'create' => Pages\CreateAlternative::route('/create'),
            'edit' => Pages\EditAlternative::route('/{record}/edit'),
        ];
    }
}
