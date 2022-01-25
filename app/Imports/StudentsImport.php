<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
     * @var Training
     */
    private Training $training;

    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $data) {

                $old = Student::where("email", "=", $data["email"])->first();
                if (!$this->checkRow($data))
                    continue;

                $model = $old ?: $this->create($data);
                $this->training->students()->attach($model->id);
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

        $fields = ["name", "phone"];
        foreach ($fields as $field) {
            $pass = isset($row[$field]) && $row[$field] != null;
        }
        return $pass;
    }

    private function create($data)
    {
        $new = new Student;

        $new->name = $data->has("first") ? $data["first"] . " " . $data["second"] . " " . $data["third"] : $data["first"];
        $new->phone = $this->safeGet($data, "phone");
        $new->email = $data->has("email") && $data["email"] != NULL ? $data["email"] : $data["phone"] . "@iotkids.org";
//        dd($data->has("email") ? $data["email"] : $data["phone"] . "@iotkids.org");
//        $this->safeGet($data, "email")

        $new->gender = $this->safeGet($data, "gender");
        $new->field_of_study = $this->safeGet($data, "field_of_study");

        $new->age = $this->safeGet($data, "age");
        $new->governorate = $this->safeGet($data, "governorate");
        $new->university = $this->safeGet($data, "university");
        $new->save();
        return $new;
    }

    private function safeGet($data, $key)
    {
        return isset($data[$key]) ? $data[$key] : null;
    }
}
