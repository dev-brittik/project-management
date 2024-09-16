<div class="ol-card">
    <div class="ol-card-body">
        <form action="{{ route(get_current_user_role() . '.task.store') }}" method="post" id="ajaxForm">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="project_id" value="{{ $project_id }}" />
                    <input type="hidden" name="milestone_id" value="{{ $milestone_id }}" />
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="title">{{ get_phrase('Title') }}</label>
                        <input class="form-control ol-form-control" type="text" id="title" name="title">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="milestone">{{ get_phrase('Milestone') }}</label>
                        <input class="form-control ol-form-control" type="text" id="milestone" name="milestone">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="status">{{ get_phrase('Status') }}</label>
                        <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="status"
                            id="status" required>
                            <option value="">
                                {{ get_phrase('Select') }}</option>
                            <option value="not_started">{{ get_phrase('Not Started') }}
                            </option>
                            <option value="in_progress">{{ get_phrase('In Progress') }}
                            </option>
                            <option value="completed">{{ get_phrase('Completed') }}
                            </option>
                        </select>
                    </div>
                    <div class="fpb-7 mb-3">
                        <label class="form-label ol-form-label">{{ get_phrase('Type') }}</label>
                        <select name="type" id="type" class="form-control ol-form-control ol-select2"
                            data-toggle="select2" required>
                            <option>{{ get_phrase('Select a type') }}</option>
                            <option value="1">{{ get_phrase('Sales') }}</option>
                            <option value="2">{{ get_phrase('Purchase') }}</option>
                        </select>
                    </div>
                    <div class="fpb7 mb-3">
                        <label class="form-label ol-form-label" for="progress">{{ get_phrase('Progress') }}</label>
                        <select class="form-control ol-form-control ol-select" data-toggle="select-2" name="progress"
                            id="progress">
                            <option value="">
                                {{ get_phrase('Select ') }}</option>
                            <option value="0">0%</option>
                            <option value="25">25%</option>
                            <option value="50">50%</option>
                            <option value="75">75%</option>
                            <option value="100">100%</option>
                        </select>
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="client">{{ get_phrase('Client') }}</label>
                        <input class="form-control ol-form-control" type="text" id="client" name="client">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="team">{{ get_phrase('Team') }}</label>
                        <input class="form-control ol-form-control" type="number" id="team" name="team">
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="start_date">{{ get_phrase('Start Date') }}</label>
                        <input class="form-control ol-form-control" type="date" id="start_date" name="start_date"
                            required>
                    </div>
                    <div class="fpb7 mb-2">
                        <label class="form-label ol-form-label" for="end_date">{{ get_phrase('End Date') }}</label>
                        <input class="form-control ol-form-control" type="date" id="end_date" name="end_date"
                            required>
                    </div>
                    <div class="fpb7 mb-2">
                        <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('script')
@include('ajax')
