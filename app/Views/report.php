<?=  view('templates/header'); ?>

<!--  Content -->

<div class="height-100 bg-light ">


    <div class="fh-breadcrumb">

        <div class="fh-column">
            <div class="full-height-scroll">
                <ul class="list-group elements-list">
                    <?php $c=1; foreach ($templates as $template){?>
                    <li class="list-group-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-<?=$c?>">
                            <small class="float-right text-muted"> </small>
                            <strong><?= $template['template_name']?></strong>
                            <div class="small m-t-xs">
                                <p class="m-b-none">
                                    <i class="fa fa-area-chart"></i> Q1 2022
                                </p>
                            </div>
                        </a>
                    </li>
                    <?php $c++;}?>
                </ul>

            </div>
        </div>

        <div class="full-height">
            <div class="full-height-scroll white-bg border-left">

                <div class="element-detail-box">

                    <div class="tab-content">

                        <?php 
                        $chartId =0; $c=1; 
                        foreach ($templates as $template){

                         ?>
                        <div id="tab-<?=$c?>" class="tab-pane <?=($c==1)? 'active' : ''?>">

                            <div class="float-right">
                                <div class="tooltip-demo">
                                    <button class="btn btn-white btn-xs" data-toggle="tooltip" data-placement="top"
                                        title="Goto template"><i class="fa fa-eye"></i> </button>
                                </div>
                            </div>
                            <div class="small text-muted">
                                <i class="fa fa-clock-o"></i> <?php echo date("l jS \of F Y h:i:s A");?>
                            </div>

                            <h1><?= $template['template_name']?>
                            </h1>
                            <!-- <small>Summary</small> -->
                            <?php foreach ($reportMC as $mcItem){?>
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h3><i><?= $mcItem['question']?></i></h3>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <canvas data-qid="<?=$mcItem['question_id']?>" class="donut"
                                                    id="cht-<?=$chartId?>" height="70"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>

                        <?php  $c++; $chartId++;
                        }?>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>



<!-- End of content - body opened/closed in header/footer -->


<?=  view('templates/footer'); ?>
<script src="<?=base_url()?>/assets/js/inspinia.js"></script>
<script src="<?= base_url()?>/assets/js/plugins/chartJs/Chart.min.js"></script>
<script>
    // Donut 

    // get all donut items

    /* beautify preserve:start */
    var data = <?php echo json_encode($reportMC); ?>
    /* beautify preserve:end */

    var doughnutOptions = {
        responsive: true
    };

    var donuts = document.getElementsByClassName('donut');
    for (let i = 0; i < donuts.length; i++) {

        let qid = parseInt(donuts[i].getAttribute('data-qid'));
        let dataObj = data.filter(item => parseInt(item.question_id) == qid)[0]

        let labels = dataObj.name.split(",")
        let donutData = dataObj.values.split(",")
        let colors = dataObj.colors.split(",")


        let config = {
            labels: labels,
            datasets: [{
                data: donutData,
                backgroundColor: colors
            }]
        };

        new Chart(donuts[i], {
            type: 'doughnut',
            data: config,
            options: doughnutOptions
        });
    }
</script>