
const url = 'http://127.0.0.1:8000'

window.addEventListener("load", function(){
    
    /* Like */
	$(document).on("click", ".btn-like", function(e){
		$(this).addClass('btn-dislike').removeClass('btn-like');
		$(this).attr('src', url+'/img/hearts-red.png');

        $.ajax({
            url: url+'/like/' + $(this).data('id'),
            type: 'GET',
            success: response => {
                message($(this).parent(), response.message)
            }
        })
	});

    /* Dislike */
	$(document).on("click", ".btn-dislike", function(e){
		$(this).addClass('btn-like').removeClass('btn-dislike');
		$(this).attr('src', url+'/img/hearts-gray.png');

        $.ajax({
            url: url+'/dislike/' + $(this).data('id'),
            type: 'GET',
            success: response => {
                message($(this).parent(), response.message)
            }
        })
	});

    function message(divContent, message, color = 'warning'){
        // Alert
        const div = document.createElement('div')
        div.classList.add('alert', 'alert-'+color, 'alert-dismissible', 'fade', 'show')
        div.role = `alert`
        div.innerHTML = `<strong>${message}</strong>`
        // Agrego al DOM
        divContent.append(div)
        // Borro el elemento
        setTimeout( () => {
            div.remove()
        }, 2000)
    
    }

});

