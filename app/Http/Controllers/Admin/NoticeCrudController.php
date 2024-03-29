<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NoticeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NoticeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NoticeCrudController extends CrudController
{
    // $tenminutes = now()->addMinutes(10);

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
        CRUD::setModel(\App\Models\Notice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/notice');
        CRUD::setEntityNameStrings('notice', 'notices');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
         $this->crud->enableDetailsRow();
        $this->crud->setDetailsRowView('vendor.cloudy4next.crud.details_row.monster');


        CRUD::column('title');
        // CRUD::column('description');
        // CRUD::column('notice_period');
         $this->crud->addColumn([
            'name' => 'description',
            'label' => 'description',
            'type'  => 'text',

            ]);
        $this->crud->addColumn([
            'name' => 'notice_period',
            'label' => 'Notice Period',

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

        $this->crud->denyAccess(['update', 'show', 'create', 'delete']);

        if(backpack_user()->hasPermissionTo('Notice delete'))
        {
            $this->crud->allowAccess(['delete']);
        }

        if(backpack_user()->hasPermissionTo('Notice store'))
        {
            $this->crud->allowAccess('create');
        }

        if(backpack_user()->hasPermissionTo('Notice edit'))
        {
            $this->crud->allowAccess('update');
        }

        $ten_minutes = now()->addMinutes(10);

        CRUD::setValidation(NoticeRequest::class);

        CRUD::field('title');
        CRUD::field('description');

        $this->crud->addField([
                'label' => "Notice Period",
                'name' => 'notice_period',
                'type'  => 'datetime',
                ]);
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
