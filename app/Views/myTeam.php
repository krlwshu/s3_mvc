<?= view('templates/header'); ?>

<!--  Content -->


<link href='https://fonts.googleapis.com/css?family=Pontano Sans' rel='stylesheet'>
<link rel="stylesheet" href="<?= base_url();?>/assets/css/myTeam.css">



<div class="height-100 bg-light wrapper">
    <br>

    <h1>Welcome back, <?= $_SESSION['name'] ?>!</h1>
    <br><br><br>
    <h4>Project Manager Dashboard</h4>
    <hr>
    <br>
    <div class="row">
        <div class="col-lg-7">
            <div>
                <h2>Upcoming Appraisals</h2>
            </div>
            <div class="box1">
                <div class="component">
                    <table class="table table-hover custom">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Appraisal Due By</th>
                                <th scope="col">Status</th>
                                <th scope="col">Belt</th>
                                <th scope="col">Active Appraisals</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($engineers as $row) :
                                ?>
                            <tr>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['due_date']; ?></td>
                                <td><?= $row['status']; ?></td>
                                <td><?= $row['belt']; ?></td>
                                <td><?= $row['template_names']; ?></td>
                                <td class="action">
                                    <div class="dropdown app-dropdown">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                            id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Appraisal
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <?php foreach ($templates as $t) : ?>
                                            <li>
                                                <button data-bs-toggle="modal" data-bs-target="#confirmAssign"
                                                    data-bs-temp="<?= $t['template_name']; ?>"
                                                    data-bs-tid="<?= $t['id']; ?>" data-bs-uid="<?= $row['id']; ?>"
                                                    data-bs-uname="<?= $row['name']; ?>"
                                                    class="dropdown-item assign-template" type="button">
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

        <div class="col-lg-3">

            <h2>Team Performance</h2>
            <div class="box2">
                <div class="component">
                    <br>
                    <h5>Focus Areas </h5>
                    <hr>
                    <div class="row">
                        <div class="column">

                        </div>
                        <div class="column">
                            <!-- <img src="UI_c/chart1.jpg" alt="orange bubble" width="160" height="160">
                                    <img src="UI_c/chart2.jpg" alt="green bubble" width="110" height="110">
                                    <img style="margin-left:55px;" src="UI_c/chart3.jpeg" alt="blue bubble" width="170"
                                        height="175"> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row pt-lg-5">
            <div class="col-lg-10">

                <h2>Appraisal Requests</h2>
                <div class="box2">
                    <div class="component">
                        <table class="table table-hover custom">
                            <thead>
                                <tr>
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Meeting Status</th>
                                    <th scope="colspan-2">Actions</th>
                                </tr>
                            </thead>
                            <?php


                                if ($submissions) {
                                    foreach ($submissions as $item) {
                                        $id = $item["id"];
                                        $name = $item["name"];
                                        $duedate = $item["due_date"];

                                        echo '<tr> 
                                  <td>' . $id . '</td> 
                                  <td>' . $name . '</td> 
                                  <td>Response Received: Schedule Meeting</td> 
                                  <td><button><a href="addComments.php?user_id=' . $id . '">Add Comments</a></button></td>
                                  <td><button><a href="scheduleMeeting.php?user_id=' . $id . '&staffName=' . $name . '&date=' . $duedate . '">Schedule Meeting</a></button></td>
                                 </tr>';
                                    }
                                }
                                ?>
                        </table>


                    </div>

                </div>

            </div>

        </div>

    </div>


    <br><br><br><br><br><br><br>



    <!-- Modal -->
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
</div>

<script src="<?= base_url(); ?>/assets/js/myTeam.js"></script>


<!-- End of content - body opened/closed in header/footer -->


<!-- <?= view('templates/footer'); ?> -->