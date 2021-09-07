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