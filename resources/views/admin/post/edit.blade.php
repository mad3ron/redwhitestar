<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <a href="{{ route('posts.index') }}" class="text-lg font-medium mr-auto" data-lucide="refresh-ccw">
            Catatan Penting
        </a>
    </div>
    <div class="intro-y box py-10 sm:py-10 mt-5">
        <div class="px-5 sm:px-10">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="post_date">Post Date</label>
                    <input type="datetime-local" name="post_date" id="post_date" class="form-control" required value="{{ $post->post_date }}">
                </div>
                <div class="form-group mt-5">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ $post->title }}">
                </div>
                <div class="form-group mt-5">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
                </div>
                <div class="form-group mt-5">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control-file">
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
