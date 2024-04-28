<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Role;
use App\Models\GroupPermission;
use Carbon\Carbon;

class RoleController extends Controller
{

    public function __construct()
    {
        view()->share([
            'role_active' => 'active'
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
        $roles = Role::with('permissionRole')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissionGroups = GroupPermission::select('*')->with('permissions')->get();
        return view('admin.role.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $role = new Role();
            $role->name = safeTitle($request->name);
            $role->display_name = $request->name;
            $role->description = $request->description;

            if ($role->save()) {
                if(!empty($request->permissions)) {
                    foreach($request->permissions as $permission) {
                        \DB::table('permission_role')->insert(['permission_id'=> $permission, 'role_id'=> $role->id]);
                    }
                }
            }

            \DB::commit();
            return redirect()->back()->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
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
        $role = Role::find($id);
        $listPermission = \DB::table('permission_role')->where('role_id', $id)->pluck('permission_id')->toArray();
        $permissionGroups = GroupPermission::select('*')->with('permissions')->get();

        if(!$role) {
            return redirect()->route('get.list.role')->with('danger', 'Quyền không tồn tại');
        }
        $viewData = [
            'listPermission' => $listPermission,
            'permissionGroups' => $permissionGroups,
            'role' =>$role,
        ];

        return view('admin.role.edit', $viewData);
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
        \DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = safeTitle($request->name);
            $role->display_name = $request->name;

            if ($role->save()) {
                if(!empty($request->permissions)) {
                    \DB::table('permission_role')->where('role_id', $id)->delete();
                    if(!empty($request->permissions)) {
                        foreach($request->permissions as $permission) {
                            \DB::table('permission_role')->insert(['permission_id'=> $permission, 'role_id'=> $role->id]);
                        }
                    }
                }
            }

            \DB::commit();
            return redirect()->back()->with('success', 'Chỉnh sửa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $role = Role::findOrFail($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $role->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
        //
    }
}
