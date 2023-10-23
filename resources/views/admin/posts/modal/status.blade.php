{{-- hide --}}
<div class="modal fade" id="unhide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                    <i class="fa-solid fa-eye"></i> Unhide Post
                </h3>
            </div>

            <div class="modal-body">
                Are you sure you want to unhide this post?
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- HIDE --}}
<div class="modal fade" id="hide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title text-warning">
                    <i class="fa-solid fa-eye-slash"></i> Hide Post
                </h3>
            </div>

            <div class="modal-body">
                Are you sure you want to hide this post?
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>