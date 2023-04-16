const Update = document.querySelectorAll('#update');
let modal = document.getElementById('openmodal');
let task_name = document.getElementById('task_name');
let user_email = document.getElementById('user_email');
let status = document.getElementById('status');
let TaskDetails = document.getElementById('details');
let user_id = document.getElementById('user_id');
let task_id = document.getElementById('task_id')
let id = 0

Update.forEach(element => {
    element.addEventListener('click', (e) => {
        id = e.target.value;
        task_id.value = id;

        async function get_task_details() {
            try {
                const data = new FormData();
                data.append("id", id);
                let response = await axios.post(`/update_task`, data);

                if (response.data.data.length > 0) {
                    for (const details of response.data.data) {
                        modal.click();
                        user_id.value = details['user_id'];
                        task_name.value = details['task_name'];
                        user_email.value = details['email'];
                        if (details['submit'] == 0) {
                            status.innerHTML = 'Not Yet Finished'
                            status.value = details['submit']
                        } else {
                            status.innerHTML = 'Fnished';
                            status.value = details['submit']
                        }
                        TaskDetails.value = details['details'];
                    }
                }
            } catch (error) {
                console.log(error);
            }
        }
        get_task_details();
    })

});



