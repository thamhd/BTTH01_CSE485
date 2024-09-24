<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    
</head>
<css>
<style>
    /* Điều chỉnh banner (ảnh lớn phía trên) */
    .banner {
        width: 100%;
        height: 400px;
        background-image: url('slide01.jpg');
        background-size: cover;
        background-position: center;
    }

    /* Phong cách cho tiêu đề 'TOP BÀI HÁT YÊU THÍCH' */
    h3.b {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 20px;
        color:  rgb(0, 0, 255); /* Màu chữ là màu xanh */
        text-align: center;
    }

    /* Điều chỉnh container cho phần các bài hát yêu thích */
    .c {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .c figure {
        width: 23%;
        height: auto;
        border-radius: 10px;
        text-align: center;
    }

    .c img {
        width: 100%;
        border-radius: 10px;
    }

    figcaption {
        font-style: italic;
        font-size: 14px;
        color: blue;
        margin-top: 10px;
    }

    .ty {
        width: 23%;
        height: auto;
        border-radius: 10px;
        margin-top: 20px;
    }

    footer {
        background-color: white;
        padding: 20px 0;
        text-align: center;
        border-top: 2px solid #ccc;
    }

    footer h4 {
        font-size: 1.25rem;
        font-weight: bold;
    }

    main.container {
        width: 80%;
        margin: 0 auto;
    }
</style>

</css>
<body>
<?php
     include 'C:\xampp\htdocs\php\db.php'; ?> 
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="logo2.png" alt="" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./login.php">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Nội dung cần tìm" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
    <div class="banner">
   
    </div>

    <center><h3 class="b">TOP BÀI HÁT YÊU THÍCH</h3></center>

    <div class="c">
        <figure>
            <img class="cvg" src="cayvagio.jpg" alt="Cây, lá và gió">
            <figcaption>Cây, lá và gió</figcaption>
        </figure>
        <figure>
            <img class="cs" src="csmt.jpg" alt="Cuộc sống mến thương">
            <figcaption>Cuộc sống mến thương</figcaption>
        </figure>
        <figure>
            <img class="lm" src="longme.jpg" alt="Lòng mẹ">
            <figcaption>Lòng mẹ</figcaption>
        </figure>
        <figure>
            <img class="pp" src="phoipha.jpg" alt="Phôi pha">
            <figcaption>Phôi pha</figcaption>
        </figure>
    </div>

    <figure>
        <img class="ty" src="noitinhyeubatdau.jpg" alt="Nơi tình yêu bắt đầu">
        <figcaption>Nơi tình yêu bắt đầu</figcaption>
    </figure>
</main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold" >TLU'S MUSIC GARDEN</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
