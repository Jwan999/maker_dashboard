<?php

namespace App\Imports;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendeesImport implements ToCollection, WithHeadingRow
{
    /**
     * @var Event
     */
    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $data) {
                $old = Attendee::where("email", "=", $data["email"])->first();
                if (!$this->checkRow($data))
                    continue;

                $model = $old ?: $this->create($data);
                $this->event->attendees()->attach($model->id);

            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception("There was an error with the data, nothing imported. {$exception->getMessage()}");
        }
    }

    public function checkRow($row)
    {
        $pass = null;
        $fields = ["name", "number", "email"];
        foreach ($fields as $field) {
            $pass = isset($row[$field]) && $row[$field] != null;
        }
        return $pass;
    }

    private function create($data)
    {
        $new = new Attendee;

        $new->name = $this->safeGet($data, "name");;
        $new->number = $this->safeGet($data, "number");
        $new->email = $this->safeGet($data, "email");
        $new->gender = $this->safeGet($data, "gender");
        $new->age = $this->safeGet($data, "age");

        $new->save();
        return $new;
    }

    private function safeGet($data, $key)
    {
        return isset($data[$key]) ? $data[$key] : null;
    }
}
