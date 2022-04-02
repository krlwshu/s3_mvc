<?=  view('templates/header'); ?>
<!--  Content -->

<style>
    * {
        box-sizing: border-box;
    }

    div.search-bar input[type="text"] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        background: #f1f1f1;
        width: 100%;
    }

    .search-bar button {
        float: left;
        padding: 10px;
        background: #2196f3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
    }

    .search-bar button:hover {
        background: #0b7dda;
    }

    .search-bar::after {
        content: "";
        clear: both;
        display: table;
    }

    .search-bar {
        display: inline-flex;
        width: 100%
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<div class="height-100 bg-light content-area">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <h1> Search</h1>
                    <div class="search-bar">
                        <input id="search-input" type="text" placeholder="Enter search term...">
                        <button type="submit"><i class="fa fa-search fa-1x" aria-hidden="true"></i></button>
                    </div>
                    <br><br>
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Appraisal Template</th>
                                <th>Question</th>
                                <th>Data</th>
                            </tr>
                        </thead>

                    </table>


                </div>
            </div>
        </div>
    </div>


</div>

<!-- End of content - body opened/closed in header/footer -->


<?=  view('templates/footer'); ?>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {


        // ajax for initial table creation:
        var requestUrl = "/Analysis/searchData";
        var requestData = {
            "searchTerm": ""
        };

        var table = $('#myTable').DataTable({
            ajax: {
                method: "GET",
                url: requestUrl,
                "data": function () {
                    return requestData;
                },
                dataSrc: "data",
            },
            columns: [{
                data: 'template_name'
            }, {
                data: 'question'
            }, {
                data: 'response'
            }],
            bFilter: false,
            bInfo: false

        });

        // Delay fetch
        let keyupTimer;
        $("#search-input").keypress(function (e) {
            clearTimeout(keyupTimer);
            keyupTimer = setTimeout(function () {
                requestData.searchTerm = e.target.value;
                var requestUrl = "/Analysis/searchData";
                table.ajax.url(requestUrl).load();
            }, 800);
        });
    });
</script>