<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('users.index') }}" class="font-medium text-base mr-auto">
                    Personal Information
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5">

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Name</label>
                                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input name"  value="{{ old('name') }}" minlength="3" required>

                                @error('name')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" name="username" class="form-control" placeholder="Input Username" value="{{ old('username') }}" minlength="3" required>
                                @error('username')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="Input email" value="{{ old('email') }}" minlength="3" required>
                                @error('email')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Role</label>
                                <select name="roles[]" id="roles" data-search="true" class="tom-select w-full">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('roles')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" placeholder="Input password">
                                @error('password')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                                @error('password_confirmation')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Is visible</label>
                                <select id="status" name="status" data-search="true" class="tom-select w-full">
                                    <option value="">Select Status</option>
                                    @foreach (App\Enums\TableActive::cases() as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!---Button-->
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
