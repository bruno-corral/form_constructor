<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormQuestionAlternativeResource\Pages;
use App\Filament\Resources\FormQuestionAlternativeResource\RelationManagers;
use App\Models\Form as ModelsForm;
use App\Models\FormQuestionAlternative;
use App\Models\Form as FormModel;
use App\Models\Question;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FormQuestionAlternativeResource extends Resource
{
    protected static ?string $model = FormQuestionAlternative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Constructor Form';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Meu codigo
                Fieldset::make('Content')
                    ->schema([
                        Hidden::make('user_id')
                            ->default(Auth::user()->id),
                        Select::make('form_id')
                            ->relationship(
                                'form', 
                                'title', 
                                fn ($query) => $query->where('is_active', true)
                                    ->where('user_id', Auth::id())
                            )
                            ->required()
                            ->placeholder('Choose a form')
                            ->label('Form'),
                        Select::make('question_id')
                            ->relationship(
                                'question', 
                                'title', 
                                fn ($query) => $query->where('user_id', Auth::id())
                            )
                            ->required()
                            ->placeholder('Choose a question')
                            ->label('Question'),
                        Select::make('alternative_id')
                            ->relationship(
                                'alternative', 
                                'title',
                                fn ($query) => $query->where('user_id', Auth::id())
                            )
                            ->required()
                            ->placeholder('Choose a alternative')
                            ->label('Alternative'),
                    ])
                    ->columns(3),


                // Meu novo codigo
                // Fieldset::make('Content')
                //     ->schema([
                //         Select::make('form_id')
                //             ->relationship(
                //                 'form', 
                //                 'title', 
                //                 fn ($query) => $query->where('is_active', true)
                //             )
                //             ->required()
                //             ->placeholder('Choose a form')
                //             ->label('Form')
                //             ->reactive()
                //             ->afterStateUpdated(fn ($state, callable $set) => $set('questions', FormModel::with('questions')->where('form_id', $state)->get())),
                //             // ->afterStateUpdated(fn ($state, callable $set) => dd($state)),

                //         Placeholder::make('question_id')
                //             ->content(function (callable $get) {
                //                 dd($get);
                //                 $question = $get('form_id');

                //                 // dd($question);
                                
                //                 if (!$question) {
                //                     return 'Selecione um formulário para carregar as perguntas.';
                //                 }

                //                 $output = '';
                //                 foreach ($questions as $index => $question) {
                //                     $output .= "<strong>" . ($index + 1) . ". {$question->title}</strong><br>";
                //                     // foreach ($question->alternatives as $altIndex => $alternativa) {
                //                     //     $letra = chr(65 + $altIndex); // A, B, C...
                //                     //     $output .= "{$letra}. {$alternativa->texto}<br>";
                //                     // }
                //                     $output .= "<br>";
                //                 }
                //                 return $output;
                //             }),
                //         // Select::make('question_id')
                //         //     ->relationship('question', 'title')
                //         //     ->required()
                //         //     ->placeholder('Choose a question')
                //         //     ->label('Question'),
                //         // Select::make('alternative_id')
                //         //     ->relationship('alternative', 'title')
                //         //     ->required()
                //         //     ->placeholder('Choose a alternative')
                //         //     ->label('Alternative'),
                //     ])
                //     ->columns(3),



                // Card::make([
                //     Select::make('form_id')
                //         ->label('Formulário')
                //         ->options(Formulario::all()->pluck('titulo', 'id'))
                //         ->reactive()
                //         ->afterStateUpdated(fn ($state, callable $set) => $set('perguntas', Pergunta::with('alternatives')->where('form_id', $state)->get())),
                    
                //     Placeholder::make('perguntas_placeholder')
                //         ->content(function (callable $get) {
                //             $perguntas = $get('perguntas');
                            
                //             if (! $perguntas) {
                //                 return 'Selecione um formulário para carregar as perguntas.';
                //             }

                //             $output = '';
                //             foreach ($perguntas as $index => $pergunta) {
                //                 $output .= "<strong>" . ($index + 1) . ". {$pergunta->texto}</strong><br>";
                //                 foreach ($pergunta->alternativas as $altIndex => $alternativa) {
                //                     $letra = chr(65 + $altIndex); // A, B, C...
                //                     $output .= "{$letra}. {$alternativa->texto}<br>";
                //                 }
                //                 $output .= "<br>";
                //             }
                //             return $output;
                //         })
                //         ->columnSpanFull()
                //         ->hidden(fn (callable $get) => empty($get('perguntas'))),
                // ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_active_form')
                    ->boolean()
                    ->label('Form Active'),
                Tables\Columns\TextColumn::make('form_id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('form.title')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('form.title'),
            TextEntry::make('question.title')
                ->label('Question'),
            TextEntry::make('alternative.title'),
            TextEntry::make('alternative.is_correct')
                ->label('Correct Alternative?')
                ->formatStateUsing(fn ($state) => $state ? 'Correct' : 'Incorrect'),
            TextEntry::make('created_at')
                ->dateTime('d/m/Y H:i:s'),
        ])
        ->columns(5);
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
            'index' => Pages\ListFormQuestionAlternatives::route('/'),
            'create' => Pages\CreateFormQuestionAlternative::route('/create'),
            'edit' => Pages\EditFormQuestionAlternative::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }
}
