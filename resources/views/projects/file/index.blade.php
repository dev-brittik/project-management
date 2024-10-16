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
                        onclick="rightCanvas('{{ route(get_current_user_role() . '.file.create', ['code' => request()->route()->parameter('code')]) }}', 'Create file')"
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
                    @foreach ($files as $key => $file)
                        <tr data-id="{{ $file->id }}" class="context-menu">
                            <td style="padding: 18px;">
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
                                        <h4 class="title fs-14px">{{ $file->size }}{{ get_phrase('MB') }}</h4>
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
                            <td style="padding: 6px 18px;">
                                <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                    <div class="dAdmin_profile_name">
                                        <a href="{{ route(get_current_user_role() . '.file.download', $file->id) }}">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect y="0.000282288" width="32" height="32" rx="6"
                                                    fill="#F7F7F9" />
                                                <path
                                                    d="M12.9296 13.3904L12.9296 13.3904L12.9286 13.3905C11.6139 13.5146 10.6542 13.9365 10.0246 14.7078C9.39588 15.478 9.10332 16.5882 9.10332 18.0736V18.1603C9.10332 19.8027 9.45436 20.987 10.2271 21.7598C10.9999 22.5326 12.1842 22.8836 13.8267 22.8836H18.1733C19.8157 22.8836 21 22.5326 21.7728 21.7615C22.5456 20.9904 22.8967 19.8094 22.8967 18.1736V18.0869C22.8967 16.5914 22.5991 15.4745 21.9602 14.7026C21.3204 13.9296 20.3457 13.5112 19.0111 13.3971C18.7022 13.3679 18.4461 13.5964 18.4169 13.8954C18.3874 14.1976 18.6157 14.4608 18.9151 14.49L18.9158 14.4901C19.9763 14.5796 20.6917 14.8686 21.1444 15.4316C21.5984 15.9963 21.7967 16.8469 21.7967 18.0803V18.1669C21.7967 19.5202 21.5567 20.4212 20.9921 20.9858C20.4275 21.5504 19.5265 21.7903 18.1733 21.7903H13.8267C12.4735 21.7903 11.5724 21.5504 11.0078 20.9858C10.4432 20.4212 10.2033 19.5202 10.2033 18.1669V18.0803C10.2033 16.8536 10.3982 16.0061 10.8442 15.4413C11.2888 14.8783 11.991 14.5861 13.0313 14.4901L13.0314 14.4901C13.339 14.4608 13.5591 14.1896 13.5298 13.8888C13.5003 13.587 13.222 13.3685 12.9296 13.3904Z"
                                                    fill="#6B708A" stroke="#6B708A" stroke-width="0.1" />
                                                <path
                                                    d="M15.45 17.9203C15.45 18.2212 15.6991 18.4703 16 18.4703C16.3005 18.4703 16.55 18.2283 16.55 17.9203V9.33362C16.55 9.03267 16.3009 8.78362 16 8.78362C15.6991 8.78362 15.45 9.03267 15.45 9.33362V17.9203Z"
                                                    fill="#6B708A" stroke="#6B708A" stroke-width="0.1" />
                                                <path
                                                    d="M15.6115 19.0556C15.7214 19.1655 15.861 19.2169 16.0002 19.2169C16.1394 19.2169 16.279 19.1655 16.3889 19.0556L18.6222 16.8223C18.8351 16.6094 18.8351 16.2578 18.6222 16.0449C18.4094 15.8321 18.0577 15.8321 17.8449 16.0449L16.0002 17.8896L14.1556 16.0449C13.9427 15.8321 13.5911 15.8321 13.3782 16.0449C13.1653 16.2578 13.1653 16.6094 13.3782 16.8223L15.6115 19.0556Z"
                                                    fill="#6B708A" stroke="#6B708A" stroke-width="0.1" />
                                            </svg>
                                        </a>
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
                            rightCanvas("{{ url(get_current_user_role() . '/file/edit/') }}" + '/' +
                                id,
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
