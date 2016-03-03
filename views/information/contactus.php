<?php include VIEWS_PATH . '/_layout/link.php'; ?>

<body>
    <?php include VIEWS_PATH . '/_layout/header.php'; ?>
    <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Liên hệ</h2>    			    				    				
					<div id="gmap" class="contact-map">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.428799913696!2d105.8137575143774!3d20.975441794973506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acef8ad5350f%3A0x89435a3528118ff5!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUaMSDbmcgTG9uZw!5e0!3m2!1svi!2s!4v1456995453205" width="1140" height="385" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Góp ý</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Chủ đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Liên hệ</h2>
	    				<address>
	    					<p>CÔNG TY CỔ PHẦN TRÀNG AN</p>
							<p>Nghiêm Xuân Yên, Hoàng Mai, Hà Nội</p>
							<p>Việt Nam</p>
							<p>Điện thoại: +84 1655251141</p>
							<p>Fax: +84 973416010</p>
							<p>Email: thanhnt115@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Fan Page</h2>
							<ul>
								<li>
									<a href="https://www.facebook.com/brucelee.thanh"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="https://twitter.com/ThanhBrucelee"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="https://plus.google.com/106747159058088176140/posts"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="https://www.youtube.com/channel/UCeKGnDH7Zo5-1IfstwmpAyQ"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div>


    <?php include VIEWS_PATH . '/_layout/footer.php'; ?> 

    <script src="<?= WEBROOT_PATH ?>/js/jquery.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/bootstrap.min.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/jquery.scrollUp.min.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/price-range.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/main.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/main1.js"></script> <!-- Gem jQuery -->
</body>
</html>


<style>
    .imgProduct{
        width: 180px !important;
        height: 180px !important;
    }
    .center{
        text-align: center;
    }
    .icon-slider {
        width: 89px !important;
        height: 89px !important;
    }
    .recommend-img{
        width: 209px !important;
        height: 185px !important;
    }
    .photoView{
        width: 400px !important;
        height: 320px !important;
    }
    .left-sidebar h2, .brands_products h2{
        margin-top: 20px !important;
    }
</style>
