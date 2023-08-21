<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nip')
                        ->label('NIP'),
                    TextInput::make('name'),
                    TextInput::make('teacher_id')
                        ->label('Teacher ID')
                        ->mask(fn (TextInput\Mask $mask) => $mask->pattern('{TCHR}000-00-00')),
                    Select::make('subject_id')
                        ->label('Subject')
                        ->relationship('subject', 'name'),
                    TextInput::make('address_1'),
                    TextInput::make('address_2'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nip')
                    ->label('NIP'),
                TextColumn::make('name'),
                TextColumn::make('teacher_id')
                    ->label('Teacher ID'),
                TextColumn::make('subject.name')
                    ->label('Subject'),
                TextColumn::make('address_1'),
                TextColumn::make('address_2'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
