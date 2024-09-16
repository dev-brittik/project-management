<div class="ol-card">
    <div class="ol-card-body">
        <form action="{{ route(get_current_user_role() . '.file.update', $file->id) }}" method="post" id="ajaxForm">
            @csrf
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="project_id" value="{{ $file->project_id }}" />
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="title">Title</label>
                        <input class="form-control ol-form-control" type="text" id="title" name="title"
                            value="{{ $file->title }}">
                    </div>
                    <div class="fpb7 mb-2">
                        <button type="submit" class="btn ol-btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('ajax')
