<div class="ol-card">
    <div class="ol-card-body">
        <form action="{{ route(get_current_user_role() . '.task.update', $task->id) }}" method="post" id="ajaxForm">
            @csrf
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="project_id" value="{{ $task->project_id }}" />
                    <input type="hidden" name="milestone_id" value="{{ $task->milestone_id }}" />
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="title">{{ get_phrase('Title') }}</label>
                        <input class="form-control ol-form-control" type="text" id="title" name="title"
                            value="{{ $task->title }}">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="milestone">{{ get_phrase('Milestone') }}</label>
                        <input class="form-control ol-form-control" type="text" id="milestone" name="milestone"
                            value="{{ $task->milestone }}">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="status">{{ get_phrase('Status') }}</label>
                        <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="status"
                            id="status">
                            <option value="not_started" {{ $task->status == 'not_started' ? 'selected' : '' }}>
                                {{ get_phrase('Not Started') }}</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                {{ get_phrase('In Progress') }}</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                {{ get_phrase('Completed') }}</option>
                        </select>
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="progress">{{ get_phrase('Progress') }}</label>
                        <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="progress"
                            id="progress">
                            <option>{{ get_phrase('Select a type') }}</option>
                            <option value="0" {{ $task->progress == '0' ? 'selected' : '' }}>0%</option>
                            <option value="25" {{ $task->progress == '25' ? 'selected' : '' }}>25%</option>
                            <option value="50" {{ $task->progress == '50' ? 'selected' : '' }}>50%</option>
                            <option value="75" {{ $task->progress == '75' ? 'selected' : '' }}>75%</option>
                            <option value="100" {{ $task->progress == '100' ? 'selected' : '' }}>100%</option>
                        </select>
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="client">{{ get_phrase('Client') }}</label>
                        <input class="form-control ol-form-control" type="text" id="client" name="client"
                            value="{{ $task->client }}">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="team">{{ get_phrase('Team') }}</label>
                        <input class="form-control ol-form-control" type="number" id="team" name="team"
                            value="{{ $task->team }}">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="start_date">{{ get_phrase('Start Date') }}</label>
                        <input class="form-control ol-form-control" type="text" id="start_date" name="start_date"
                            value="{{ date('d-m-Y', $task->start_date) }}" required>
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="end_date">{{ get_phrase('End Date') }}</label>
                        <input class="form-control ol-form-control" type="text" id="end_date" name="end_date"
                            value="{{ date('d-m-Y', $task->end_date) }}" required>
                    </div>
                    <div class="fpb7 mb-2">
                        <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('ajax')
