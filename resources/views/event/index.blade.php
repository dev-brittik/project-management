@extends('layouts.admin')

@section('content')
    <div class="ol-card radius-8px print-d-none">
        <div class="ol-card-body my-3 py-3 px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('Events') }}
                </h4>
                <button onclick="rightCanvas('{{ route(get_current_user_role() . '.event.create') }}', 'Create event')"
                    class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                    <span class="fi-rr-plus"></span>
                    <span>{{ get_phrase('Add new') }}</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ol-card">
                <div class="ol-card-body p-3">

                    <div id='calendar'></div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let getEvents = @json($events);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
                },
                initialDate: @json(date('Y-m-d', strtotime('now'))),
                navLinks: true,
                nowIndicator: true,
                editable: true,
                selectable: true,
                dayMaxEvents: true,
                events: getEvents,
                height: 'auto',
                contentHeight: 600,
                eventClick: function(info) {
                    var eventId = info.event.id;
                    let url = "{{ route(get_current_user_role() . '.event.edit') }}?event_id=" +
                        eventId;
                    modal('Edit Event', url);
                },

                eventDidMount: function(info) {
                    info.el.style.backgroundColor = info.event.extendedProps.backgroundColor ||
                        "#EEF6FF";

                    info.el.style.color = info.event.extendedProps.textColor ||
                        "#0A1017";

                    const borderRadius = info.event.extendedProps.borderRadius ||
                        "8px";
                    const padding = info.event.extendedProps.padding || "10px"; // Default padding
                    const border = info.event.extendedProps.border ||
                        "1px solid #7BD3EA";

                    info.el.style.borderRadius = borderRadius;
                    info.el.style.padding = padding;
                    info.el.style.height = "auto";
                    info.el.style.border = border;


                }
            });

            calendar.render();
        });
    </script>
@endpush
