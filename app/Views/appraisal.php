<?=  view('templates/header'); ?>

<link rel="stylesheet" href="<?= base_url()?>/assets/css/appraisal2.css">
<style>
    .content-area {
        padding: 5rem !important;
    }
</style>

<div class="content-area">

    <?php
    $templateName = (count($appraisalData)) ? $appraisalData[0]["template_name"] : '';
    ?>
    <h2> Appraisal: <b><?= $templateName ?></b> </h2>

    <br><br>

    <div class="row">
        <?php 
        $c = 1; // question counter
        foreach($appraisalData as $temp_question):
        ?>

        <div style="padding-bottom:5rem" class="col-lg-4">
            <div class="card1">
                <h5 class="card-header">Question <?= $c;?></h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $temp_question['question']; ?></h5>
                    <!-- <p class="card-text">Please enter reponse: </p> -->
                    <?php 
                    
                    // If question type is Multi-Choice,
                    //  and option group is set, render options (per card):                    
                    if($temp_question['question_type'] == 'MC' && $temp_question['option_group']){
                    foreach($option_groups as $opt){?>

                    <input type="radio" id="grp-id=<?= $opt['opt_group_id'];?>"
                        name="opt-grp-<?= $opt['opt_group_id'];?>" value="<?= $opt['id'];?>">
                    <label for="grp-id-<?= $opt['opt_group_id'];?>"><?= $opt['option'];?></label><br>

                    <?php } 
                    } 
                    // If free text type, then render text area
                    elseif($temp_question['question_type'] =='FT'){?>
                    <textarea name="" id="" cols="30" rows="3"></textarea>
                    <?php } 
                    // if sentiment rating - render stars
                    elseif($temp_question['question_type'] =='SR'){?>

                    <p class="clasificacion">

                        <?php 
                        
                        for ($i=1; $i<=10; $i++){?>
                        <input class="star-opt" id="star-<?= $i?>" type="radio" name="estrellas" value="<?= $i?>">
                        <label class="star-opt" for="star-<?= $i?>">&#9734;</label>

                        <?php
                        }

                        ?>
                    </p>
                    <?php } ?>
                    <!-- <a href="#" class="btn btn-primary">Submit</a> -->
                </div>
            </div>

        </div>
        <?php 
        $c+=1;
        endforeach; ?>

    </div>
    <form>
        <a name="" id="" class="btn btn-primary" href="MyTeam.php" role="button">
            Submit all
        </a>
    </form>
</div>



<?=  view('templates/footer'); ?>