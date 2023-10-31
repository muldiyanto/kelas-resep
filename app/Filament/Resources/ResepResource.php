<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Resep;
use App\Models\Regency;
use Filament\Forms\Set;
use App\Models\Category;
use App\Models\Jenis;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ResepResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ResepResource\RelationManagers;

class ResepResource extends Resource
{
    protected static ?string $model = Resep::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Menu-Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()
               ->schema([
               Select::make('province_id')->label('Nama Propinsi')
               ->searchable()
               ->placeholder('Pilih Asal Propinsi ...')
                ->options(Province::all()->pluck('name', 'id')->toArray())->reactive(),
               Select::make('regency_id')->label('Nama Kabupaten')
                ->options(function (callable $get) {
                    $provincy = Province::find($get('province_id'));
                    if(!$provincy) {
                        return Regency::all()->pluck('name', 'id');
                    }
                    return $provincy->regencies->pluck('name', 'id');
                })
                ->placeholder('Pilih Asal Kabupaten ...')
                ->searchable()
            ]),
            Card::make()
               ->schema([
               Select::make('category_id')->label('Nama Kategori')
               ->placeholder('Pilih Kategori ...')
                ->options(Category::all()->pluck('name', 'id')->toArray())->reactive(),
               Select::make('jenis_id')->label('Jenis Kategori')
                    ->options(function (callable $get) {
                        $category = Category::find($get('category_id'));
                        if(!$category) {
                            return Jenis::all()->pluck('name', 'id');
                        }
                        return $category->jenis->pluck('name', 'id');
                    })
                    ->placeholder('Pilih Jenis ...')
                    ->searchable()
               ]),
                Card::make()
               ->schema([
                TextInput::make('name')
                                 ->afterStateUpdated(fn(Set $set, ?string $state)
                                 => $set('slug', Str::slug($state))),
                Hidden::make('slug'),
                FileUpload::make('foto')
                ->columns(1)->multiple()
                                 ->preserveFilenames()
                                 ->directory('tmp_materi')
                                 ->enableReordering()
                                 ->openable()
                                 ->downloadable()
                                 ->storeFileNamesIn('original_Filename'),
                // ->preserveFilenames(),
                RichEditor::make('bahan'),
                RichEditor::make('cara'),
                RichEditor::make('catatan'),
                ])


             ->columns(1),
                        //  TextInput::make('name')->label('Nama Resep')
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
                ImageColumn::make('foto')->label('Gambar'),
                TextColumn::make('name')->label('Nama Resep')
                ->searchable()
                ->sortable(),
                TextColumn::make('bahan')->label('Bahan-Bahan')->html(),
                TextColumn::make('cara')->label('Cara Membuat')->html(),
                TextColumn::make('catatan')->label('Catatan dan Link Video')->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->after(function (Resep $record) {
                    // delete single
                    if ($record->foto) {
                        Storage::disk('public')->delete($record->foto);
                    }
                }),
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
            'index' => Pages\ListReseps::route('/'),
            'create' => Pages\CreateResep::route('/create'),
            'edit' => Pages\EditResep::route('/{record}/edit'),
        ];
    }
}


//  FileUpload::make('bahanajar')
// //  ->storeFiles(false)
//  ->columns(1)->multiple()
//  ->preserveFilenames()
//  ->directory('tmp_materi')
//  ->enableReordering()
//  ->openable()
//  ->downloadable()
//  ->storeFileNamesIn('original_Filename'),
