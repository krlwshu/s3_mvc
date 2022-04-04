<?= view('templates/header'); ?>

<!--  Content -->


<link href='https://fonts.googleapis.com/css?family=Pontano Sans' rel='stylesheet'>
<link rel="stylesheet" href="<?= base_url();?>/assets/css/myTeam.css">
<link href="<?= base_url() ?>/assets/css/plugins/chartist/chartist.min.css" rel="stylesheet">

<style>
    .white-text {
        color: white;
    }

    .table>:not(:first-child) {
        border-top: none;
    }

    .belt {
        max-height: 1.2rem;
    }

    .table-hover tbody tr:hover {
        background-color: #34e8ff45;
    }

    .modal-dialog {
        top: 20%;
    }
</style>


<div class="height-100 bg-light wrapper">
    <h1>Welcome back, <?= $_SESSION['name'] ?>!</h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget style1 navy-bg">
                        <div class="row vertical-align">
                            <div class="col-3">
                                <i class="fa fa-calendar fa-3x"></i>
                            </div>
                            <div class="col-9">
                                <h2 class="font-bold white-text"><?= $review_count?> <small>reviews scheduled this
                                        week</small></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="widget style1 bg-warning">
                        <div class="row vertical-align">
                            <div class="col-3">
                                <i class="fa fa-bell fa-3x"></i>
                            </div>
                            <div class="col-9">
                                <h2 class="font-bold white-text"><?= $actionCount?> <small>outstanding actions</small>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <h1>My Team's Appraisals</h1>
                                <div class="col-lg-12">
                                    <table class="table table-hover custom borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col">Due</th>
                                                <th scope="col">Assign Appraisal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                foreach ($engineers as $row) :
                                ?>
                                            <tr>
                                                <td class="client-avatar"><a href=""><img alt="image"
                                                            src="<?= base_url() . $row['avatar']?>"></a>
                                                <td><a href="#contact-2" class="client-link"><?= $row['name']; ?></a>
                                                </td>
                                                <td><img class="belt" alt="image"
                                                        src="<?= base_url()?>/assets/img/belts/belt-<?= strtolower(trim($row['belt']))?>.svg">
                                                    </a></td>
                                                <td><?= ($row['last_app'] == Null) ? "<b>Now</b>" : "In " . (intval($row['app_cycle']) - intval($row['last_app'])) . " days"?>
                                                </td>


                                                <td class="action">
                                                    <div class="dropdown app-dropdown">
                                                        <button class="btn btn-outline-primary dropdown-toggle btn-xs"
                                                            type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Select Appraisal
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            <?php foreach ($templates as $t) : ?>
                                                            <li>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#confirmAssign"
                                                                    data-bs-temp="<?= $t['template_name']; ?>"
                                                                    data-bs-tid="<?= $t['id']; ?>"
                                                                    data-bs-uid="<?= $row['id']; ?>"
                                                                    data-bs-uname="<?= $row['name']; ?>"
                                                                    class="dropdown-item assign-template "
                                                                    type="button">
                                                                    <?= $t['template_name']; ?>
                                                                </button>
                                                            </li>
                                                            <?php
                                                    endforeach;
                                                    ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php
                                endforeach;
                                ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox-content">
                        <h2>Actions</h2>
                        <small>You have open <?= $actionCount?> actions</small>
                        <ul id="tasklist" class="todo-list m-t small-list">
                            <?php foreach($actions as $aItem){?>
                            <li>
                                <input data-action-id="<?=$aItem['action_id']?>" id="action-<?=$aItem['action_id']?>"
                                    type="checkbox" onchange="handleActionChange(event)" value="" name=""
                                    class="i-checks" />
                                <span class="m-l-xs"><?= $aItem['action']?></span>


                            </li>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Appraisals Issued</h2>
                        </div>
                        <div class="ibox-content">

                            <div class="ibox-content">
                                <ul id="app-iss-li" class="sortable-list connectList agile-list ui-sortable"
                                    id="completed">
                                    <?php  foreach ($pendingReview as $item) {
                                if($item['status'] =='New'){
                                ?>
                                    <li class="info-element">
                                        <div class="agile-detail">
                                            <p><i
                                                    class="pl-2 mr-2 text-success fa fa-th-list"></i><b><?= $item['name']?></b>
                                                assigned
                                                <b><?= $item['template_name']?></b></p>
                                            <a href="#" class="float-right btn btn-xs btn-white"><i
                                                    class="text-success fa fa-bell"></i></a>

                                            <p class="pl-3"> <?= $item['last_updated']?></p>
                                        </div>
                                    </li>
                                    <?php }}?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Ready for Review</h2>
                        </div>
                        <div class="ibox-content">

                            <div class="ibox-content">
                                <ul class="sortable-list connectList agile-list ui-sortable" id="completed">
                                    <?php  foreach ($pendingReview as $item) {
                                if($item['status'] =='Review'){
                                ?>
                                    <li class="info-element">
                                        <div class="agile-detail">
                                            <p><i
                                                    class="pl-2 mr-2 text-success fa fa-calendar fa-2x"></i><b><?= $item['name']?></b>
                                                submitted
                                                <b><?= $item['template_name']?></b></p>

                                            <button class="float-right btn btn-xs btn-white" data-bs-toggle="modal"
                                                data-app-id=<?=$item['app_id']?> data-bs-target="#meetingModal">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>Review

                                            </button>
                                            <a href="<?= base_url()?>/Appraisal/template/<?=$item['app_id']?>"
                                                class="float-right btn btn-xs btn-white"><i class="fa fa-search"
                                                    aria-hidden="true"></i> Review</a>

                                            <p class="pl-3"> <?= $item['last_updated']?></p>
                                        </div>
                                    </li>
                                    <?php }}?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h1>Appraisal Summary</h1>
                </div>
                <div class="ibox-content">
                    <canvas id="doughnutChart" height="140"></canvas>
                </div>
            </div>
            <div class="ibox ">
                <div class="ibox-title">
                    <h1>Sentiment Analysis <small> Positive / Negative Datasets</small></h1>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="barChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>




    <!-- Assign Modal -->
    <div id="confirmAssign" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Assign template <b> <span id="modal-temp-name"></span></b> to <b><span id="modal-user"></span>?</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btn-confirm-assign" type="button" data-bs-dismiss="modal"
                        onclick="handleAssignTemplate(event)" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule review -->
    <div id="meetingModal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="staticBackdropLabel"><i class="fa fa-calendar" aria-hidden="true"></i>
                        Schedule Review Meeting</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="pt-2 px-3 form-group row">
                    <label class="col-lg-2 col-form-label">Date</label>
                    <div class="col-lg-10">
                        <input id="meeting-date" type="date" placeholder="Email" class="form-control">
                    </div>
                </div>
                <div class="px-3 form-group row">
                    <label class="col-lg-2 col-form-label">Time</label>
                    <div class="col-lg-10">
                        <select id="meeting-time" class="form-select" aria-label="Default select example">
                            <option selected>Select time...</option>
                            <?php
                                for($hh = 7; $hh <=18; $hh++){
                                    echo "<option>$hh:00</option>";
                                    echo "<option>$hh:30</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <span></span>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btn-confirm-sch" type="button" data-bs-dismiss="modal"
                        onclick="handleScheduleReview(event)" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url(); ?>/assets/js/myTeam.js"></script>


    <!-- End of content - body opened/closed in header/footer -->


    <!-- <?= view('templates/footer'); ?> -->
    <script src="<?= base_url()?>/assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url()?>/assets/js/plugins/chartJs/Chart.min.js"></script>

    <script>
        var barData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                    label: "Negative",
                    backgroundColor: 'rgba(220, 220, 220, 0.5)',
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "Positive",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };
        var barOptions = {
            responsive: true
        };
        var ctx2 = document.getElementById("barChart").getContext("2d");
        new Chart(ctx2, {
            type: 'bar',
            data: barData,
            options: barOptions
        });

        var polarData = {
            datasets: [{
                data: [
                    300, 140, 200
                ],
                backgroundColor: [
                    "#a3e1d4", "#dedede", "#b5b8cf"
                ],
                label: [
                    "My Radar chart"
                ]
            }],
            labels: [
                "App", "Software", "Laptop"
            ]
        };

        var polarOptions = {
            segmentStrokeWidth: 2,
            responsive: true

        };

        // Donut 

        var doughnutData = {
            labels: ["Assigned", "Pending Review", "Completed"],
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: ["#03a9f4", "#ffc107", "#00ff29"]
            }]
        };

        var doughnutOptions = {
            responsive: true
        };


        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {
            type: 'doughnut',
            data: doughnutData,
            options: doughnutOptions
        });


        // Action changing


        const handleActionChange = (event) => {

            let actionInput = document.getElementById(event.target.id)

            if (actionInput.checked) {
                actionInput.nextElementSibling.classList.toggle('todo-completed')

                let action_id = actionInput.getAttribute('data-action-id')

                console.log(action_id)
                var url = "/Appraisal/completeAction";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action_id
                    },
                    success: function (data) {
                        let item = document.getElementById(`action-${data.action_id}`);
                        document.getElementById("tasklist").removeChild(item.parentElement);
                    }
                });

            }


        }
    </script>