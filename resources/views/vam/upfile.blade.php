<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>
        <div>
            <form action="/up-file-con" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="filenames" class="form-control" accept="image/png, image/jpeg"
                    style="padding-bottom: 35px;" required>
                <button type="submit" class="btn btn-success">อัพ</button>
            </form>
        </div>

    </body>
    <script>
        function ajaxCall() {
            $.ajax({
                url: '/chart-data/' + 2567 + '/' + 0,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                }
            });
        }
        ajaxCall();
    </script>

</html>
