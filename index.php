<?php
	
	//lista as imagens JPG do diretório /imagens/
	$files = glob("images/*.jpg");

	//limpa o nome da imagem, para separar o nome do cliente
	$titulo = explode('images/', $files[0]);
	$titulo = explode('_', $titulo[1]);

	//lista as imagens e cria uma div para cada uma
	natsort($files);
	$i = 0;
	$container = '';
	foreach ($files as $file) {
	    $img = getimagesize($file);
	    $container .= '<div class="telas" id="tela'.$i.'" data-tela="'.$i.'" style="background:url('.$file.') no-repeat center top; width:100%; min-width: 980px; height:'.$img[1].'px;"></div>';
	    $i++;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo strtoupper(str_replace('-', ' ', $titulo[0])); ?></title>
<link rel="stylesheet" href="css/jpreloader.css" />
<style type="text/css">
html, body {
margin:0;
padding:0;
}
.telas {
display: none;
opacity: 0;
position: absolute;
cursor: pointer;
}
</style>
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script src="js/vendor.js"></script>
<script src="js/jpreloader.js"></script>
<!--CDN links for the latest TweenLite, CSSPlugin, and EasePack-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/easing/EasePack.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
</head>

<body>
<?php echo $container; ?>
<script type="text/javascript">

	$(document).ready(function(){
		var timer;	//timer for splash screen
		window.location.hash = '1';
		//calling jPreLoader
		$('body').jpreLoader({
			splashID: "#jSplash",
			loaderVPos: '70%',
			autoClose: true,
			closeBtnText: "Clique aqui para acessar.",
			splashFunction: function() {  
				//passing Splash Screen script to jPreLoader
				$('#jSplash').children('section').not('.selected').hide();
				$('#jSplash').hide().fadeIn(800);
				
				timer = setInterval(function() {
					splashRotator();
				}, 4000);
			}
		}, function() {	//callback function
			clearInterval(timer);
			$('#footer')
			.animate({"bottom":0}, 500);
			$('#header')
			.animate({"top":0}, 800, function() {
				$('#wrapper').fadeIn(1000);
			});
		});
		
		//create splash screen animation
		function splashRotator(){
			var cur = $('#jSplash').children('.selected');
			var next = $(cur).next();
			
			if($(next).length != 0) {
				$(next).addClass('selected');
			} else {
				$('#jSplash').children('section:first-child').addClass('selected');
				next = $('#jSplash').children('section:first-child');
			}
				
			$(cur).removeClass('selected').fadeOut(800, function() {
				$(next).fadeIn(800);
			});
		}

		TweenLite.to($('#tela0'), .5, {css:{opacity: '1', display: 'block'}, ease:Power3.easeOut});
		
		$('.telas').on('click', function(){

			var t = $(this).attr('data-tela');
			var pos = parseInt(t);
			var nextpos = pos+1;
			var hash = pos+2;
			
			if (pos == 0) {
				var prevpos = 0;
			} else {
				var prevpos = pos-1;
			};

			if (pos == 0) {
				window.location.hash = hash;
				TweenLite.to($('#tela0'), .3, {css:{opacity: '0', display: 'none'}, ease:Power3.easeOut, onComplete: function(){
					TweenLite.to($('#tela'+nextpos), .5, {css:{opacity: '1', display: 'block'}, ease:Power3.easeOut});
					window.scrollTo(0, 0);
  					
				}});

			} else {
				if (nextpos == <?php echo $i; ?>) {
					window.location.hash = '1';
					TweenLite.to($('#tela'+pos), .3, {css:{opacity: '0', display: 'none'}, ease:Power3.easeOut, onComplete: function(){
						TweenLite.to($('#tela0'), .5, {css:{opacity: '1', display: 'block'}, ease:Power3.easeOut});
						window.scrollTo(0, 0);
  						
					}});
					
				} else {
					window.location.hash = hash;
					TweenLite.to($('#tela'+pos), .3, {css:{opacity: '0', display: 'none'}, ease:Power3.easeOut, onComplete: function(){
						TweenLite.to($('#tela'+nextpos), .5, {css:{opacity: '1', display: 'block'}, ease:Power3.easeOut});
						window.scrollTo(0, 0);
  						
					}});
					
				};
			};
		});
	});
</script>

<!-- This section is for Splash Screen -->
<section id="jSplash">
	<section class="selected">
		<strong></strong>
	</section>
</section>
<!-- End of Splash Screen -->
</body>
</html>
