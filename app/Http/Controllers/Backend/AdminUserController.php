<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Admin;
use Jenssegers\Agent\Agent;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminUser;
use App\Http\Requests\UpdateAdminUser;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('backend.admin_management.index');
    }

    public function create()
    {

        return view('backend.admin_management.create');
    }

    public function store(StoreAdminUser $request)
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);

        $admin->save();

        return redirect()->route('admin.admin-user.index')->with('create', 'Successfully Created');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('backend.admin_management.edit', compact('admin'));
    }

    public function update($id, UpdateAdminUser $request)
    {

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = $request->password ? Hash::make($request->password) : $admin->password;

        $admin->update();

        return redirect()->route('admin.admin-user.index')->with('update', 'Successfully Updated !');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        $admin->delete();

        return "success";
    }

    public function server()
    {
        return Datatables::of(Admin::query())
            ->addColumn('action', function ($e) {

                $edit = '<a href=" ' . route('admin.admin-user.edit', $e->id) . ' " class="text-warning"><i class="fa fa-edit"></i> Edit</a>';

                $delete = '<a href="" class="text-danger delete" data-id="' . $e->id . '"><i class="fa fa-trash"></i> Delete</a>';
                return $edit . "   " . $delete;
            })
            ->editColumn('user_agent', function ($e) {
                if ($e->user_agent) {
                    $agent = new Agent();
                    $agent->setUserAgent($e->user_agent);
                    $device = $agent->device();
                    $platform = $agent->platform();
                    $browser = $agent->browser();

                    return '
            <table class="table table-bordered">
                <tbody>
                    <tr><td>Platform</td><td>' . $platform . '</td></tr>
                    <tr><td>Browser</td><td>' . $browser . '</td></tr>
                </tbody>
            </table>';
                }
            })
            ->editColumn('created_at' , function($e){
                $create = Carbon::parse($e->created_at)->format('Y-m-d H:i:s');
                return $create;
            })
            ->rawColumns(['action', 'user_agent'])

            ->make(true);
    }

}
