@extends('backend.master')
@section('content')
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Permission</th>
                            <th class="text-center">Created Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $role->name ?? 'N/A' }}</td>
                                <td>
                                    @foreach ($role->getPermissionNames() as $per)
                                        <li>{{ $per }}</li>
                                    @endforeach
                                </td>
                                <td>{{ $role->created_at->format('d/M/Y') ?? 'N/A' }}</td>
                                <td>
                                    <a href=""class="btn btn-success">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $roles->links() }} --}}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Users</th>
                            <th class="text-center">Users Role</th>
                            <th class="text-center">Users Permission</th>
                            {{-- <th class="text-center">Created Date</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name ?? 'N/A' }}</td>
                                <td>
                                    @foreach ($user->getRoleNames() as $ur)
                                        {{-- ur = user role --}}
                                        <li>{{ $ur }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($user->getAllPermissions() as $up)
                                        {{-- up = user permission --}}
                                        <li>{{ $up->name }}</li>
                                    @endforeach
                                </td>
                                {{-- <td>{{ $role->created_at->format('d/M/Y') ?? 'N/A' }}</td> --}}
                                <td>
                                    <a href=""class="btn btn-success">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $roles->links() }} --}}
            </div><!-- table-responsive -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="table-responsive">
                <table class="table table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $permission->name ?? 'N/A' }}</td>

                                <td>
                                    <a href=""class="btn btn-success">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $roles->links() }} --}}
            </div><!-- table-responsive -->
        </div><!-- card -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-6">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="{{ route('RoleAddToPermission') }}" method="post">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Role: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="role_name" id="role_name" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->

                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Permission: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="permission_name" id="role_name" class="form-control">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button type="submit" class="btn btn-info mg-r-5 ">Asign</button>
                        </div><!-- form-layout-footer -->

                        <div class="form-layout-footer mg-t-30">
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card -->
            </div><!-- col-6 -->
            <div class="col-xl-6">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="{{ route('RoleAddToUser') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Role: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="role_name" id="role_name" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->

                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">User: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button type="submit" class="btn btn-info mg-r-5 ">Asign</button>
                        </div><!-- form-layout-footer -->

                        <div class="form-layout-footer mg-t-30">
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card -->
            </div><!-- col-6 -->
        </div>
    </div><!-- sl-pagebody -->
@endsection
