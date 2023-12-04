<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('roles.index') }}" class="font-medium text-base mr-auto">
                    Edit role
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input id="name" type="text" name="name" value="{{ $role->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Role name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <select class="tom-select w-full" id="permissions" name="permissions[]" multiple>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
