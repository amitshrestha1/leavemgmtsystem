<div>
    <x-slot name='title'>Calendar</x-slot>
    <style>
        #calendar-container {
            width: 100%;
        }

        #calendar {
            padding: 10px;
            margin: 10px;
            /* width: 1340px;
            height: 610px; */
            border: 2px solid black;
        }
    </style>

    <div>
        <h2 class="text-info">Calendar</h2>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:navigated', function() {
            var holidayevents = {!! json_encode($holidayevent) !!};
            var leaveevents = {!! json_encode($leaveevent) !!};
            var users = {!! json_encode($users) !!};
            console.log(users);
            if (users[0].role.name == 'Admin' || users[0].role.name == 'SuperAdmin') {

                var event1 = leaveevents.map(function(leaveevents) {

                    var color;
                    var tcolor;
                    if (leaveevents.status == "Approved") {
                        color = 'green';
                        tcolor = 'white';
                    } else if (leaveevents.status == "Rejected") {
                        color = 'red';
                        tcolor = 'white';
                    } else {
                        color = 'yellow';
                        tcolor = 'black';

                    }
                    return {
                        title: leaveevents.user.name + ' - ' + leaveevents.types.name + ' - ' + leaveevents
                            .reason + '-' + leaveevents.status, // Event title
                        start: leaveevents.from,
                        end: leaveevents.to + 'T23:59:59',
                        color: color,
                        textColor: tcolor,
                    };

                });
            } else {
                var event1 = leaveevents
                    .filter(function(leaveevents) {
                        // Display leave events for the current user only
                        return leaveevents.user_id === users[0].id;
                    })
                    .map(function(leaveevents) {
                        var color;
                        var tcolor;
                        if (leaveevents.status == "Approved") {
                            color = 'green';
                            tcolor = 'white';
                        } else if (leaveevents.status == "Rejected") {
                            color = 'red';
                            tcolor = 'white';
                        } else {
                            color = 'yellow';
                            tcolor = 'black';
                        }

                        return {
                            title: leaveevents.user.name + ' - ' + leaveevents.types.leave_type + ' - ' +
                                leaveevents.reason + '-' + leaveevents.status,
                            start: leaveevents.from,
                            end: leaveevents.to + 'T23:59:59',
                            color: color,
                            textColor: tcolor,
                        };
                    });
            }
            var event2 = holidayevents.map(function(holidayevents) {
                var tcolor1;
                var color1;
                color1 = 'white';
                tcolor1 = 'white';
                return {
                    title: holidayevents
                        .name, // Event title leave.name + ' - ' + leave.leave_type + ' - ' + leave.reason + '-' + leave   .status+ '-' +
                    start: holidayevents.date,
                    display: 'background',
                    backgroundColor: 'red',
                    // color: color1,
                    textColor: 'black',
                };
            });

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                timeZone: 'local',
                allDaySlot: false,

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth'
                },
                initialDate: '<?= date('Y-m-d') ?>',
                navLinks: true,
                editable: false,
                displayEventTime: false,
                initialView: 'dayGridMonth',
                events: event1.concat(event2),
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                }
            });
            calendar.render();
        });
    </script>
@endpush
