<?php

namespace Pandorga\Laramie\Resources;

use Illuminate\Http\Request;
use Pandorga\Laramie\Fields\ID;
use Pandorga\Laramie\Fields\Text;

class Admin extends Resource
{
    /**
     * The underlying model resource instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public static $model = \Pandorga\Laramie\Models\Admin::class;

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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields()
    {
        return [
            ID::make(),
            Text::make('Nombre', 'firstname'),
            Text::make('Apellido', 'lastname'),
            Text::make('Email', 'email'),
            Text::make('Password', 'password')
                ->onlyOnForms(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function label()
    {
        return 'Administradores';
    }

    /**
     * {@inheritDoc}
     */
    public static function singularLabel()
    {
        return 'Administrador';
    }

    /**
     * {@inheritDoc}
     */
    public static function uriKey()
    {
        return 'admins';
    }

    public function createRules() : array
    {
        return [
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required|min:6',
        ];
    }

    public function updateRules($resourceId) : array
    {
        return [
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:admins,email,' . $resourceId,
            'password'  => 'required|min:6',
        ];
    }
}
