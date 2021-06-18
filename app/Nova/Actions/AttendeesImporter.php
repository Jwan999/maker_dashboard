<?php

namespace App\Nova\Actions;

use App\Imports\AttendeesImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Maatwebsite\Excel\Facades\Excel;

class AttendeesImporter extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
//        dd('test');
        $event = $models->first();
        $file = $fields->get('file');
        if ($event && $file)
            try {
                Excel::import(new AttendeesImport($event), $file);
            } catch (\Exception $exception) {
                return Action::danger("Couldn't read file: " . $exception->getMessage());
            }
        else
            return Action::danger("You must select the event and upload a valid excel file");

        return Action::message("Attendees imported successfully");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make("Excel File", "file")->rules("required", "file")
        ];
    }

    public function name()
    {
        return "Import Attendees";
    }
}
