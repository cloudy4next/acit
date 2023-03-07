<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FarmerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\User;
use App\Models\Farmer;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
/**
 * Class FarmerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FarmerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
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
        CRUD::setModel(\App\Models\Farmer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/farmer');
        CRUD::setEntityNameStrings('farmer', 'farmers');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('mobile');
        CRUD::column('login_code');
        CRUD::column('profession');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    // protected function setupCreateOperation()
    // {
    //     // CRUD::setValidation(FarmerRequest::class);
    //     $generate_code = bin2hex(random_bytes(4));
    //     $generate_email = $generate_code .'@acitdream.com';

    //     CRUD::field('name');
    //     CRUD::field('address');
    //     CRUD::field('mobile');
    //     CRUD::field('profession');

    //     $this->crud->addField(
    //     [
    //         'name'  => 'temp_email',
    //         'type'  => 'hidden',
    //         'value' => $generate_email,
    //     ]);

    //     $this->crud->addField(
    //     [
    //         'name'  => 'user_id',
    //         'type'  => 'hidden',
    //     ]);

    //     $this->crud->addField(
    //     [
    //         'name'  => 'login_code',
    //         'type'  => 'hidden',
    //         'value' => $generate_code,
    //     ]);

    // }

    // /**
    //  * Define what happens when the Update operation is loaded.
    //  *
    //  * @see https://backpackforlaravel.com/docs/crud-operation-update
    //  * @return void
    //  */
    // protected function setupUpdateOperation()
    // {
    //     $this->setupCreateOperation();
    // }

    public function create()
    {
        return view('admin.farmer.create');
    }

        public function store(FarmerRequest $request)
    {
        // dd($request->profession);

        $attachments = $request->image;
        if ($attachments != NULL) {
            $destinationPath = public_path() . "/uploads/farmer";
            $name = $attachments->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $fileName = preg_replace('/\s+/', '_', $fileName);
            $attachments->move($destinationPath, $fileName);
        }

        $generate_code = bin2hex(random_bytes(4));
        $generate_email = $generate_code .'@acitdream.com';

        $user_id = $this->createUser($request->name,$generate_email,$generate_code);

        $farmer = new Farmer;
        $farmer->name = $request->name;
        $farmer->image = $fileName ?? NULL;
        $farmer->address = $request->address;
        $farmer->mobile = $request->mobile;
        $farmer->login_code = $generate_code;
        $farmer->profession = $request->profession;
        $farmer->temp_email = $generate_email;
        $farmer->user_id = $user_id;
        $farmer->save();
        // dd($farmer->id);
        return redirect('admin/farmer')->with('success', 'Sucessfully Farmer Added!');


    }

    public function createUser($farmer_name,$gen_email,$gen_code) : int
    {
        $user = new User;
        $user->password = Hash::make($gen_code);
        $user->email = $gen_email;
        $user->name = $farmer_name;
        $user->is_admin = 0;
        $user->save();

        return $user->id;

    }
}
