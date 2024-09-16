<?php
//index.php
?>
<!DOCTYPE html>
<html>

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.4.0/index.global.min.js'></script>
    <script src="{{ asset('assets/fullcalendar-3.4.0/locale/pt-br.js') }}"></script>
</head>

<<<<<<< Updated upstream <body>
    =======

    <head>
        <x-header-layout />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <!--
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.4.0/index.global.min.js'></script>
        <script src="{{ asset('assets/fullcalendar-3.4.0/locale/pt-br.js') }}"></script>

        <style>
            .fc button {
                background-color: #3A57E8;
                /* Define a cor de fundo azul */
                color: white !important;
                /* Define a cor do texto */
                border: none;
                /* Remove as bordas */
                background-image: none !important;
                transition: none !important;
                /* Remove qualquer animação */
            }

            .fc button:hover {
                //background-color: #0056b3 !important; /* Cor mais escura ao passar o mouse */
                background-image: none !important;
                /* Remove qualquer efeito de background-image */
                transition: none !important;
                /* Remove qualquer animação de transição */
                transform: translateY(1px);

            }

            .fc-state-active {
                background-color: #0048B2 !important;
                /* Azul mais escuro para botão ativo */
                color: white !important;
            }

            .fc-unthemed td.fc-today {
                background: #9AA6E3;
            }

            .fc-highlight {
                /* when user is selecting cells */
                background: #8A92A6;
                opacity: .3;
            }

            #calendar {
                z-index: 1;
                /* Certifique-se de que o z-index da sidebar seja maior */
                position: relative;
                /* Define a posição para que o z-index funcione */
            }
        </style>
    </head>

    <body>
        >>>>>>> Stashed changes
        <div class="content-container">
            <main class="main-cntt">
                <div class="content-box">
                    <h2>Calendário</h2>
                    <br />
                    <div class="container">
                        <div id="calendar"></div>
                    </div>
                </div>
            </main>
        </div>
        <x-item-layout />


    </body>

</html>

<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            // editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: '/calendar/get',
            selectable: true,
            selectHelper: true,
            editable: false,
            locale: 'pt-br',
            height: 600,
            // select: function(start, end, allDay) {
            //     console.log('teste');
            //     var title = prompt("Enter Event Title");
            //     if (title) {
            //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            //         $.ajax({
            //             url: "insert.php",
            //             type: "POST",
            //             data: {
            //                 title: title,
            //                 start: start,
            //                 end: end
            //             },
            //             success: function() {
            //                 calendar.fullCalendar('refetchEvents');
            //                 alert("Added Successfully");
            //             }
            //         })
            //     }
            // },
            // eventResize: function(event) {
            //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            //     var title = event.title;
            //     var id = event.id;
            //     $.ajax({
            //         url: "update.php",
            //         type: "POST",
            //         data: {
            //             title: title,
            //             start: start,
            //             end: end,
            //             id: id
            //         },
            //         success: function() {
            //             calendar.fullCalendar('refetchEvents');
            //             alert('Event Update');
            //         }
            //     })
            // },

            // eventDrop: function(event) {
            //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            //     var title = event.title;
            //     var id = event.id;
            //     $.ajax({
            //         url: "update.php",
            //         type: "POST",
            //         data: {
            //             title: title,
            //             start: start,
            //             end: end,
            //             id: id
            //         },
            //         success: function() {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Event Updated");
            //         }
            //     });
            // },

            // eventClick: function(event) {
            //     if (confirm("Are you sure you want to remove it?")) {
            //         var id = event.id;
            //         $.ajax({
            //             url: "delete.php",
            //             type: "POST",
            //             data: {
            //                 id: id
            //             },
            //             success: function() {
            //                 calendar.fullCalendar('refetchEvents');
            //                 alert("Event Removed");
            //             }
            //         })
            //     }
            // },

        });
    });
</script>
