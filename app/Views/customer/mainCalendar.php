<style>
    .fc .fc-button-primary {
        background-color: #0bb783;
        border-color: #0bb783;
        color: #ffffff;
    }

    .tooltipEvent {
        min-width: 200px;
        max-width: 400px;
        min-height: 100px;
        background: #FFFFFF;
        position: absolute;
        z-index: 10001;
        padding: 10px;
        display: block;
        border: 2px solid #0bb783;
        border-radius: 4px !important;
        box-shadow: 4px 4px 0 rgba(0, 0, 0, .35);
    }

    .tooltipEvent .title {
        font-weight: 600;
    }

    .tooltipEvent span {
        display: block;
    }

    .tooltipEvent .tip-heading {
        font-weight: 600;
        border-bottom: 1px solid rgba(0, 0, 0, .25);
        padding-bottom: 8px;
        margin-bottom: 8px;
    }
</style>
<div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
    <div class="card-body">
        <h5 id="calendar-title"></h5>
        <div id="calendar"></div>
    </div>
</div>

<script>
    var events = <?php echo json_encode($events); ?>;
    $(document).ready(function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            titleFormat: {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            },
            initialView: initialView,
            initialDate: initialDate,
            hiddenDays: <?php echo json_encode($hiddenDays); ?>,
            navLinks: false,
            editable: false,
            droppable: false,
            selectable: true,
            nowIndicator: true,
            dayMaxEvents: true,
            events: events,
            dateClick: function(info) {
                let currentDate = new Date(moment().format("YYYY-MM-DD")).getTime();
                let selectedDate = new Date(info.dateStr).getTime();
                if (selectedDate >= currentDate) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Customer/createAppointment'); ?>",
                        data: {
                            'date': info.dateStr,
                        },
                        dataType: "html",
                        success: function(response) {
                            $('#main-modal').html(response);
                        },
                        error: function(error) {
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                        }
                    });
                } else {
                    showAlert('warning', 'Lo siento', 'Ya no se pueden reservar citas en la fecha seleccionada');
                }
            },
            eventClick: function(calEvent) { // When click event
                $('.tooltipEvent').remove();
                let currentDate = new Date(moment().format("YYYY-MM-DD")).getTime();
                let selectedDate = new Date(calEvent.event.start).getTime();
                if (selectedDate >= currentDate) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Customer/removeAppointment'); ?>",
                        data: {
                            'id': calEvent.event.id
                        },
                        dataType: "html",
                        success: function(response) {
                            $('#main-modal').html(response);
                        },
                        error: function(error) {
                            showAlert('warning', 'Lo siento', 'Ya no se puede cancelar esta cita');
                        }
                    });
                } else {
                    showAlert('warning', 'Lo siento', 'Ya no se puede cancelar esta cita');
                }
            },
            eventMouseEnter: function(calEvent) {
                let tooltip = `
                    <div class="tooltipEvent">
                        <span class="tip-heading">${calEvent.event.title}</span>
                        <span>Servicio: ${calEvent.event.extendedProps['service']}</span>
                        <span>Descripción: ${calEvent.event.extendedProps['description']}</span>
                    </div>`;

                $("body").append(tooltip).mouseover(function(e) {

                    $(this).css('z-index', 10000);
                    $('.tooltipEvent').fadeIn('500').fadeTo('10', 1.9);

                }).mousemove(function(e) {
                    $('.tooltipEvent').css('top', e.pageY + 10).css('left', e.pageX + 20);
                })
            },
            eventMouseLeave: function() {
                $('.tooltipEvent').remove();
            },
        });

        calendar.render();

        $('.fc-prev-button').off().on('click', function() { // CALENDAR PREV BTN
            let date = moment(calendar.currentData.currentDate).format("YYYY-MM-DD"); 
            initialDate = date;
            getCalendar(initialDate);
            setCalTitle();
        });

        $('.fc-next-button').off().on('click', function() { // CALENDAR NEXT BTN
            let date = moment(calendar.currentData.currentDate).format("YYYY-MM-DD"); // GET CURRENT INITIAL DATE
            initialDate = date;
            getCalendar(initialDate);
            setCalTitle();
        });

        $('.fc-today-button').off().on('click', function() { // CALENDAR NEXT BTN
            let date = moment().format("YYYY-MM-DD"); 
            initialDate = date;
            getCalendar(initialDate);
            setCalTitle();
        });

        $('.fc-button').on('click', function() {
            let title = $(this).attr('title');
            if (title == 'Vista del mes')
                initialView = 'dayGridMonth';
            else if (title == 'Vista del agenda')
                initialView = 'listWeek';
            else
                initialView = initialView;

            setCalTitle();
        });
        setCalTitle();
        function setCalTitle() {
            let calTitle = $('.fc-toolbar-title').html();
            $('.fc-toolbar-title').html('');
            $('#calendar-title').html(calTitle);
        }
    });
</script>