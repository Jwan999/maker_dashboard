<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Anaseqal\NovaImport\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\File;

use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudents extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Indicates if this action is only available on the resource detail view.
     *
     * @var bool
     */
    public $onlyOnIndex = true;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Import Students');
    }

    /**
     * @return string
     */
    public function uriKey(): string
    {
        return 'import-students';
    }

    /**
     * Perform the action.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        dd($fields);
        Excel::import(new StudentsImport, $fields->file);

        return Action::message('It worked!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {

//        ID::make(__('ID'), 'id')->sortable(),
//            Text::make(__('Name'), 'name'),
//
//            Number::make(__('Phone Number'), 'phone'),
//            BelongsToManyField::make('Training', 'trainings', 'App\Nova\Training')->options(\App\Models\Training::all()),
//
//            Text::make(__('Email'), 'email'),
//            BelongsToMany::make('trainings'),
//
//            RadioButton::make(__('Gender'), 'gender')
//                ->options([
//                    'Female' => 'Female',
//                    'Male' => 'Male'
//                ])
//                ->stack() // optional (required to show hints)
//                ->marginBetween() // optional
//                ->skipTransformation() // optional
//                ->toggle([  // optional
//                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
//                ]),
//
//            Text::make(__('Field of study'), 'field_of_study'),
//            Date::make(__('Date of birth'), 'date_of_birth'),
//            Select::make(__('Governorate'), 'governorate')->options([
//                'Baghdad' => 'Baghdad',
//                'Other' => 'Other'
//            ]),

        return [
//            ->default($request->user()->getKey()
            File::make('id')
                ->rules('required'),
        ];
    }
}