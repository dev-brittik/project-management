<div class="ol-card">
    <div class="ol-card-body">
        <!-- Table -->
        <div class="table-responsive overflow-auto course_list" id="project_list">
            <table class="table eTable eTable-2" id="">
                <thead>
                    <th scope="col">{{ get_phrase('Tasks') }}</th>
                    <th scope="col">{{ get_phrase('Progress') }}</th>
                </thead>

                <tbody>
                    @foreach ($tasks as $task)
                        <tr data-id="{{ $task->id }}" class="context-menu">
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <h4 class="title fs-14px">{{ $task->title }}</h4>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
