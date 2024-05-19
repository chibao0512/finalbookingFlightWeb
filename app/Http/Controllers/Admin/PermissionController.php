<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\GroupPermission;
use Illuminate\Support\Facades\DB;


class PermissionController extends Controller
{
    public function __construct(GroupPermission $groupPermission)
    {
        view()->share([
            'permission_active' => 'active',
            'permissionGroups' => $groupPermission->all()
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::with([
            'groups' => function($groups)
            {
                $groups->select('id', 'name');
            }
        ])->orderBy('id', 'DESC')->paginate(10);

        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $this->createOrUpdate($request);
            DB::commit();
            return redirect()->back()->with('success', 'Create new successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = Permission::findOrFail($id);

        if (!$permission) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $this->createOrUpdate($request, $id);
            DB::commit();
            return redirect()->back()->with('success', 'Update successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $permission = Permission::find($id);
        if (!$permission) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $permission->delete();
            return redirect()->back()->with('success', 'Delete succesfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function createOrUpdate($request , $id ='')
    {
        $permission = new Permission();

        if ($id)
        {
            $permission = Permission::findOrFail($id);
        }

        $permission->name                       = safeTitle($request->name);
        $permission->display_name               = $request->name;
        $permission->group_permission_id        = $request->group_permission_id;
        $permission->description                = $request->description;

        $permission->save();
    }
}
