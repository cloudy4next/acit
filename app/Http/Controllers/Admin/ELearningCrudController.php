<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ELearningRequest;
use App\Models\Category;
use App\Models\ELearning;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Carbon;
use File;

/**
 * Class ELearningCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ELearningCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ELearning::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/elearning');
        CRUD::setEntityNameStrings('elearning', 'e_learnings');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column('title');
        CRUD::column('category');
        CRUD::column('description');
        CRUD::column('created_at');

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
        CRUD::setValidation(ELearningRequest::class);

        CRUD::addField('title');
        CRUD::addField('category');
        CRUD::addField('description');

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
    // protected function setupUpdateOperation()
    // {
    //     $this->setupCreateOperation();
    // }

    public function create()
    {
        $category = Category::pluck('name', 'id');

        return view('admin.e-learning.create')
            ->withcategory($category);
    }


    public function store(ELearningRequest $request)
    {
        CRUD::setValidation(ELearningRequest::class);

        $attachments = $request->image;
        if ($attachments != NULL) {
            $destinationPath = public_path() . "/uploads/e_learning";
            $name = $attachments->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $fileName = preg_replace('/\s+/', '_', $fileName);
            $attachments->move($destinationPath, $fileName);
        }

        $eleraning = new ELearning();
        $eleraning->title = $request['title'];
        $eleraning->description = $request['description'];
        $eleraning->category_id = $request['category_id'];
        $eleraning->images = $fileName ?? NULL;

        $eleraning->created_at = Carbon::now();
        $eleraning->save();


        \Alert::success('E-learning successfully created!')->flash();

        return redirect('admin/elearning');
    }

    public function edit($id)
    {
        $category = Category::pluck('name', 'id');
        $data = ELearning::where('id', '=', $id)->first();

        return view('admin.e-learning.edit')
            ->withcategory($category)
            ->withData($data);
    }

    public function update(ELearningRequest $request, $id)
    {
        CRUD::setValidation(ELearningRequest::class);

        $data = ELearning::where('id', '=', $id)->first();

        if (File::exists(public_path('uploads/e_learning/' . $data->images))) {
            File::delete(public_path('uploads/e_learning/' . $data->images));
        }

        $attachments = $request->image;
        if ($attachments != NULL) {
            $destinationPath = public_path() . "/uploads/e_learning";
            $name = $attachments->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $fileName = preg_replace('/\s+/', '_', $fileName);
            $attachments->move($destinationPath, $fileName);
        }

        $eleraning = ELearning::find($id);
        $eleraning->title = $request['title'];
        $eleraning->description = $request['description'];
        $eleraning->e_category = $request['e_category'];
        $eleraning->images = $fileName ?? NULL;
        $eleraning->created_at = Carbon::now();

        $eleraning->save();
        \Alert::success('E-learning successfully updated!')->flash();

        // return redirect()->back()->withInput();
        return redirect('admin/elearning');
    }
}
