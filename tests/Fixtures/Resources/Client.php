<?php

namespace DigitalCreative\Dashboard\Tests\Fixtures\Resources;

use DigitalCreative\Dashboard\AbstractResource;
use DigitalCreative\Dashboard\Fields\EditableField;
use DigitalCreative\Dashboard\Fields\PasswordField;
use DigitalCreative\Dashboard\Fields\ReadOnlyField;
use DigitalCreative\Dashboard\Fields\SelectField;
use DigitalCreative\Dashboard\Tests\Fixtures\Filters\GenderFilter;
use DigitalCreative\Dashboard\Tests\Fixtures\Models\Client as ClientModel;

class Client extends AbstractResource
{

    public static $model = ClientModel::class;

    public function fields(): array
    {
        return [
            ReadOnlyField::make('id'),
            EditableField::make('name'),
            EditableField::make('email')->rules('email'),
            SelectField::make('gender')->options([ 'male' => 'Male', 'female' => 'Female' ]),
            PasswordField::make('password'),
        ];
    }

    public function filters(): array
    {
        return [
            new GenderFilter()
        ];
    }

}
