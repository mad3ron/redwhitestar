<x-app-layout>

    @if (session('success'))
    <!-- BEGIN: Notification Content -->
    <div id="notification-with-avatar-content" class="toastify-content  flex">
        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"> <img alt="Midone - HTML Admin Template" src="dist/images/profile-8.jpg"> </div>
        <div class="ml-4 sm:mr-28">
            <div class="font-medium">Al Pacino</div>
            <div class="text-slate-500 mt-1">See you later! 😃😃😃</div>
        </div> <a data-dismiss="notification" class="absolute top-0 bottom-0 right-0 flex items-center px-6 border-l border-slate-200/60 dark:border-darkmode-400 font-medium text-primary dark:text-slate-400" href="javascript:;">Reply</a>
    </div>
    <!-- END: Notification Content -->
     @endif
    <div class="container mx-auto px-4 sm:px-8">

        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Create Role</h2>
            </div>
            <div class="my-6">
                <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')@enderror"  placeholder="roles" required>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select class="tom-select w-full" id="permissions" name="permissions[]" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Role</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        var roleInput = document.getElementById("role");
        var roleIdInput = document.getElementById("role_id");

        roleIdInput.addEventListener("change", function() {
            var role = roleIdInput.options[roleIdInput.selectedIndex].text;

            if (role === "") {
                roleInput.value = "";
            } else {
                roleInput.value = role;
            }
        });
    </script>

</x-app-layout>
