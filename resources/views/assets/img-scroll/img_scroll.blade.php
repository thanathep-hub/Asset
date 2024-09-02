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
    <div class="img-present p-2 d-flex">
        <img class="img-present-show" id="img-scroll-show"
            src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $idAsset }}_1.jpg" style="cursor:zoom-in;">
    </div>
    <div class="d-flex gap-2 scroll-img">
        <img class="m-2 scroll-img-item" src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $idAsset }}_1.jpg"
            height="44px;" style="cursor:pointer;min-width:44px;">
        <img class="m-2 scroll-img-item"
            src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $idAsset }}_2.jpg" height="44px;"
            style="cursor:pointer;min-width:44px;">
        <img class="m-2 scroll-img-item"
            src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $idAsset }}_3.jpg" height="44px;"
            style="cursor:pointer;min-width:44px;">
        <div style="align-content: center;">
            <button class="btn border border-opacity-10" style="border-radius: 12px;height:40px;"><i
                    class="fa-solid fa-pen"></i></button>
        </div>

    </div>
</div>

<!-- เต็มจอ -->
<div id="fullScreenModal" class="full-screen-modal">

    <span class="close-fullscreen">&times;</span>
    <img class="full-screen-content" id="fullScreenImage">
</div>

<script>
    // เลือกทุก img ใน scroll-img
    const scrollImages = document.querySelectorAll('.scroll-img-item');
    const imgShow = document.getElementById('img-scroll-show');

    scrollImages.forEach(function(image) {
        image.addEventListener('click', function() {
            // อัพเดท src ของ img ที่โชว์
            imgShow.src = this.src;
        });
    });

    // เลือก img-scroll-show และ fullScreenModalฆ
    const fullScreenModal = document.getElementById('fullScreenModal');
    const fullScreenImage = document.getElementById('fullScreenImage');
    const closeBtn = document.querySelector('.close-fullscreen');

    // เมื่อคลิกที่ img-scroll-show
    imgShow.addEventListener('click', function() {
        fullScreenModal.style.display = 'block';
        fullScreenImage.src = this.src; // อัพเดทรูปใน full screen
    });

    // ปุ่มปิด full-screen
    closeBtn.addEventListener('click', function() {
        fullScreenModal.style.display = 'none';
    });

    // คลิกข้างนอกเพื่อปิด
    fullScreenModal.addEventListener('click', function(event) {
        if (event.target === fullScreenModal) {
            fullScreenModal.style.display = 'none';
        }
    });
</script>
