@php
    $project_files = App\Models\File::paginate(10);
@endphp

<div class="ol-card">
    <div class="ol-card-body">
        <!-- Search and filter -->
        <div class="row mt-3 mb-4 print-d-none">
            <div class="col-md-6 d-flex align-items-center gap-3">
                <div class="custom-dropdown ms-2">
                    <button class="dropdown-header btn ol-btn-light">
                        Export
                        <i class="fi-rr-file-export ms-2"></i>
                    </button>
                    <ul class="dropdown-list">
                        <li>
                            <a class="dropdown-item export-btn" href="#"
                                onclick="downloadPDF('.print-table', 'course-list')"><i class="fi-rr-file-pdf"></i>
                                PDF</a>
                        </li>
                        <li>
                            <a class="dropdown-item export-btn" href="#" onclick="window.print();"><i
                                    class="fi-rr-print"></i>
                                Print</a>
                        </li>
                    </ul>
                </div>
                <div class="">
                    <a href="#"
                        onclick="rightCanvas('{{ route(get_current_user_role() . '.file.create', ['id' => request()->route()->parameter('id')]) }}', 'Create file')"
                        class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                        <span class="fi-rr-plus"></span>
                        <span>{{ get_phrase('Add') }}</span>
                    </a>
                </div>
                <div class="custom-dropdown dropdown-filter   ">
                    <button class="dropdown-header btn ol-btn-light">
                        <i class="fi-rr-filter me-2"></i>
                        Filter

                    </button>
                    <ul class="dropdown-list w-250px">
                        <li>
                            <form id="filter-dropdown" action="#courses" method="get">
                                <div class="filter-option d-flex flex-column gap-3">
                                    <div>
                                        <label for="eDataList" class="form-label ol-form-label">Category</label>
                                        <select
                                            class="form-control ol-form-control ol-select2 select2-hidden-accessible"
                                            name="category">
                                            <option value="yoga">Yoga</option>
                                            <option value="vinyasa-yoga">--Vinyasa yoga
                                            </option>
                                            <option value="restorative-yoga">--Restorative Yoga
                                            </option>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="eDataList" class="form-label ol-form-label">Status</label>
                                        <select
                                            class="form-control ol-form-control ol-select2 select2-hidden-accessible">
                                            <option value="active">Active </option>
                                            <option value="inactive">Inactive </option>
                                            <option value="pending">Pending </option>
                                            <option value="upcoming">Upcoming </option>
                                            <option value="private">Private </option>
                                            <option value="draft">Draft </option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="eDataList" class="form-label ol-form-label">Instructor</label>
                                        <select
                                            class="form-control ol-form-control ol-select2 select2-hidden-accessible">
                                            <option value="1"> John Doe </option>
                                            <option value="2">James Mariyati</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="eDataList" class="form-label ol-form-label">Price</label>
                                        <select
                                            class="form-control ol-form-control ol-select2 select2-hidden-accessible">
                                            <option value="free">Free</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-button d-flex justify-content-end align-items-center mt-3">
                                    <button type="submit" class="ol-btn-primary">Apply</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- Table -->
        <div class="d-flex justify-content-center align-items-center" id="spinnner-before-table">
            <div class="spinner-border text-primary spinner-border-lg" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="table-responsive overflow-auto course_list d-none" id="project_list">
            <table class="table eTable eTable-2 " id="datatable">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">{{ get_phrase('Title') }}</th>
                        <th scope="col">{{ get_phrase('Type') }}</th>
                        <th scope="col">{{ get_phrase('Size') }}</th>
                        <th scope="col">{{ get_phrase('Date') }}</th>
                        <th scope="col">{{ get_phrase('Uploaded By') }}</th>
                        <th scope="col">{{ get_phrase('Download') }}</th>
                        <th scope="col" class="print-d-none">{{ 'Options' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project_files as $key => $file)
                        <tr data-id="{{ $file->id }}" class="context-menu">
                            <td>
                                <input type="checkbox" class="checkbox-item">
                            </td>
                            <td scope="row">
                                <p class="row-number">{{ ++$key }}</p>
                            </td>
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <h4 class="title fs-14px">{{ $file->title }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <h4 class="title fs-14px">{{ $file->extension }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <h4 class="title fs-14px">{{ $file->size }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <h4 class="title fs-14px">{{ $file->timestamp_start }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <h4 class="title fs-14px">{{ $file->user_id }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <a
                                            href="{{ route(get_current_user_role() . '.file.download', $file->id) }}">{{ get_phrase('Download') }}</a>
                                        {{-- <h4 class="title fs-14px">{{ $file->size }}</h4> --}}
                                    </div>
                                </div>
                            </td>
                            <td class="print-d-none">
                                <div class="dropdown ol-icon-dropdown ol-icon-dropdown-transparent">
                                    <button class="btn ol-btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="fi-rr-menu-dots-vertical"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                onclick="rightCanvas('{{ route(get_current_user_role() . '.file.edit', $file->id) }}', 'Edit file')"
                                                href="#">{{ get_phrase('Edit') }}</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                onclick="confirmModal('{{ route(get_current_user_role() . '.file.delete', $file->id) }}')"
                                                href="javascript:void(0)">{{ get_phrase('Delete') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button id="delete-selected" class="btn btn-danger d-none">Delete</button>
        </div>
    </div>
</div>

@include('ajax')
@push('js')
    <script>
        $(document).ready(function() {
            // Initialize context menu
            $.contextMenu({
                selector: '.context-menu',
                autoHide: false,
                items: {
                    Edit: {
                        name: "Edit",
                        callback: function(itemKey, opt, e) {
                            const id = opt.$trigger.attr("data-id");
                            rightCanvas("{{ url(get_current_user_role() . '/file/edit/') }}" + '/' + id,
                                'Edit file')
                        }
                    },
                    Delete: {
                        name: "Delete",
                        callback: function(itemKey, opt, e) {
                            const id = opt.$trigger.attr("data-id");
                            confirmModal("{{ url(get_current_user_role() . '/file/delete/') }}" + '/' +
                                id)
                        }
                    }
                }
            });



            // Handle multi-deletion
            $('#delete-selected').click(function() {
                const selectedIds = $('.checkbox-item:checked').map(function() {
                    return $(this).closest('tr').data('id');
                }).get();

                if (selectedIds.length > 0) {
                    ajaxCall("{{ route(get_current_user_role() . '.file.multi-delete') }}", selectedIds);
                    $('#delete-selected').addClass('d-none');
                } else {
                    alert('Please select at least one file to delete.');
                }
            });
        });
    </script>
@endpush
