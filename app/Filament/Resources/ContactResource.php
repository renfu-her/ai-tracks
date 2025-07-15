<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = '網站管理';
    protected static ?string $navigationLabel = '聯絡我們管理';
    protected static ?string $modelLabel = '聯絡我們';
    protected static ?string $pluralModelLabel = '聯絡我們';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('姓名')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('電話'),
                Forms\Components\TextInput::make('email')
                    ->label('信箱')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->label('主旨')
                    ->required(),
                Forms\Components\Textarea::make('message')
                    ->label('訊息')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('處理狀態')
                    ->options([
                        'pending' => '待處理',
                        'processing' => '處理中',
                        'completed' => '已完成',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\Textarea::make('reply')
                    ->label('回覆內容'),
                Forms\Components\DateTimePicker::make('replied_at')
                    ->label('回覆時間'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('姓名')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('信箱'),
                Tables\Columns\TextColumn::make('subject')->label('主旨'),
                Tables\Columns\TextColumn::make('status')->label('狀態')->badge()->color(fn($state) => match($state) {
                    'pending' => 'warning',
                    'processing' => 'info',
                    'completed' => 'success',
                }),
                Tables\Columns\TextColumn::make('created_at')->label('建立時間')->dateTime('Y-m-d H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
