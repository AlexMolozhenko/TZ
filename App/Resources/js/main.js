
let update_btn = $('.update_btn');
let save_btn = $('.save_btn');
let cancel_btn = $('.cancel_btn');
let load_task_btn = $('.load_task_btn');
let edit_btn;
let delete_btn;
let body_table_task = $('.body_table_task');
let task_form = $('#task_form');

/**
 * When the document is ready, hide the update and cancel buttons
 */
$(document).ready(function(){
    update_btn.hide();
    cancel_btn.hide();
})
/**
 * Function to escape special characters in HTML
 * @param unsafe
 * @returns {string|*}
 */
let escapeHtml = function (unsafe) {
    if (typeof unsafe !== 'string') {
        console.warn("escapeHtml was called with a non-string value:", unsafe);
        return unsafe;
    }
    return unsafe.replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
/**
 * Event handler for the "Save" button
 */
save_btn.on('click',function (){
    let formData =  new FormData(task_form[0]);

    $.ajax({
        type: "POST",
        url: '/task/create',
        dataType: 'json',
        data: {
            title: escapeHtml(formData.get('title')),
            description: escapeHtml(formData.get('description')),
        },
        success: function(data){
            console.log(data);
            if(data === true){
                loadAllTask();
                task_form[0].reset();
            }
        },
        error: function (jqXHR, exception) {
            console.error(jqXHR);
        }
    });
})

/**
 * Function to download all tasks
 */
let loadAllTask = function(){
    $.ajax({
        url: '/task',
        method: 'get',
        dataType: 'json',
        success: function(data){
            fillOutTheTable(data)
        },
        error: function (jqXHR, exception) {
            console.error(jqXHR.responseText)
        }
    });
};

/**
 * Event handler for the "Cancel" button
 */
cancel_btn.on('click',function(){
    task_form[0].reset();
    update_btn.hide();
    cancel_btn.hide();
    save_btn.show();
})

/**
 * Event handler for the "Update" button
 */
update_btn.on('click',function (){
    let formData =  new FormData(task_form[0]);

    $.ajax({
        type: "POST",
        url: '/task/update',
        dataType: 'json',
        data:{
            id: escapeHtml(formData.get('id')),
            title: escapeHtml(formData.get('title')),
            description: escapeHtml(formData.get('description')),
        } ,
        success: function(data){
            console.log(data);
            if(data === true){
                loadAllTask();
                task_form[0].reset();
                update_btn.hide();
                cancel_btn.hide();
                save_btn.show();
            }
        },
        error: function (jqXHR, exception) {
            console.error(jqXHR);
        }
    });
})

/**
 * Function for editing a task
 * @param dataTask
 */
let editTask = function(dataTask){
    task_form[0].reset();

    $('#id').val( escapeHtml(dataTask.id));
    $('#title').val( escapeHtml(dataTask.title));
    $('#description').val( escapeHtml(dataTask.description));

    update_btn.show();
    cancel_btn.show();
    save_btn.hide();

}
/**
 * Function for getting a task by ID
 * @param id
 */
let getTaskById = function(id){
    $.ajax({
        url: '/task/edit/',
        method: 'get',
        dataType: 'json',
        data: {
            'id':  escapeHtml(id)
        },
        success: function(data){
            console.log(data);
            editTask(data);
        },
        error: function (jqXHR, exception) {
            console.error(jqXHR)
        }
    });
}

/**
 * Function for deleting a task
 * @param id
 */
let deleteTask = function(id){

    $.ajax({
        url: '/task/delete/',
        method: 'post',
        dataType: 'json',
        data: {
            'id':  escapeHtml(id)
        },
        success: function(data){
            console.log(data);
            if(data === true){
                loadAllTask();
                task_form[0].reset();
                update_btn.hide();
                cancel_btn.hide();
                save_btn.show();
            }
        },
        error: function (jqXHR, exception) {
            console.error(jqXHR);
        }
    });
}

/**
 * Function for filling a table with tasks
 * @param tasks
 */
let fillOutTheTable = function (tasks) {
    body_table_task.html('');
    let row ='';
    $.each(tasks, function(index, task) {
        row = `<tr>
<td>${ escapeHtml(task.id)}</td>
<td>${ escapeHtml(task.title)}</td>
<td>${ escapeHtml(task.description)}</td>
<td><button type="button" class="tbl_btn btn_delete" id="${ escapeHtml(task.id)}">Delete</button><button class="tbl_btn btn_edit" type="button"  id="${ escapeHtml(task.id)}">Edit</button></td>
</tr>`;
        body_table_task.append(row);
    });

    edit_btn = $('.btn_edit');
    edit_btn.on('click',function(e){
        let id = e.target.id;
        console.log(id);
        getTaskById(id);
    })

    delete_btn = $('.btn_delete');
    delete_btn.on('click',function(e){
        let id = e.target.id;
        console.log(id);
        deleteTask(id)
    })
}

/**
 * Event handler for the "Load tasks" button
 */
load_task_btn.on('click',function (){
    loadAllTask();
})
