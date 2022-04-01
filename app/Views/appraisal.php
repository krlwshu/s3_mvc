<?=  view('templates/header'); ?>

<link rel="stylesheet" href="<?= base_url()?>/assets/css/appraisal2.css">
<style>
    .content-area {
        padding: 5rem !important;
    }

    .ibox-content {
        height: 15rem;
    }
</style>

<div class="content-area">

    <?php
            $appStatus = ($appProcessStatus !="New") ? "disabled":"";
            if ($appStatus == "disabled"){?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h1>Appraisal Locked</h1>
        <p>
            Appraisal is currently locked, pending review with your line manager.
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


            <div class="col-lg-3">

                <div class="ibox">
                    <div class="ibox-title">
                        <h2><?= $c. ") ". $temp_question['question']; ?></h2>

                    </div>
                    <div id="Test" class="ibox-content">
                        <?php 
                    
                    // If question type is Multi-Choice,
                    //  and option group is set, render options (per card):                    
                    if($temp_question['question_type'] == 'MC' && $temp_question['option_group']){
                    foreach($option_groups as $opt){?>

                        <input <?= $appStatus ?> class="q-item" type="radio" id="grp-id=<?= $opt['opt_group_id'];?>"
                            <?= ($temp_question['resp_value'] == $opt['id']? "checked":'')?>
                            name="resp_id-<?= $temp_question['resp_id']; ?>" value="<?= $opt['id'];?>">
                        <label for="grp-id-<?= $opt['opt_group_id'];?>"><?= $opt['option'];?></label><br>

                        <?php } 
                    } 
                    // If free text type, then render text area
                    elseif($temp_question['question_type'] =='FT'){?>
                        <div class="media-body">
                            <textarea <?= $appStatus ?> name="resp_id-<?= $temp_question['resp_id']; ?>" rows=3
                                class="form-control q-item"
                                placeholder="Write comment..."><?= $temp_question['response'] ?></textarea>
                        </div>
                        <?php } 
                    // if sentiment rating - render stars
                    elseif($temp_question['question_type'] =='SR'){?>

                        <p class="clasificacion">

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


        // Manage button
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
    });
</script>