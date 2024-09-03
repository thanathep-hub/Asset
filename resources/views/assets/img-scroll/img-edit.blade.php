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
                <h6>รอการอัพเดท...</h6>
                <ul class="list-group" id="edit-img-list">
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <img class="pe-2" src="{{ asset('assets/cloud-computing.png') }}" alt=""
                                height=24px;">
                            <label for="">A second item</label>
                        </div>
                        <button><i class="fa-regular fa-trash-can"></i></button>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn"
                    style="min-width: 160px;min-height: 44px;background-color: #369689;color:#fff;">บันทึก</button>
            </div>
        </div>
    </div>
</div>

{{-- @push('scripts') --}}
<script>
    function deleteImg(index) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this image?")) {
            // Remove the image from the array
            edit_img.splice(index, 1);
            // Refresh the image list
            show_edit_img();
        }
    }

    function show_edit_img() {
        edit_img = img_as;
        console.log(edit_img);
        $('#edit-img-list').empty();
        $.each(edit_img, function(index, edit_img) {
            const imgElement = $(`
            <li class="list-group-item d-flex justify-content-between">
                <div style="align-content: center;">
                    <img class="pe-2" src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/${edit_img.name_img}" height="24px">
                    <label for="">${edit_img.name_img}</label>
                </div>
                <button class="btn btn-light" onclick="deleteImg(${index})"><i class="fa-regular fa-trash-can"></i></button>
            </li>
        `);
            $('#edit-img-list').append(imgElement);
        });
        $('#edit-img').modal('show');

        function deleteImg(index) {
            // Confirm deletion
            if (confirm("Are you sure you want to delete this image?")) {
                // Remove the image from the array
                edit_img.splice(index, 1);
                // Refresh the image list
                show_edit_img();
            }
        }
    }
</script>
{{-- @endpush --}}
