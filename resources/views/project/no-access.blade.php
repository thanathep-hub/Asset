<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Access</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('project/lock-icon.png') }}">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon  -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

    <!-- Fonts Family Kanit -->
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Kanit", sans-serif;
            font-size: 14px;
            background-color: #efefef7a;
        }
    </style>
</head>

<body>

    <div class="container my-5" style="text-align: center; margin-top:3rem;">
        <div>
            <img src="{{ asset('project/lock.png') }}" height="200px">
            <h2 class="mb-1 mt-5">
                ไม่มีสิทธิ์เข้าถึงข้อมูล
            </h2>
            <span
                class="font-bold">ท่านอาจจะไม่มีสิทธิ์ในการเข้าถึงข้อมูลโครงการบางอย่างหรือมีข้อผิดพลาดเกี่ยวกับข้อมูลโครงการ</span>
        </div>
    </div>

    <!-- Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
