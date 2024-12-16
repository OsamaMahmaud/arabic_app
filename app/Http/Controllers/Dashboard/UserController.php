<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use App\Traits\ImageTrait;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\updateUserRequest;


class UserController extends Controller
{

    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    //

    public function __construct()
    {
        // read , create , update , delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');


    }
    public function index(Request $request):View
    {

        // $users = User::all();
        // $users = User::whereRoleIs(['admin', 'regular-user'])->get();
        $users = User::whereHasRole('admin')->where(function ($q) use ($request) {

            return $q->when($request->search,function($query)use($request){

                return $query->where('first_name','like','%'.$request->search.'%')

                ->orWhere('last_name','like','%'.$request->search.'%'); });
            })->latest()->Paginate(5);

        return view('dashboard.users.index',compact('users'));
    }//end of index


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd( $request->permissions);
        $request_data=$request->except(['password','password_confirmation','permissions']);

        $request_data['password']=bcrypt($request->password);

        if($request->image)
        {
          $file_name=$this->saveImage($request->image,'uploads/user_images');
          $request_data['image']=  $file_name;
        }

        $user=User::create($request_data);

        $user->addRole('admin');

        $user->syncPermissions($request->permissions);

    //    session()->flash('success', __('site.added_successfully'));
       return redirect()->route('dashboard.users.index')->with('success', __('site.added_successfully'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $users=User::find($id);

        // dd($user);

        return view('dashboard.users.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, string $id)
    {

        $request_data=$request->except(['permissions']);

        // dd($request_data);
        // Find the user instance by ID
        $user = User::findOrFail($id);

        if($request->image)
        {
             if($request->image!='default.png')
             {
                Storage::disk('public_uploads')->delete('/user_images/'.$user->image);
             }
          $file_name=$this->saveImage($request->image,'uploads/user_images');
          $request_data['image']=  $file_name;

        }

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

       return redirect()->route('dashboard.users.index')->with('success', __('site.updated_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);

        if($user->image!='default.png')
        {
            Storage::disk('public_uploads')->delete('/user_images/'.$user->image);
        }
        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', __('site.deleted_successfully'));
    }
}
