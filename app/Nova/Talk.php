<?php

namespace App\Nova;

use App\Models\Talk as ModelsTalk;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class Talk extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Talk::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Name')->displayUsing(function ($value) {
                return Str::limit($value, 30);
            })->onlyOnIndex(),
            Text::make('Name')->hideFromIndex(),

            Select::make('Wishtime')
                ->options(ModelsTalk::getWishtimes())
                ->displayUsingLabels(),

            Select::make('Status')
                ->options(ModelsTalk::getStatus())
                ->displayUsingLabels(),

            BelongsTo::make('Schedule')->exceptOnForms()->sortable(),
            Textarea::make('description')->hideFromIndex()->alwaysShow(),
            Textarea::make('comment')->hideFromIndex()->alwaysShow(),
            BelongsTo::make('user')->searchable()->nullable()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
