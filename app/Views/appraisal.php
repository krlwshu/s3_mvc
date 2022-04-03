<?=  view('templates/header'); ?>

<link rel="stylesheet" href="<?= base_url()?>/assets/css/appraisal2.css">
<style>
    .content-area {
        padding: 5rem !important;
    }

    /* .ibox-content {
        height: 15rem;
    } */

    hr.hr-line-solid {
        background-color: #23b33470;
    }

    .modal-dialog {
        top: 20%;
    }
</style>

<div class="content-area">

    <?php
            $appStatus = ($appProcessStatus !="New") ? "disabled":"";
            if ($_SESSION['role'] != "pm" && $appStatus == "disabled"){?>
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h1>Appraisal Locked</h1>
        <p>
            Appraisal is locked, pending review with your line manager.
        </p>
    </div>
    <br><br>
    <?php } ?>

    <?php
    $templateName = (count($appraisalData)) ? $appraisalData[0]["template_name"] : '';
    ?>
    <div class="overlay"></div>
    <!-- set percent on load, then use JS to update -->
    <h1> Appraisal: <b><?= $templateName ?></b> - <span id="title-percent"><?=intval($percent)?>%</span> </h1>
    <div class="progress progress-small">
        <div id="prog" style="width: <?=$percent?>%;" class="progress-bar"></div>
    </div>


    <br><br>

    <input id="appId" hidden type="text" name="tid" value="<?= $appId?>" />
    <input id="percent_load" hidden type="text" name="tid" value="<?= $percent?>" />

    <form id="appraisal" action="" method="post">
        <div class="row">

            <?php 
        
        $c = 1; // question counter
        foreach($appraisalData as $temp_question):
        ?>


            <div class="col-lg-12">

                <div class="ibox">
                    <div class="ibox-title">
                        <h2><?= $c. ") ". $temp_question['question']; ?></h2>

                    </div>
                    <div id="Test" class="ibox-content">
                        <?php 
                    
                    // If question type is Multi-Choice,
                    //  and option group is set, render options (per card):                    
                    if($temp_question['question_type'] == 'MC' && $temp_question['option_group']){
                    foreach($option_groups as $opt){
                        if($temp_question['option_group'] == $opt['opt_group_id']){
                        ?>


                        <label class="pl-1 radio-inline" for="grp-id-<?= $opt['opt_group_id'];?>"><input
                                <?= $appStatus ?> class="q-item mr-2" type="radio"
                                id="grp-id=<?= $opt['opt_group_id'];?>"
                                <?= ($temp_question['resp_value'] == $opt['id']? "checked":'')?>
                                name="resp_id-<?= $temp_question['resp_id']; ?>"
                                value="<?= $opt['option'];?>"><?= $opt['option'];?></label>

                        <?php } }
                    } 
                    // If free text type, then render text area
                    elseif($temp_question['question_type'] =='FT'){?>
                        <div class="media-body">
                            <textarea <?= $appStatus ?> name="
                                resp_id-<?= $temp_question['resp_id']; ?>" rows=3 class="form-control q-item"
                                placeholder="Submit response here..."><?= $temp_question['response'] ?></textarea>
                        </div>
                        <?php } 
                    // if sentiment rating - render stars
                    elseif($temp_question['question_type'] =='SR'){?>

                        <p class="clasification">

                            <?php 
                        
                        for ($i=10; $i>=1; $i--){?>
                            <input <?= $appStatus ?> <?= ($temp_question['resp_value'] == $i? "checked":'')?>
                                class="star-opt q-item" id="star-<?= $i?>" type="radio"
                                name="resp_id-<?= $temp_question['resp_id']; ?>" value="<?= $i?>">
                            <label class="star-opt" for="star-<?= $i?>">&#9733;</label>

                            <?php
                        }

                        ?>
                        </p>
                        <?php } ?>

                        <?php 
                        if($appProcessStatus !="New"){?>
                        <div class="social-body">
                            <hr class="hr-line-solid">
                            <div class="btn-group">
                                <h3>Review Notes:</h3>
                            </div>
                            <?php if($_SESSION['role']=='pm'){?>
                            <button data-respId="<?= $temp_question['resp_id']?>"
                                class="create-act-btn btn btn-white btn-xs float-md-right" data-bs-toggle="modal"
                                data-bs-target="#actionModal" aria-hidden="true">
                                <i class="fa fa-plus"></i>
                                Create Action
                            </button>
                            <?php }?>
                        </div>
                        <div class="social-footer">
                            <div id="com-container-<?=$temp_question['resp_id']?>">
                                <?php 
                                if($appProcessStatus != 'New'){
                                    foreach ($reviewComments as $reviewItem){
                                        if($temp_question['resp_id'] == $reviewItem['ad_id']){
                                ?>
                                <div class="social-comment">
                                    <a href="" class="float-left">
                                        <img alt="image" src="<?= base_url(). $reviewItem['avatar']?>">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            <?= $reviewItem['name']?>
                                        </a>
                                        <?= $reviewItem['comment']?>
                                        <br>
                                        <small class="text-success"><?= $reviewItem['comment_date']?></small>
                                    </div>
                                </div>
                                <?php  }}}?>
                            </div>

                            <div class="social-comment">
                                <a href="" class="float-left">
                                    <img alt="image" src="<?= $_SESSION['avatar']?>">
                                </a>
                                <div class="media-body">
                                    <textarea data-resp-id=<?= $temp_question['resp_id']?>
                                        onkeypress="handleAddComment(event)" class="form-control"
                                        placeholder="Write comment..."></textarea>
                                </div>
                            </div>

                        </div>
                        <?php }?>
                    </div>

                </div>
            </div>

            <?php 
        $c+=1;
        endforeach; ?>


        </div>
        <button id="complete-app" type="submit" class="btn btn-primary">Finish Appraisal</button>
    </form>
    <br>
    <a href="javascript:history.back()"> Go Back</a>


    <div id="soc-comment-template" hidden class="social-comment">
        <a href="" class="float-left">
            <img alt="image" src="">
        </a>
        <div class="media-body">
            <a href="#">

            </a>

            <br>
            <small class="text-success"></small>
        </div>
    </div>
    <!-- Action modal -->
    <div id="actionModal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="staticBackdropLabel"><i class="fa fa-plus" aria-hidden="true"></i>
                        Add Follow-up Action</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="pt-2 px-3 form-group row">
                    <label class="col-lg-2 col-form-label">Action</label>
                    <div class="col-lg-10">
                        <textarea id="action-summary" placeholder="Enter the action description"
                            class="form-control"></textarea>
                    </div>
                </div>
                <div class="pt-2 px-3 form-group row">
                    <label class="col-lg-2 col-form-label">Category</label>
                    <div class="col-lg-10">
                        <input id="action-category" placeholder="Enter the action description"
                            class="form-control"></input>
                    </div>
                </div>
                <div class="pt-2 px-3 form-group row">
                    <label class="col-lg-2 col-form-label">Target Date</label>
                    <div class="col-lg-10">
                        <input id="action-date" type="date" placeholder="Date" class="form-control">
                    </div>
                </div>

                <span></span>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="actionSubmit" type="button" data-bs-dismiss="modal" onclick="handleSubmitAction(event)"
                        class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>




<?=  view('templates/footer'); ?>
<script>
    $(document).ready(function () {
        $("#appraisal").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var appId = document.getElementById('appId').value;
            var url = '/Appraisal/completeAppraisal'

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    appId: appId
                },
                success: function (data) {
                    success(data)
                }
            });
        });

        const submitData = (data) => {

            var appId = document.getElementById('appId').value;
            var url = '/Appraisal/submitAppraisal'
            console.log(data)
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    data,
                    appId: appId
                }, // serializes the form's elements.
                success: function (data) {
                    success(data)
                    progUpdate(parseInt(data.percent))
                }
            });
        }

        const progUpdate = (value) => {
            var prog = document.getElementById('prog');
            var titleProg = document.getElementById('title-percent');

            prog.style.width = value + '%';
            titleProg.innerHTML = value + '%';

            compAppBtnStatus(value);
        }


        // Manage button for completing submission
        const compAppBtnStatus = (value) => {
            btnComplete = document.getElementById('complete-app');
            if (value === 100) {
                btnComplete.disabled = false;
            } else {
                btnComplete.disabled = true;
            }
        }
        // run on load, rest triggered on event
        let loadStatusPercent = document.getElementById('percent_load').value;
        compAppBtnStatus(loadStatusPercent);

        // Bind event handler for autosave
        // Set state - submit
        var formItems = document.getElementsByClassName('q-item');

        for (let i = 0; i < formItems.length; i++) {
            // Add event listener
            formItems[i].addEventListener("change", function () {
                submitData($(this).serializeArray())
            })
        }


        const success = (res) => {
            // console.log(res)
            var notyf = new Notyf();
            if (res.success) {
                notyf.success(res.message);
            } else {
                notyf.error(res.message);
            }
        }

        const failure = (error) => {
            console.log("Error occurred, request not processed")
            console.log(error)
        }

        // Set create-act-btn event, prevent form re-submission

        const createActionModal = (event) => {
            event.preventDefault();
            var id = event.target.getAttribute("data-respId");
            var actionModal = document.getElementById("actionModal")
            actionModal.setAttribute("data-resp-Id", id)
        }

        // Bind function to all Create Action buttons
        var actionButtons = document.getElementsByClassName('create-act-btn');
        for (let i = 0; i < actionButtons.length; i++) {
            actionButtons[i].addEventListener("click", createActionModal)
        }


        // Submit button event
        handleSubmitAction = (e) => {

            var respIdAct = document.getElementById('actionModal').getAttribute('data-resp-Id')
            var targDate = document.getElementById('action-date').value
            var actionSum = document.getElementById('action-summary').value
            var category = document.getElementById('action-category').value

            let data = {
                respIdAct,
                targDate,
                actionSum,
                category
            }

            $.ajax({
                type: "POST",
                url: '/Appraisal/createAction',
                data: {
                    data
                }, // serializes the form's elements.
                success: function (data) {
                    success(data)
                }
            });
        }



        const updateComment = (data) => {

            if (data.success) {
                let comCont = document.getElementById(`com-container-${data.respId}`)

                let comment = `<div class="social-comment animate__animated animate__fadeInLeft">
                    <a href="" class="float-left">
                    <img alt="image" src="${data.avatar_url}"></a>
                    <div class="media-body">
                        <a href="#">
                        ${data.name}</a>
                        ${data.comment}<br>
                        <small class="text-success">Just Now</small>
                    </div>
                </div>`

                const fragment = document.createRange().createContextualFragment(comment);
                comCont.append(fragment)
            }


        }

        // Handle Adding Comments
        handleAddComment = (event) => {
            if ((event.keyCode == 10 || event.keyCode == 13) && event.ctrlKey) {
                var comment = event.srcElement.value
                var respId = event.srcElement.getAttribute('data-resp-id')

                let data = {
                    comment,
                    respId
                }

                $.ajax({
                    type: "POST",
                    url: '/Appraisal/addReviewComment',
                    data: {
                        data
                    }, // serializes the form's elements.
                    success: function (data) {
                        updateComment(data)
                    }
                });

            }


        }


    });
</script>