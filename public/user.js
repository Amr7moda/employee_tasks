const update = document.querySelectorAll('#updateUser');
let usermodal = document.getElementById('openusermodal');
let user_name = document.getElementById('user_name');
let user_emaill = document.getElementById('user_email');
let role = document.getElementById('role');
let userr_id = document.getElementById('user_id');


update.forEach(element => {
    element.addEventListener('click', (e) => {
        id = e.target.value;

        async function get_user_details() {
            try {
                const data = new FormData();
                data.append("id", id);
                let response = await axios.post(`/update_user`, data);
                if (response.status == '200') {
                    const details = response.data.data;

                    usermodal.click();
                    userr_id.value = details['id'];
                    user_name.value = details['name'];
                    user_emaill.value = details['email'];
                    role.value = details['role'];
                    role.innerHTML = details['role'];
                }
            } catch (error) {
                console.log(error);
            }
        }
        get_user_details();
    })

});



