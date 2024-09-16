@php
    $tasks = DB::table('project_tasks')->get();
@endphp

<div id="chart_div"></div>

@push('js')
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['gantt']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('string', 'Resource');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            data.addRows([
                @foreach ($tasks as $task)
                    [
                        'Task{{ $task->id }}',
                        '{{ $task->title }}',
                        null,
                        new Date({{ date('Y', $task->start_date) }},
                            {{ date('m', $task->start_date) - 1 }},
                            {{ date('d', $task->start_date) }}),
                        new Date({{ date('Y', $task->end_date) }},
                            {{ date('m', $task->end_date) - 1 }},
                            {{ date('d', $task->end_date) }}),
                        null,
                        0,
                        null
                    ]
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            ]);

            var options = {
                height: 500, // Increase height for better visibility
                gantt: {
                    trackHeight: 40, // Increase track height for better readability
                    barHeight: 30, // Adjust bar height
                    criticalPathEnabled: true, // Highlight the critical path
                    criticalPathStyle: {
                        stroke: '#e64a19', // Color of the critical path
                        strokeWidth: 5 // Thickness of the critical path
                    },
                    arrow: {
                        angle: 100, // Angle of dependency arrows
                        width: 2,
                        color: '#b3b3b3', // Color of dependency arrows
                        radius: 0
                    },
                    labelStyle: {
                        fontName: 'Arial',
                        fontSize: 12,
                        color: '#757575'
                    }
                },
                backgroundColor: '#f9f9f9', // Light background color
                hAxis: {
                    textStyle: {
                        color: '#333', // Darker axis text for better contrast
                        fontName: 'Arial',
                        fontSize: 12
                    }
                },
                vAxis: {
                    textStyle: {
                        color: '#333',
                        fontName: 'Arial',
                        fontSize: 12
                    }
                }
            };

            var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
@endpush
