jQuery(function($){
    $('#loadmore').click(function(){ // клик на кнопку
        $(this).text('Загрузка...'); // меняем текст на кнопке
        // получаем переменные
        var data = {
            'action': 'loadmore',
            'query': posts_vars,
        };
        // отправляем Ajax-запрос 
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success:function(data){
                if(data) { 
                    $('#loadmore').text('Показать ещё').before(data);
                    $('#loadmore').remove(); // удаляем кнопку
                }
            }
        });
    });
});