<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;
use File;
/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
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

        if(backpack_user()->hasPermissionTo('Post delete'))
        {
            $this->crud->allowAccess(['delete']);
        }

        if(backpack_user()->hasPermissionTo('Post store'))
        {
            $this->crud->allowAccess('create');
        }

        if(backpack_user()->hasPermissionTo('Post edit'))
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
        // CRUD::column('category_id');
            $this->crud->addColumn([
            'name' => 'category_id',
            'label' => 'Type',
        ]);

        // CRUD::column('created_at');
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
    public function create()
    {
        $category = Category::pluck('name', 'id');

        return view('admin.post.create')
            ->withcategory($category);
    }

    public function store(PostRequest $request)
    {
        $attachments = $request->image;
        if ($attachments != NULL) {
            $destinationPath = public_path() . "/uploads/post";
            $name = $attachments->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $fileName = preg_replace('/\s+/', '_', $fileName);
            $attachments->move($destinationPath, $fileName);
        }
        $post = new Post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->user_id = backpack_user()->id;
        $post->created_at = Carbon::now();
        $post->image = $fileName ?? NULL;
        $post->save();


        \Alert::success('post successfully created!')->flash();

        return redirect('admin/post');
    }

    public function edit($id)
    {
        $category = Category::pluck('name', 'id');
        $data = post::where('id', '=', $id)->first();

        return view('admin.post.edit')
            ->withcategory($category)
            ->withData($data);
    }
    public function update(postRequest $request, $id)
    {
        $data = post::where('id', '=', $id)->first();

        if (File::exists(public_path('uploads/post/' . $data->image))) {
            File::delete(public_path('uploads/post/' . $data->image));
        }

        $attachments = $request->image;
        if ($attachments != NULL) {
            $destinationPath = public_path() . "/uploads/post";
            $name = $attachments->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $fileName = preg_replace('/\s+/', '_', $fileName);
            $attachments->move($destinationPath, $fileName);
        }
        $post = post::find($id);
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->user_id = backpack_user()->id;
        $post->created_at = Carbon::now();
        $post->image = $fileName ?? NULL;

        $post->save();
        \Alert::success('post successfully updated!')->flash();

        return redirect()->back()->withInput();
    }
}
