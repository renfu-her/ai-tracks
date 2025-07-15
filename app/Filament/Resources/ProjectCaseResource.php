<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectCaseResource\Pages;
use App\Models\ProjectCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ProjectCaseResource\RelationManagers\CasePhotosRelationManager;

class ProjectCaseResource extends Resource
{
    protected static ?string $model = ProjectCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = '網站管理';
    protected static ?string $navigationLabel = '案例管理';
    protected static ?string $modelLabel = '案例';
    protected static ?string $pluralModelLabel = '案例';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('基本資訊')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('名稱')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('url')
                            ->label('網址')
                            ->url()
                            ->maxLength(255),

                        MarkdownEditor::make('content')
                            ->label('內容')
                            ->minHeight(450)
                            ->columnSpanFull(),
                            
                        Forms\Components\Toggle::make('status')
                            ->label('狀態')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('名稱')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->label('網址')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->label('狀態')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('狀態'),
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
            CasePhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectCases::route('/'),
            'create' => Pages\CreateProjectCase::route('/create'),
            'edit' => Pages\EditProjectCase::route('/{record}/edit'),
        ];
    }
} 