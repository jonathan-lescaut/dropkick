// Slider Header ===================================================================

$(function(){

	var mainpc01 = $('#slidertype1');
	var mainpc02 = $('#slidertype2');
	var mainpc03 = $('#slidertype3');
	var mainpc04 = $('#slidertype4');
	var mainpc05 = $('#slidertype5');

    var slide_num = 3;  //Number of pictures
	var fadeSpeed = 1500; //Speed of fade
	var countspeed = 7000; //Picture stopping time
	var countspeed2 = fadeSpeed - 100; //Time delay between the two pictures


	function init() {
		mainpc01.hide().stop();
		mainpc02.hide().stop();
		mainpc03.hide().stop();
		mainpc04.hide().stop();
		mainpc05.hide().stop();
	}

	$(window).load(function(){

		init();
		var count = 1;
		var pic_num = 1;
		var stop_count = 1;
		var repeat = 0;

		(function loop () {

				if (count == 1){

				//photo on
				

				$('#slidertype' + pic_num).css({display:'block',opacity:'0', transition: 'max-height 0.5s ease 0.5s '}).animate({opacity:'1'},fadeSpeed);
				}
				else if (count == 2){
				//photo off
				$('#slidertype' + pic_num).css({display:'block',opacity:'1'}).animate({opacity:'0'},fadeSpeed);
				}
				else if (count == 3){
				//hide the photo
					$('#slidertype' + pic_num).hide();

				//Next photo
				pic_num = pic_num + 1;
				stop_count = stop_count +1;

							//For Loop
							if(repeat >= 1){
								pic_num = 1;
								stop_count = 1;
								repeat = 0;
							}

				$('#slidertype' + pic_num).css({display:'block',opacity:'0'}).animate({opacity:'1'},fadeSpeed);
				}
				count = count + 1;

							//For Loop
							if (stop_count == slide_num){
								repeat = repeat + 1;
							}

					if (count == 4){
					    count = 2;
					}

					if (count == 2){
						setTimeout(loop, countspeed);

					}else if (count == 3){
						setTimeout(loop, countspeed2);

					}
		})();

	});
});

// Accordium ================================

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "flex") {
      panel.style.display = "none";
    } else {
      panel.style.display = "flex";
    }
  });
}

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}

// ==========================================
// Page caroussel poutine ===============================

var timer = 4000;

var i = 0;
var max = $('#c > li').length;
console.log(max);
 
	$("#c > li").eq(i).addClass('active').css('left','0');
	$("#c > li").eq(i + 1).addClass('active').css('left','25%');
	$("#c > li").eq(i + 2).addClass('active').css('left','50%');
	$("#c > li").eq(i + 3).addClass('active').css('left','75%');
 

	setInterval(function(){ 

		$("#c > li").removeClass('active');

		$("#c > li").eq(i).css('transition-delay','0.25s');
		$("#c > li").eq(i + 1).css('transition-delay','0.5s');
		$("#c > li").eq(i + 2).css('transition-delay','0.75s');
		$("#c > li").eq(i + 3).css('transition-delay','1s');

		if (i < max-4) {
			console.log(i);
			i = i+4; 
			if (i>4) {
			i = 0; 
			}
		}

		else { 
			i = 0; 
		}  

		$("#c > li").eq(i).css('left','0').addClass('active').css('transition-delay','1.25s');
		$("#c > li").eq(i + 1).css('left','25%').addClass('active').css('transition-delay','1.5s');
		$("#c > li").eq(i + 2).css('left','50%').addClass('active').css('transition-delay','1.75s');
		$("#c > li").eq(i + 3).css('left','75%').addClass('active').css('transition-delay','2s');
	
	}, timer);
 
// ==========================================

