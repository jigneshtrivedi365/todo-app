(function ($) {
    "use strict";

    const base_url = "http://127.0.0.1:8000/api/";
    function fetchAndDisplayTasks() {
        axios.get(`${base_url}list_tasks`)
            .then(function(response) {
                var tasks = response.data.data; // Assuming 'data' holds the list of tasks
                var listItems = '';
                tasks.forEach( function ( task ) {
                    
                    listItems += `<li class="task" id="task-con-${task.id}">
                                   <span class="title-lbl"> ${task.title}</span>
                                    <div class="task-buttons">
                                        <button class="edit" id="editTask-${task.id}" data-id="${task.id}">Edit</button>
                                        <button class="delete" id="deleteTask-${task.id}" data-id="${task.id}">Delete</button>
                                    </div>
                                </li>`;
                });
                $( ".task-list" ).html( listItems );
                $( ".task-footer p" ).html(`You have ${$('.task-list .task').length} pending tasks`);
            })
            .catch(function(error) {
                console.error("Error fetching tasks:", error);
            });
    }
    fetchAndDisplayTasks()

    $(document).on("click", "#addTask", function () { 
        var task = $("#addTaskInput").val();
        var id = $("#taskID").val();
        var url = `${base_url}submit_task`;
        var method = 'post';
        var data = {
            title: task
        };
    
        if (id != "") { 
            url = `${base_url}task_update/${id}`;
            method = 'put';
        }
    
        axios({
            method: method,
            url: url,
            data: data
        })
        .then(function(response) {
            $(".error-msg-title").html("");
            if (response.data.error) {
                let errorMessage = response.data.error['title'][0] ? response.data.error['title'][0] : "Something went wrong";
                $(".error-msg-title").html(errorMessage);
            } else { 
                var taskData = response.data.data;
                if (id) {
                    $( `#task-con-${taskData.id} .title-lbl` ).text( taskData.title );
                    $("#taskID").val("");
                } else { 
                    var listItem = `<li class="task" id="task-con-${taskData.id}">
                                        <span class="title-lbl"> ${taskData.title}</span>
                                        <div class="task-buttons">
                                            <button class="edit" id="editTask-${taskData.id}" data-id="${taskData.id}">Edit</button>
                                            <button class="delete" id="deleteTask-${taskData.id}" data-id="${taskData.id}">Delete</button>
                                        </div>
                                    </li>`;
                    $( ".task-list" ).prepend( listItem ); // Prepend to make it the first row
                    $( ".task-footer p" ).html(`You have ${$('.task-list .task').length} pending tasks`);
                }
                $("#addTaskInput").val("");
            }
        })
        .catch(function(error) {
            console.error("Error submitting task:", error);
        });
    });

    $( document ).on( "click", ".edit", function () { 
        let id = $( this ).data( 'id' );
        const titleLbl = this.closest('.task').querySelector('.title-lbl');
        const taskText = titleLbl.textContent.trim();
        $( "#addTaskInput" ).val(taskText);
        $( "#taskID" ).val(id);
        
    } )

    $(document).on("click", ".delete", function () { 
        let id = $(this).data('id');
        axios.delete(`${base_url}task_destroy/${id}`)
            .then(function(response) {
                $( `#task-con-${id}` ).remove();
                $( ".task-footer p" ).html(`You have ${$('.task-list .task').length} pending tasks`);
            })
            .catch(function(error) {
                console.error("Error deleting task:", error);
            });
    } );

    $(document).on("click", ".clear-all-button", function () { 
        let id = $(this).data('id');
        axios.delete(`${base_url}remove_all/`)
            .then(function(response) {
                $( ".task-list" ).html( "" );
                $( ".task-footer p" ).html(`You have ${$('.task-list .task').length} pending tasks`);
            })
            .catch(function(error) {
                console.error("Error deleting task:", error);
            });
    } );

})(jQuery);


