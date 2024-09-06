<style>

</style>

<!-- Modal -->
<div class="modal fade" id="edit-img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id=""><img class="pe-2"
                        src="{{ asset('assets/cloud-computing.png') }}" height="28px"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <ul class="list-group mb-3" id="edit-img-list">
                </ul> --}}
                <div class="pt-2">
                    <p style="color: #ff0000bf;">*การเพิ่มรูปภาพใหม่จะแทนที่รูปเดิม</p>
                    <ul class="list-group mb-2" id="new-img"></ul>
                    <button class="btn btn-light" onclick="addImg()">
                        เพิ่มรูปภาพ
                        <i class="fa-solid fa-image ps-2"></i>
                    </button>
                    <div id="error-message" style="color: red;"></div>
                    <input type="file" id="add-img" accept="image/png, image/jpeg" multiple hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="add_new_img()"
                    style="border-radius: 12px;height:40px;background-color:#262f40;color:#ffffff;">อัพเดท</button>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteImg(index) {
        // Confirm deletion
        // if (confirm("Are you sure you want to delete this image?")) {
        // Remove the image from the array
        edit_img.splice(index, 1);
        // Refresh the image list
        show_edit_img();
        // }
    }

    function show_edit_img() {
        // edit_img = img_as;
        // $('#edit-img-list').empty();
        // $.each(edit_img, function(index, edit_img) {
        //     const imgElement = $(`
        //     <li class="list-group-item d-flex justify-content-between">
        //         <div style="align-content: center;">
        //             <img class="pe-2" src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/${edit_img.name_img}" height="24px">
        //             <label for="">${edit_img.name_img}</label>
        //         </div>
        //         <button class="btn btn-light" onclick="deleteImg(${index})"><i class="fa-regular fa-trash-can"></i></button>
        //     </li>
        // `);
        //     $('#edit-img-list').append(imgElement);
        // });
        $('#edit-img').modal('show');
    }

    function addImg() {
        var fileupload = document.getElementById("add-img");
        fileupload.click();
        fileupload.onchange = function() {
            var fileName = fileupload.value.split('\\')[fileupload.value.split('\\').length - 1];
        };
    }
    let imageIndex = 0;
    const maxImages = 5;
    const newImgDiv = document.getElementById('new-img');
    const imgInput = document.getElementById('add-img');
    const errorMessage = document.getElementById('error-message');
    var imageFiles;

    imgInput.addEventListener('change', function(event) {
        $('#new-img').empty();
        const files = event.target.files;
        imageFiles = files;

        if (newImgDiv.children.length + files.length > maxImages) {
            errorMessage.textContent = `คุณสามารถอัพโหลดได้สูงสุดเท่านั้น ${maxImages} รูป.`;
            return;
        } else {
            errorMessage.textContent = ''; // Clear the error message if valid
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageSrc = e.target.result;
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex';

                listItem.innerHTML = `
                <div class="pe-2" style="align-content: center;">
                    <img class="pe-2" src="${imageSrc}" height="48px">
                </div>
                <label>${file.name}</label>
            `;

                listItem.setAttribute('data-index', imageIndex);
                newImgDiv.appendChild(listItem);
                imageIndex++;
            };
            reader.readAsDataURL(file);
        });
        $('#edit-img-list').empty();
    });

    function deleteImg(index) {
        const listItem = document.querySelector(`li[data-index="${index}"]`);
        if (listItem) {
            newImgDiv.removeChild(listItem);
        }
    }

    async function add_new_img() {
        let waitSend = [];
        let data = new FormData();
        data.append('assetId', {{ $idAsset }});
        const files = $('#add-img')[0].files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const resizedFile = await resizeImage(file);
            waitSend.push(resizedFile);
        }
        waitSend.forEach((image, index) => {
            data.append('img[]', image, image.name);
        });

        $.ajax({
            type: "POST",
            url: "/assets/detail/edimg",
            data: data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {

                if (response.status === 'success') {
                    $('#edit-img').modal('hide');
                    Swal.fire({
                        icon: "success",
                        text: "บันทึกเรียบร้อยแล้ว",
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#369689'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: "warning",
                        title: response.msg,
                        showConfirmButton: true,
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }

            }
        });
    }
</script>
