<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CasePhotoResource\Pages;
use App\Models\CasePhoto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CasePhotoResource extends Resource
{
    protected static ?string $model = CasePhoto::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = '網站管理';
    protected static ?string $navigationLabel = '案例照片管理';
    protected static ?string $modelLabel = '案例照片';
    protected static ?string $pluralModelLabel = '案例照片';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('照片資訊')
                    ->schema([
                        Forms\Components\Select::make('project_case_id')
                            ->label('案例')
                            ->relationship('projectCase', 'name')
                            ->required()
                            ->searchable(),

                        Forms\Components\FileUpload::make('image')
                            ->label('案例照片')
                            ->image()
                            ->imageEditor()
                            ->directory('cases')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file): string => (string) str(Str::uuid7() . '.webp')
                            )
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);
                                $image->cover(1024, 1024);
                                $filename = Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/cases'))) {
                                    mkdir(storage_path('app/public/cases'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/cases/' . $filename));
                                return 'cases/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            }),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('projectCase.name')
                    ->label('案例名稱')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('照片')
                    ->size(60),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('排序')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project_case_id')
                    ->label('案例')
                    ->relationship('projectCase', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListCasePhotos::route('/'),
            'create' => Pages\CreateCasePhoto::route('/create'),
            'edit' => Pages\EditCasePhoto::route('/{record}/edit'),
        ];
    }
} 