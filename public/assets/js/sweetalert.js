const Toast = Swal.mixin({
    toast: true,
    position: "top-right",
    iconColor: "white",
    customClass: {
        popup: "colored-toast",
    },
    showConfirmButton: false,
    timer: 30000,
    timerProgressBar: true,
});

function showSuccess() {
    Toast.fire({
        icon: "success",
        title: "Log out Berhasil!",
    });
}

function showSuccessLogin() {
    Toast.fire({
        icon: "success",
        title: "Log in Berhasil!",
    });
}
