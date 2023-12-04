<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('users.index') }}" class="font-medium text-base mr-auto">
                    Edit user
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form method="POST" action="{{ route('users.update', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">User</label>
                                <input id="name" name="name" type="text" value="{{ $user->name  }}" class="form-control" />
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="username" class="form-label">User Name</label>
                                <input id="username" name="username" type="text" value="{{ $user->username }}" class="form-control" />
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Email</label>
                                <input id="email" name="email" type="text" value="{{ $user->email }}" class="form-control" />
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Role</label>
                                <select class="tom-select w-full" name="role_id" data-search="true" required >
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Is visible</label>
                                <select id="status" name="status" data-search="true" class="tom-select w-full">
                                    @foreach (App\Enums\TableActive::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($status->value == $user->status)>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="permission">Permission:</label>
                                <select class="tom-select w-full" name="permissions[]" id="permission" multiple>
                                    @foreach($permissions as $permission)
                                        @php $selected = in_array($permission->id, $user->permissions->pluck('id')->toArray()) @endphp
                                        <option value="{{ $permission->id }}" {{ $selected ? 'selected' : '' }}>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <!---Button-->
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
