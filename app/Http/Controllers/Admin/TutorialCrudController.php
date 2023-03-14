<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TutorialRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TutorialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TutorialCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Tutorial::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tutorial');
        CRUD::setEntityNameStrings('tutorial', 'tutorials');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
                $this->crud->denyAccess(['update', 'show', 'create', 'delete']);

        if(backpack_user()->hasPermissionTo('Tutorial delete'))
        {
            $this->crud->allowAccess(['delete']);
        }

        if(backpack_user()->hasPermissionTo('Tutorial store'))
        {
            $this->crud->allowAccess('create');
        }

        if(backpack_user()->hasPermissionTo('Tutorial edit'))
        {
            $this->crud->allowAccess('update');
        }

        $this->crud->addColumn([
            'name' => 'row_number',
            'type' => 'row_number',
            'label' => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        CRUD::column('title');

            $this->crud->addColumn([
            'name' => 'category_id',
            'label' => 'Type',
        ]);

        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Publish Date',
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TutorialRequest::class);

        CRUD::field('category_id');
        CRUD::field('title');
        CRUD::field('url');
        CRUD::field('description');

        $this->crud->addField(
        [
            'name'  => 'user_id',
            'type'  => 'hidden',
            'value' => backpack_user()->id,
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
