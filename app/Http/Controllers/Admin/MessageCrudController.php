<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
/**
 * Class MessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MessageCrudController extends CrudController
{
    use CreateOperation { store as traitStore; }
    use DeleteOperation;
    use ListOperation;
    use ShowOperation { show as traitShow; }
    use UpdateOperation { update as traitUpdate; }


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Message::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/message');
        CRUD::setEntityNameStrings('message', 'messages');
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
        $this->crud->removeButtons(['delete', 'update']);
        $this->crud->enableExportButtons();

        $this->crud->addButtonFromModelFunction('line', 'editMessage', 'editMessage', 'end');

        CRUD::column('user_id');
        CRUD::column('category_id');
        CRUD::column('title');
        // CRUD::column('read_by');
        // CRUD::column('read_at');
        CRUD::column('total_messages');
    }



    public function messageData()
    {
        dd('0');
    }
}
