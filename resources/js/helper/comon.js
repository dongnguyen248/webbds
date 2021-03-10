const Swal = require('sweetalert2');
export default {
    data() {
        return {

        }
    },
    methods: {
        callApi(method, url, dataobj) {
            try {
                return axios({
                    method: method,
                    url: url,
                    data: dataobj
                })
            } catch (e) {
                console.log(e)
            }
        },

        i(desc, title = 'Hey!') {
            Swal.fire({
                toast: true,
                title: title,
                text: desc,
                icon: 'info',
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                onOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            })
        },
        e(desc, title = 'Opp!') {
            Swal.fire({
                toast: true,
                icon: "error",
                position: "top-end",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                onOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title: title,
                text: desc
            })
        },
        s(desc, title = 'Greate!') {
            Swal.fire({
                toast: true,
                icon: "success",
                position: "top-end",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                onOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title: title,
                text: desc
            })
        },
        swr(desc = 'Some thing went wrong! Please try again', title = "!Oop") {
            Swal.fire({
                toast: true,
                icon: "warning",
                position: "top-end",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                onOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title: title,
                text: desc

            })
        },

    },
}