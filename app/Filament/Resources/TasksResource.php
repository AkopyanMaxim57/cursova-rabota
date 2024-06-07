<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TasksResource\Pages;
use App\Filament\Resources\TasksResource\RelationManagers;
use App\Models\Customers;
use App\Models\Tasks;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Schema\Blueprint;

class TasksResource extends Resource
{
    protected  static ?string  $pluralModelLabel = 'Замовлення';
    protected static ?string $model = Tasks::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {


        return $form
            ->schema([
                Select::make('company')
                    ->options(function () {
                        // Fetch unique company names from the Customers model
                        return Customers::pluck('company')->unique()->mapWithKeys(function ($company) {
                            return [$company => $company];
                        })->toArray();
                    }),
                TextInput::make('name_task')->label('Task Name'),
                TextInput::make('earn')->label('Earnings'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Чернетка' => 'Чернетка',
                        'В роботі' => 'В роботі',
                        'Завершено' => 'Завершено',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company'),
                TextColumn::make('name_task'),
                TextColumn::make('earn'),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        switch ($state) {
                            case 'Чернетка':
                                return '<span style="color: blue;">' . ucfirst($state) . '</span>';
                            case 'В роботі':
                                return '<span style="color: orange;">' . ucfirst($state) . '</span>';
                            case 'Завершено':
                                return '<span style="color: green;">' . ucfirst($state) . '</span>';
                            default:
                                return $state;
                        }
                    })->html(),
                TextColumn::make('created_at')

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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTasks::route('/create'),
            'edit' => Pages\EditTasks::route('/{record}/edit'),
        ];
    }
}
