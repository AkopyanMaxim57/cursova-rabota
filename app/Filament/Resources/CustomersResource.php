<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Filament\Resources\CustomersResource\RelationManagers;
use App\Models\Customers;
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

class CustomersResource extends Resource
{
    protected static ?string $model = Customers::class;
    protected  static ?string  $pluralModelLabel = 'Клієнти';

    protected static ?string $navigationIcon = 'heroicon-o-identification';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('phone')->numeric(),
                TextInput::make('company'),
                Select::make('city')
                    ->options([
                        'kyiv' => 'Kyiv',
                        'kharkiv' => 'Kharkiv',
                        'odesa' => 'Odesa',
                        'dnipro' => 'Dnipro',
                        'zaporizhzhia' => 'Zaporizhzhia',
                        'lviv' => 'Lviv',
                        'kryvyi_rih' => 'Kryvyi Rih',
                        'mykolaiv' => 'Mykolaiv',
                        'sevastopol' => 'Sevastopol',
                        'vinnytsia' => 'Vinnytsia',
                        'kherson' => 'Kherson',
                        'poltava' => 'Poltava',
                        'cherkasy' => 'Cherkasy',
                        'chernihiv' => 'Chernihiv',
                        'chernivtsi' => 'Chernivtsi',
                        'zhytomyr' => 'Zhytomyr',
                        'sumy' => 'Sumy',
                        'rivne' => 'Rivne',
                        'kamianske' => 'Kamianske',
                        'kropyvnytskyi' => 'Kropyvnytskyi',
                    ])
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company'),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('city'),


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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomers::route('/create'),
            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
