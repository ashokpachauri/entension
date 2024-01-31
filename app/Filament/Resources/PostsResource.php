<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\Summarizers\Average;
use App\Filament\Resources\PostsResource\Pages;
use App\Filament\Resources\PostsResource\RelationManagers;
use App\Models\Posts;
use App\Models\Catagories;
use App\Models\User;
use App\Models\Comments;
use App\Models\Ratings;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->options(User::query()->pluck('name', 'id'))
                    ->live()
                    ->required(),
                Forms\Components\Select::make('catagory_id')
                    ->options(Catagories::query()->pluck('title', 'id'))
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('seo_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('seo_keywords')
                    ->maxLength(255),
                Forms\Components\Textarea::make('seo_description')
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('tags')
                    ->splitKeys(['Tab', ','])
                    ->reorderable()
                    ->color('success')
                    ->nestedRecursiveRules([
                        'min:3',
                        'max:2048',
                    ])
                    ->separator(','),
                Forms\Components\FileUpload::make('seo_image')
                    ->image(),
                Forms\Components\FileUpload::make('snippet_image')
                    ->image(),
                Forms\Components\FileUpload::make('featured_image')
                    ->image()
                    ->required(),
                //Forms\Components\Textarea::make('content')
                TinyEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                //Forms\Components\Textarea::make('snippet_content')
                TinyEditor::make('snippet_content')
                    ->required()
                    ->columnSpanFull(),
                TinyEditor::make('note')
                    ->columnSpanFull(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([  
                Tables\Columns\TextColumn::make('User.name')
                    ->searchable(), 
                Tables\Columns\TextColumn::make('Catagories.title')
                    ->searchable(),              
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('seo_title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('Ratings.rating')
                //     ->summarize(Average::make()),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // 'user' => User::class,
            // 'comments' => Comments::class,
            // 'ratings' => Ratings::class,
            // 'catagory' => Catagories::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePosts::route('/create'),
            'view' => Pages\ViewPosts::route('/{record}'),
            'edit' => Pages\EditPosts::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
