<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" >  
<head> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>	
	function rand(num_minimo,num_maximo) {
		return Math.floor((Math.random() * (num_maximo-num_minimo+1))+num_minimo);
	}
	var level = 0;
	function getLoadBox(opcao)
	{
		if(opcao)
		{
			level++;
			$('#corpo').html('');
		}
		var cores = new Array('red','blue','black','pink','green', 'gray');
		var cor1 = rand(1,5);
		var cor2 = rand(1,4);
		cor2 = (cor2 == cor1)? cor1 + 1 : cor2;
		var soma = cor1 + cor2;
		$('#corpo').width((soma + 2) * 50);
		for(var i = 0; i < cor1; i++)
			$('#corpo').append('<div class="box" style="background-color:'+cores[cor1]+'" onclick="changeColor(this,\''+cores[cor1]+'\',\''+cores[cor2]+'\');"></div><!--/-->');
		for(var i = 0; i < cor2; i++)
			$('#corpo').append('<div class="box" style="background-color:'+cores[cor2]+'" onclick="changeColor(this,\''+cores[cor2]+'\',\''+cores[cor1]+'\');"></div><!--/-->');
		
	}
	
	function changeColor(div,currentColor,nextColor,opcao)
	{
		$(div).css('background-color',nextColor).attr('onclick','changeColor(this,\''+nextColor+'\',\''+currentColor+'\')');
		var cont = 0;
		$('.box').each(function (i) {
			if ($(this).css('background-color') == $(div).css('background-color'))
				cont++
		 });
		 if(cont == $('.box').length)
		 {
			getLoadBox(1);
			progress(10)
		 }
	}
	
	function progress(acerto) 
	{
	  var val = $( "#progressbar" ).progressbar( "value" ) || 0;
	  if(acerto)
		$( "#progressbar" ).progressbar( "value", val - acerto );
	  else
		$( "#progressbar" ).progressbar( "value", val + 1 );
		
	  if ( val < 99 ) 
		setTimeout( progress, 300 );
	  
	}
	
	
	
	$(function()
	{
		getLoadBox();	 
		var progressbar = $( "#progressbar" ), progressLabel = $( ".progress-label" );
 
		progressbar.progressbar({
		  value: false,
		  change: function() {
			progressLabel.text( "tempo: "+(-1 * (progressbar.progressbar( "value" ) - 100)) );
		  },
		  complete: function() {
			progressLabel.text( "Acertos: "+ level);
			$('#corpo').html('');
		  }
		});
	 
		setTimeout( progress, 1000 );
	});
</script>	
<style>
	.box
	{
		float: left;
		width: 50px;
		height: 50px;
		margin-right: 10px;
		margin-bottom: 10px;
	}
	.ui-progressbar 
	{
		position: relative;
	}
	.progress-label 
	{
		position: absolute;
		left: 50%;
		top: 4px;
		font-weight: bold;
		text-shadow: 1px 1px 0 #fff;
	}
	#corpo
	{
		margin: 0 auto;
	}
  </style>
</style>
</head> 
<body> 
	<div id="progressbar"><div class="progress-label"></div></div>
	<br clear="all" />
	<br clear="all" />
    <div id="corpo">
    </div><!--/corpo-->
</body>
</html>