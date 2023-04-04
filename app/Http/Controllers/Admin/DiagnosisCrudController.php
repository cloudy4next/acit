<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DiagnosisRequest;
use App\Models\Diagnosis;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Carbon;
/**
 * Class DiagnosisCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DiagnosisCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Diagnosis::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/diagnosis');
        CRUD::setEntityNameStrings('diagnosis', 'diagnoses');
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
        $this->crud->removeButtons(['delete', 'update',]);
        $this->crud->enableExportButtons();
        $this->crud->addClause('where', 'response_text','=', null);

        if(backpack_user()->hasPermissionTo('Diagnosis reply'))
        {
            $this->crud->addButtonFromModelFunction('line', 'editMessage', 'editMessage', 'end');

        }



        CRUD::column('title');
        CRUD::column('user_id');
        CRUD::column('category_id');
        CRUD::column('description');
        CRUD::column('audio');
        CRUD::column('image');
        CRUD::column('video');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

        public function messageData($id)
    {
        $diagnosis = Diagnosis::where('id', '=', $id)->first();
        return view('admin.diagnosis.edit')->withdiagnosis($diagnosis);
    }

    public function replyMessage(DiagnosisRequest $request, $id)
    {

        $diagnosis = Diagnosis::find($id);
        $diagnosis->response_text = $request['replay'];
        $diagnosis->replay_by = backpack_user()->id;
        $diagnosis->replay_at = Carbon::now();
        $diagnosis->save();

        \Alert::success('Successfully Replyed!')->flash();

        return redirect()->back()->withInput();

    }
}
