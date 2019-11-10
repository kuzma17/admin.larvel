
$('.delete').click(function () {
    var res = confirm('Подтвердите действие!')
   if (!res){
       return false;
   }
});

$('.redact').click(function () {
    var res = confirm('Вы можете только изменить комментарий!')
        return false;
});

$('.destroy_order').click(function () {
    var res = confirm('Подтвердите действие!');
    if (res){
        var ress = confirm('Вы удалите данные из БД!');
        if (!ress) return false;
    }

    if (!res) return false;
});