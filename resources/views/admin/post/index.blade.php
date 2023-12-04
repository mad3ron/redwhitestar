<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <a href="{{ route('posts.index') }}"  class="text-lg font-medium mr-auto data-lucide=" refresh-ccw>
             Catatan Penting
        </a>
        <div class="text-center">
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#create-post-modal" class="btn btn-primary">Add Posts</a>
        </div>

         <!-- Create Post Modal -->
        <div id="create-post-modal" class="modal modal-slide" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">Create Post</h2>
                        <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="post_date">Post Date</label>
                                <input type="datetime-local" name="post_date" id="post_date" class="form-control" required>
                            </div>
                            <div class="form-group mt-5">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group mt-5">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="form-group mt-5">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control-file">
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="mt-5">
                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

<!-- BEGIN: Post -->
<div class="intro-y grid grid-cols-12 gap-6 mt-5">

    @foreach ($posts as $post)
        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                <div class="ml-3 mr-auto">
                    <a href="{{ route('posts.index') }}" class="font-medium">
                        {{ $post->user->name }} <span class="mx-1">•</span> {{ $post->created_at->format('d/m/Y') }}
                    </a>
                </div>
                <div class="dropdown ml-3">
                    <a href="javascript:;" class="dropdown-toggle w-5 h-5 text-slate-500" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">
                                    <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit Post
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="h-40 2xl:h-56 image-fit">
                    <img alt="Post Image" class="rounded-md" src="{{ $post->getPhotoUrl() }}">
                </div>
                <a href="#" class="block font-medium text-base mt-5" data-post-id="{{ $post->id }}">{{ $post->title }}</a>
                <div class="text-slate-600 dark:text-slate-500 mt-2 content-container" id="content-{{ $post->id }}">
                    <p>{{ $post->content }}</p>
                    <button class="show-more-button" onclick="showMore({{ $post->id }})">See More...</button>
                </div>
            </div>
            <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <div class="w-full flex text-slate-500 text-xs sm:text-sm">
                    <div class="mr-2">Comments: <span class="font-medium">{{ $post->comments->count() }}</span></div>
                    <div class="mr-2">Views: <span class="font-medium">{{ $post->comments->sum('views') }}</span></div>
                    <div class="ml-auto">Likes: <span class="font-medium">{{ $post->comments->sum('likes') }}</span></div>
                    <i id="heart-icon-{{ $post->id }}" data-lucide="heart" class="block mx-auto cursor-pointer"></i>
                </div>
                <div class="w-full flex items-center mt-3">
                    <div class="w-8 h-8 flex-none image-fit mr-3">
                        <img alt="Profile Picture" class="rounded-full" src="{{ asset('dist/images/profile-picture.jpg') }}">
                    </div>
                    <form action="{{ route('comments.store', ['postId' => $post->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <input type="text" name="comment" id="comment" class="form-control" required value="{{ old('comment') }}">
                        </div>
                        @error('comment')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Comment</button>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary mt-2">Cancel</a>
                    </form>

                    @if ($post->comments->count() > 0)
                        <div class="mt-4">
                            <h3>Comments:</h3>
                            <ul class="list-group">
                                @foreach ($post->comments as $comment)
                                    <li class="list-group-item">{{ $comment->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mendapatkan tanggal dan waktu saat ini
        var currentDate = new Date();

        // Mengubah zona waktu menjadi Waktu Standar Indonesia (WIB)
        currentDate.setUTCHours(currentDate.getUTCHours() + 7);

        // Mengubah format tanggal dan waktu menjadi format yang diterima oleh input datetime-local
        var formattedDate = currentDate.toISOString().slice(0, 16);

        // Mengatur nilai input dengan tanggal dan waktu saat ini
        document.getElementById('post_date').value = formattedDate;

        // Mendapatkan elemen input komentar
        var commentInput = document.getElementById('comment');
        var commentForm = document.getElementById('comment-form');
        var commentButton = document.getElementById('comment-button');

        commentButton.addEventListener('click', function(event) {
            event.preventDefault();
            commentForm.submit();
        });
    </script>
    <script>
        @foreach ($posts as $post)
            var heartIcon{{ $post->id }} = document.getElementById('heart-icon-{{ $post->id }}');

            heartIcon{{ $post->id }}.addEventListener('click', function() {
                heartIcon{{ $post->id }}.classList.toggle('red-heart');
            });
        @endforeach
    </script>
    <style>
        .content-container {
            max-height: 100px;
            overflow: hidden;
        }

        .expanded-content {
            max-height: none;
            overflow: visible;
        }

        #heart-icon-{{ $post->id }} {
            fill: black;
        }

        #heart-icon-{{ $post->id }}.red-heart {
            fill: red;
        }
    </style>
</x-app-layout>
