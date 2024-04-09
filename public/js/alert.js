$('.logout-swal').on('click', function () {
    Swal.fire({
        title: "คุณต้องการออกจากระบบหรือไม่?",
        // text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#016b4e",
        cancelButtonColor: "#6e7980",
        confirmButtonText: "ออกจากระบบ!",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "กำลังออกจากระบบ!",
                // text: "Your file has been deleted.",
                icon: "success"
            });
            Swal.showLoading()
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve(true)
                }, 2000)
            }).then(() => {
                document.location.href = '/logout';
            })

        }
    });
})
