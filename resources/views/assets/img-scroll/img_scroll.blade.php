<style>
    /* scroll */
    .scroll-img {
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
    }

    .img-present {
        justify-content: center;
    }

    .img-present-show {
        height: 140px;
        min-width: 140px;
        border-radius: 8px;
    }

    .full-screen-modal {
        align-content: center;
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .full-screen-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .close-fullscreen {
        position: absolute;
        top: 20px;
        right: 35px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .close-fullscreen:hover,
    .close-fullscreen:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    .scroll-img-item {
        cursor: pointer;
        border-radius: 8px;
    }
</style>
<div class="" style="margin-bottom: 3rem;">
    <div class="img-present p-2 d-flex ">
        <img class="img-present-show border border-opacity-10" id="img-scroll-show" src="" style="cursor:zoom-in;">
    </div>
    <div class="d-flex gap-2 scroll-img ">
        <div id="img-list">
        </div>

        <div style="align-content: center;">
            <button class="btn btn-light" style="border-radius: 12px;height:40px;" onclick="show_edit_img()"><i
                    class="fa-solid fa-pen pe-2"></i>แก้ไข</button>
        </div>
    </div>
</div>

<!-- เต็มจอ -->
<div id="fullScreenModal" class="full-screen-modal">

    <span class="close-fullscreen">&times;</span>
    <img class="full-screen-content" id="fullScreenImage">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch and display images when the page is loaded
        fetchImg();

        // Attach click listener to img-scroll-show for full screen
        const imgShow = document.getElementById('img-scroll-show');
        const fullScreenModal = document.getElementById('fullScreenModal');
        const fullScreenImage = document.getElementById('fullScreenImage');
        const closeBtn = document.querySelector('.close-fullscreen');

        imgShow.addEventListener('click', function() {
            fullScreenModal.style.display = 'block';
            fullScreenImage.src = this.src; // Update full screen image
        });

        closeBtn.addEventListener('click', function() {
            fullScreenModal.style.display = 'none';
        });

        fullScreenModal.addEventListener('click', function(event) {
            if (event.target === fullScreenModal) {
                fullScreenModal.style.display = 'none';
            }
        });
    });

    function fetchImg() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/api/assets/img/" + {{ $idAsset }},
            type: 'GET',
            headers: {
                'X-CSRF-Token': csrfToken
            },
            success: function(img_path) {
                img_as = img_path;
                // console.log(img_as);

                $('#img-list').empty();
                document.getElementById('img-scroll-show').src =
                    `https://seedsgroup.dyndns.org/spm/Asset/PicAsset/${img_path[0].name_img}`;
                $.each(img_path, function(index, img_paths) {
                    const imgElement = $(`
                        <img class="m-2 scroll-img-item border border-opacity-10"
                        src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/${img_paths.name_img}" height="44px;"
                        style="cursor:pointer;min-width:44px;">
                    `);

                    imgElement.on('click', function() {
                        // Update the img-show when an image is clicked
                        $('#img-scroll-show').attr('src', this.src);
                    });

                    $('#img-list').append(imgElement);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>
