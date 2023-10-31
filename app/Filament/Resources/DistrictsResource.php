<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\District;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DistrictsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DistrictsResource\RelationManagers\VillagesRelationManager;

// use App\Filament\Resources\DistrictsResource\RelationManagers;

class DistrictsResource extends Resource
{
    protected static ?string $model = District::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Referensi Asal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 TextInput::make('id')->label('Kode Kecamatan'),
                 TextInput::make('name')->label('Nama Kecamatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('No')->state(
                     static function (HasTable $livewire, stdClass $rowLoop): string {
                         return (string) (
                             $rowLoop->iteration + ($livewire->getTableRecordsPerPage()
                        * ($livewire->getTablePage() - 1))
                         );
                     }
                 ),
                TextColumn::make('id')->label('Kode')->sortable(),
                TextColumn::make('name')->label('Nama Kecamatan')
                ->searchable()
                ->sortable(),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            VillagesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistricts::route('/'),
            'create' => Pages\CreateDistricts::route('/create'),
            'edit' => Pages\EditDistricts::route('/{record}/edit'),
        ];
    }
}
