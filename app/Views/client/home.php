<?php
require_once 'app/Views/layouts/client/header.php';

?>

<div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= BASE_URL?>app/public/client/assets/img/carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Áo nam</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Sản phẩm uy tín chất lượng mua ngay tại MultiShop</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Mua Ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= BASE_URL?>app/public/client/assets/img/carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Áo Nữ</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Sản phẩm uy tín chất lượng mua ngay tại MultiShop</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Mua Ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= BASE_URL?>app/public/client/assets/img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Áo trẻ em</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Sản phẩm uy tín chất lượng mua ngay tại MultiShop</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Mua Ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?= BASE_URL?>app/public/client/assets/img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Khuyến mãi 20%</h6>
                        <h3 class="text-white mb-3">Sản phẩm khuyến mãi</h3>
                        <a href="" class="btn btn-primary">Mua ngay</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?= BASE_URL?>app/public/client/assets/img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Khuyến mãi 20%</h6>
                        <h3 class="text-white mb-3">Sản phẩm khuyến mãi</h3>
                        <a href="" class="btn btn-primary">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->




    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm thịnh hành</span></h2>
        <div class="row px-xl-5">
           <?php foreach ($listProTrening as $key => $value) :
           
           ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100 h-100" src="<?= BASE_URL ?>/app/<?= $value->img_thumbnail ?>" alt="">
                        <div class="product-action">
                            <!-- <a class="btn btn-outline-dark btn-square" href="<?=BASE_URL.$value->id?>/addcart"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="<?=BASE_URL.$value->id?>/favourite"><i class="far fa-heart"></i></a> -->
                            <a class="btn btn-outline-dark btn-square" href="<?=BASE_URL.$value->id?>/prodetail"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?=$value->name?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                        <?php  if ($value->price_sale!=0 && isset($value->price_sale)) :?>
                            <h5><?=$value->price_sale?></h5><h6 class="text-muted ml-2"><del><?=$value->price?></del></h6>
                            <?php else :?>
                                <h5><?=$value->price?></h5>
                            <?php endif ?>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                           
                            <small>Còn lại:<?=$value->quantity?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            
         
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?= BASE_URL?>app/public/client/assets/img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Ưu đãi lớn</h6>
                        <h3 class="text-white mb-3">Giảm giá mạnh</h3>
                        <a href="" class="btn btn-primary">Mua Ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?= BASE_URL?>app/public/client/assets/img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">ƯU đãi khủng</h6>
                        <h3 class="text-white mb-3">SẢn phẩm chất lượng</h3>
                        <a href="" class="btn btn-primary">Mua Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm đang giảm giá </span></h2>
        <div class="row px-xl-5">
           <?php foreach ($listProWithSale as $key => $value) :
           
           ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100 h-100" src="<?= BASE_URL ?>/app/<?= $value->img_thumbnail ?>" alt="">
                        <div class="product-action">
                            <!-- <a class="btn btn-outline-dark btn-square" href="<?=BASE_URL.$value->id?>/addcart"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="<?=BASE_URL.$value->id?>/favourite"><i class="far fa-heart"></i></a> -->
                            <a class="btn btn-outline-dark btn-square" href="<?=BASE_URL.$value->id?>/prodetail"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?=$value->name?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?=$value->price_sale?></h5><h6 class="text-muted ml-2"><del><?=$value->price?></del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                           
                            <small>Còn lại:<?=$value->quantity?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            
         
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= BASE_URL?>app/public/client/assets/img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
    <?php
require_once 'app/Views/layouts/client/footer.php';

?>
