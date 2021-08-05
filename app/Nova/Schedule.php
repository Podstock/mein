<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Schedule extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Schedule::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->day . ' ' . $this->time;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'day', 'time'
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
            Text::make('day')->rules('required')->sortable(),
            Text::make('time')->rules('required')->sortable(),
            Boolean::make('pause')->hideFromIndex(),

            BelongsTo::make('Room')->nullable()->searchable()->exceptOnForms(),
            BelongsTo::make('Talk')->nullable()->searchable()->exceptOnForms(),

            Select::make('Room', 'room_id')
                ->searchable()
                ->options(\App\Models\Room::all()->pluck('slug', 'id'))
                ->displayUsingLabels()
                ->onlyOnForms()
                ->nullable(),
            Select::make('Talk', 'talk_id')
                ->searchable()
                ->options(\App\Models\Talk::all()->pluck('name', 'id'))
                ->displayUsingLabels()
                ->onlyOnForms()
                ->nullable(),
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
