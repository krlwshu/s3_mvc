<?=  view('templates/header'); ?>


<style>
    .content-area {
        padding-top: 2rem !important;
    }

    .progress-bar-complete {
        background-color: #4def2a;
    }
</style>

<div class="content-area animate__animated animate__fadeIn">
    <h1>Welcome back, <?= $_SESSION['name']?>.</h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3>Important Information</h3>
                <ul>
                    <li>Make sure to check your personal inbox for any important information</li>
                    <li>Mentor opportunities are now available email your team leaders for more information</li>
                    <li>Schedule your appraisal evaluation as soon as possible as availability may vary</li>
                    <li>Read our privacy policy here <a href="" data-toggle="modal" data-target="#myModal"><i
                                class="fa fa-info-circle" aria-hidden="true"></i>here</a>
                    </li>

                </ul>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="widget style1 bg-primary">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-calendar fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Upcoming Reviews </span>
                                <h2 class="font-bold">1</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-envelope-o fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Unread Messages </span>
                                <h2 class="font-bold">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-trophy fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Thank You Cards! </span>
                                <h2 class="font-bold">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="ibox-content mt-1 ">
                <h2>Active Appraisals</h2>
                <div>
                    <hr class="hr-line-solid">
                    <?php 
                    $c = 0; // Counter for compelte appraisals
                    foreach($engAppraisals as $item) {
                    
                        $qCount = $item['question_count'];
                        $cCount = $item['completed_count'];
                        $percComplete = ($qCount > 0) ? 100 / $qCount * $cCount : 0;

                        if ($item['status'] == "New" ) {
                    ?>
                    <div class="my-2">
                        <span class="font-size:1.4rem"><a class="mr-1"
                                href="<?= base_url()?>/appraisal/template/<?= $item['id']?>">
                                <?= $item['template_name']?></a><?= $item['date_created']?></span>
                        <small class="float-right"><?= "$cCount / $qCount answered"?></small>
                    </div>
                    <div class="progress progress-small">
                        <div style="width: <?=$percComplete;?>%;" class="progress-bar"></div>
                    </div>

                    <?php } else {$c +=1;}}?>
                </div>
            </div>
            <div <?= (!$c) ? "hidden" : ""?> class="ibox-content mt-1 ">
                <h2>Pending Appraisal Review </h2>
                <div>
                    <hr class="hr-line-solid">

                    <?php foreach($engAppraisals as $item) {
                        $qCount = $item['question_count'];
                        $cCount = $item['completed_count'];
                        $percComplete = ($qCount > 0) ? 100 / $qCount * $cCount : 0;

                        if ($item['status'] == "Review" ) {
                    ?>
                    <div>
                        <span class="font-size:1.4rem"><a class="mr-1"
                                href="<?= base_url()?>/appraisal/template/<?= $item['id']?>">
                                <?= $item['template_name']?></a><?= $item['date_created']?></span>
                        <small class="float-right"><?= "$cCount / $qCount answered"?></small>
                    </div>
                    <div class="progress progress-small">
                        <div style="width: <?=$percComplete;?>%;" class="progress-bar-complete"></div>
                    </div>

                    <?php }}?>
                </div>
            </div>
            <div <?= (!$c) ? "hidden" : ""?> class="ibox-content mt-1 ">
                <h2>Historic Appraisals </h2>
                <div>
                    <hr class="hr-line-solid">
                    <?php foreach($engAppraisals as $item) {
                    
                        $qCount = $item['question_count'];
                        $cCount = $item['completed_count'];
                        $percComplete = ($qCount > 0) ? 100 / $qCount * $cCount : 0;

                        if ($item['status'] == "Complete" ) {
                    ?>
                    <div>
                        <span><?= "<b>" . $item['template_name'] . "</b> - due date: ". $item['date_created']?></span>
                        <small class="float-right"><?= "$cCount / $qCount answered"?></small>
                    </div>
                    <div class="progress progress-small">
                        <div style="width: <?=$percComplete;?>%;" class="progress-bar "></div>
                    </div>

                    <?php }}?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>My Calendar</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>



</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"><i class="fa fa-info"></i> Privacy Notice</h4>
                <small class="font-bold">Important information about how your data is used</small>
            </div>
            <div class="modal-body">
                <strong>Actemium Privacy Policy: 31/03/2022</strong>

                <p> How we get the personal information and why we have it
                    Most of the personal information we process is provided to us directly by you for one of the
                    following reasons:
                    • To facilitate discussion about your experience at Actemium and identify development opportunities.
                    We use the information that you have given us in order to
                    Under the General Data Protection Regulation (GDPR), the lawful bases we rely on for processing this
                    information is a) Legitimate Interest b) Your consent. You are able to remove your consent at any
                    time. You can do this by contacting: martin.hammond@actemium.co.uk
                    How we store your personal information
                    Your information is securely stored.
                    We keep this information for the duration of your employment with Actemium. We will then dispose
                    your information by removing your appraisal records from our databases. Any data used for analysis
                    will be anonymised to protect your privacy rights.</p>
                <p>
                    <br>
                    <strong>Your data protection rights</strong>
                    Under data protection law, you have rights including:
                    Your right of access - You have the right to ask us for copies of your personal information.
                    Your right to rectification - You have the right to ask us to rectify personal information you think
                    is inaccurate. You also have the right to ask us to complete information you think is incomplete.
                    Your right to erasure - You have the right to ask us to erase your personal information in certain
                    circumstances.

                </p>
                <br>
                <p> <b>Your right to restriction of processing</b> - You have the right to ask us to restrict the
                    processing of
                    your personal information in certain circumstances.
                    Your right to object to processing - You have the the right to object to the processing of your
                    personal information in certain circumstances.
                    Your right to data portability - You have the right to ask that we transfer the personal information
                    you gave us to another organisation, or to you, in certain circumstances.
                    You are not required to pay any charge for exercising your rights. If you make a request, we have
                    one month to respond to you.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?=  view('templates/footer'); ?>

<!-- Full Calendar -->
<script src="<?= base_url();?>/assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>

<script>
    $(document).ready(function () {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        /* initialize the external events
         -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function () {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
                // {
                //     title: 'All Day Event',
                //     start: new Date(y, m, 1)
                // },
                {
                    title: 'Appraisal Review',
                    start: new Date(y, m, d + 1),
                    end: new Date(y, m, d + 1)
                },
                // {
                //     id: 999,
                //     title: 'Repeating Event',
                //     start: new Date(y, m, d - 3, 16, 0),
                //     allDay: false
                // },
                // {
                //     id: 999,
                //     title: 'Repeating Event',
                //     start: new Date(y, m, d + 4, 16, 0),
                //     allDay: false
                // },
                // {
                //     title: 'Meeting',
                //     start: new Date(y, m, d, 10, 30),
                //     allDay: false
                // },
                // {
                //     title: 'Lunch',
                //     start: new Date(y, m, d, 12, 0),
                //     end: new Date(y, m, d, 14, 0),
                //     allDay: false
                // },
                // {
                //     title: 'Birthday Party',
                //     start: new Date(y, m, d + 1, 19, 0),
                //     end: new Date(y, m, d + 1, 22, 30),
                //     allDay: false
                // },
                // {
                //     title: 'Click for Google',
                //     start: new Date(y, m, 28),
                //     end: new Date(y, m, 29),
                //     url: 'http://google.com/'
                // }
            ]
        });


    });
</script>