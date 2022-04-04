

const addAppraisal = (data) => {

    if (data) {
        let appCont = document.getElementById(`app-iss-li`)

        let { name, date_created, template_name, id } = data;
        console.log(data)
        let comment = `<ul class="sortable-list connectList agile-list ui-sortable animate__animated animate__fadeInLeft" id="completed">
            <li class="info-element">
                <div class="agile-detail">
                <p><i class="pl-2 mr-2 text-success fa fa-th-list"></i><b>${name}</b>
                assigned
                <b>${template_name}</b></p>
                <a href="#" class="float-right btn btn-xs btn-white"><i class="text-success fa fa-bell"></i></a>

                <p class="pl-3"> ${date_created}</p>
                </div>
            </li>
        </ul>`

        const fragment = document.createRange().createContextualFragment(comment);
        appCont.prepend(fragment)
    }

}

// Assign Template to user
const handleAssignTemplate = (event) => {
    var element = document.getElementById(event.target.id);
    var tempId = element.getAttribute("data-bs-tid");
    var uid = element.getAttribute("data-bs-uid");

    console.log("fired")

    let data = {
        uid: uid,
        tempId: tempId
    }

    let target_url = `/Appraisal/AssignAppraisal`;


    // Pass data to assign tempalte function
    var url = target_url;
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(res => res.json())
        .then(res => {
            success(res)
            addAppraisal(res.temp_data)
        })
        .catch(error => failure(error));


}


const success = (res) => {
    // console.log(res)
    var notyf = new Notyf();
    if (res.created >= 1) {
        notyf.success(`Appraisal assigned successfully!`);
        // delRow(res.appId); //Delete row from UI
    } else {
        notyf.error(`Error assigning appraisal to user`);
    }
}

// Rather than reload page :-)
const delRow = (idRow) => {
    var row = document.getElementById(idRow);
    row.parentNode.removeChild(row);
}

const failure = (error) => {
    console.log("Error occurred, request not processed")
    console.log(error)
}


//  Set modal properties on template assignment
var confirmAssignModal = document.getElementById('confirmAssign')

confirmAssignModal.addEventListener('show.bs.modal', function (event) {

    // Get data about user
    var caller = event.relatedTarget;
    var tName = caller.getAttribute('data-bs-temp');
    var uName = caller.getAttribute('data-bs-uname');

    // Used for submitting {later, pass the UID and template ID to server for appraisal creation}
    var uid = caller.getAttribute('data-bs-uid');
    var tid = caller.getAttribute('data-bs-tid');

    var confirmAssignBtn = document.getElementById("btn-confirm-assign")
    confirmAssignBtn.setAttribute("data-bs-tid", tid)
    confirmAssignBtn.setAttribute("data-bs-uid", uid)

    // Get Modal Body placeholder objects
    var templateName = document.getElementById("modal-temp-name")
    var assignTo = document.getElementById("modal-user")

    // Update modal content
    templateName.innerText = tName
    assignTo.innerText = uName
})

const handleDelete = (e) => {


    var element = document.getElementById(e.target.id);
    var targetAppID = element.getAttribute("data-del-item");
    let data = {
        appId: targetAppID
    };

    var url = "../server/deleteUserApp.php";
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(res => res.json())
        .then(res => success(res))
        .catch(error => failure(error));
}


// PM schedules meeting


const handleScheduleReview = (event) => {
    var element = document.getElementById(event.target.id);
    var time = document.getElementById('meeting-time').value;
    var date = document.getElementById('meeting-date').value;

    let data = {
        time, date, appId: element.getAttribute('data-appId')
    }

    let target_url = `/Appraisal/schReview`;


    // Pass data to assign tempalte function
    var url = target_url;
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(res => res.json())
        .then(res => scheduledSuccess(res))
        .catch(error => failure(error));
}

var schBtn = document.getElementById('meetingModal')

schBtn.addEventListener('show.bs.modal', function (event) {
    var caller = event.relatedTarget;
    var appId = caller.getAttribute("data-app-id");

    var confirmSch = document.getElementById("btn-confirm-sch")
    confirmSch.setAttribute("data-appId", appId)
})

const scheduledSuccess = (res) => {
    // console.log(res)
    var notyf = new Notyf();
    if (res.updated) {
        notyf.success(`Meeting Scheduled`);
        // delRow(res.appId); //Delete row from UI
    } else {
        notyf.error(`Error Scheduling Review`);
    }
}


