<?php


namespace App\Nova;


class StudentsLocation extends \Creagia\NovaPercentageCard\NovaPercentageCard
{

    /**
     * @inheritDoc
     */
    function getCount(): float
    {
        return Student::sum('governorate');

        // TODO: Implement getCount() method.
    }

    /**
     * @inheritDoc
     */
    function getTotal(): float
    {
        return Student::select('GOVERNORATE', 'Baghdad')->get()->count();

        // TODO: Implement getTotal() method.
    }
}