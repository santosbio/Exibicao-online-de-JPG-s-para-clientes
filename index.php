<?php
	
	//lista as imagens JPG do diretório /imagens/
	$files = glob("images/*.jpg");

	//limpa o nome da imagem, para separar o nome do cliente
	$titulo = explode('images/', $files[0]);
	$titulo = explode('_', $titulo[1]);

	
	//lista as imagens e cria uma div para cada uma
	natsort($files);
	$i = 1;
	$z = 999;
	$container = '';
	$max = count($files);
	foreach ($files as $file) {
		$img = getimagesize($file);
		if ($i < $max) {
			$n = $i+1;
		} else {
			$n = 1;
		}

		$container .= '<a href="'.$n.'" class="telas" id="tela'.$i.'" data-tela="'.$i.'" style="background:url('.$file.') no-repeat center top; width:100%; min-width: 980px; height:'.$img[1].'px; z-index: '.$z.'"></a>';
		$i++;
		$z--;
	}
	// $qtd = '<div class="qtd" data-qtd="'.$i.'"></div>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo strtoupper(str_replace('-', ' ', $titulo[0])); ?></title>
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
#container {
	display: none;
	opacity: 0;
}
#preloader {
	display: block;
	opacity: 1;
	position: fixed;
	top: 30%;
	left: 50%;
	margin-left: -64px;
	z-index: 1;
}
</style>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/TweenMax.min.js"></script>

</head>

<body>
<img src="loading.gif" id="preloader">
<div id="container">
<?php echo $container; ?>
</div>




<script>

	$(window).load(function(){
		TweenMax.to($('#preloader'), .3, {css:{display:'none', opacity:'0'}, ease:Expo.easeInOut});
		TweenMax.to($('#container'), .3, {css:{display:'block', opacity:'1'}, ease:Expo.easeInOut});
	});

	$(document).ready(function(){
		$('.telas').css({'display': 'none', 'opacity': '0'});

		if(window.location.hash) {
		  // Fragment exists
		  var telaAtual = window.location.hash.substring(1);
		  TweenMax.to($('#tela'+telaAtual), .6, {css:{display:'block', opacity:'1'}, ease:Expo.easeInOut});
		  
		} else {
		  // Fragment doesn't exist
		  window.location.hash = '1';
		}

		$('.telas').on('click', function(e){
			e.preventDefault();

			if (!TweenMax.isTweening($('.telas'))) {
				TweenMax.to($('.telas'), .4, {css:{display:'none', opacity:'0'}, ease:Expo.easeInOut, onComplete: function(){
					window.scrollTo(0, 0);

				}});
				window.location.hash = $(this).attr('href');

			} else {
				
			};
			
		});

		
	});

	$(window).on('hashchange', function(){
	    // Alerts every time the hash changes!
	    var telaAtual = window.location.hash.substring(1);
	    TweenMax.to($('#tela'+telaAtual), .6, {css:{display:'block', opacity:'1'}, delay: .3, ease:Expo.easeInOut});
	    
	    
	    
	})
</script>
</body>
</html>
