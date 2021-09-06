<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\WalletGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user_management.index');
    }

    public function create()
    {

        return view('backend.user_management.create');
    }

    public function store(StoreUser $request)
    {

        DB::beginTransaction();
        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);

            $user->save();

            Wallet::firstOrCreate(

                [
                    'user_id' => $user->id,
                ],

                [
                    'account_number' => WalletGenerate::accountNumber(),
                    'amount' => 0,
                ]

            );
            DB::commit();
            return redirect()->route('admin.user.index')->with('create', 'Successfully Created');
        } catch (Exception $err) {
            DB::rollBack();
            return back()->withErrors(['fails' => 'Account Create not success !'])->withInput();
        }

    }

    public function show()
    {

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.user_management.edit', compact('user'));
    }

    public function update($id, UpdateUser $request)
    {
        DB::beginTransaction();
        try {

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;

            $user->update();
            Wallet::firstOrCreate(

                [
                    'user_id' => $user->id,
                ],

                [
                    'account_number' => WalletGenerate::accountNumber(),
                    'amount' => 0,
                ]

            );
            DB::commit();

            return redirect()->route('admin.user.index')->with('update', 'Successfully Updated !');
        } catch (Exception $err) {
            DB::rollBack();
            return back()->withErrors(['fails' => 'Account Update not success !'])->withInput();
        }

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Wallet::where('user_id' , $id)->delete();
        $user->delete();


        return "success";
    }

    public function server()
    {
        return Datatables::of(User::query())
            ->addColumn('action', function ($e) {

                $edit = '<a href=" ' . route('admin.user.edit', $e->id) . ' " class="text-warning"><i class="fa fa-edit"></i> Edit</a>';

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
            ->editColumn('created_at', function ($e) {
                $create = Carbon::parse($e->created_at)->format('Y-m-d H:i:s');
                return $create;
            })
            ->rawColumns(['action', 'user_agent'])

            ->make(true);
    }
}
