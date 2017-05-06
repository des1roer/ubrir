$(function () {
    console.log('load')
//    alert(moment().format('YYYY-MM-DD HH:mm:ss'));
//    refreshBanner()
    $.ajax({
        url: "php/data.php",
        data: {act: 'create'},
        type: 'POST',
        success: function (data) {
            console.log(JSON.parse(data));
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    
    i = 0
    var interval = setInterval(function () {
        refreshBanner()
    }, 300)

    function random(min, max) {
        var rand = min + Math.random() * (max - min)
        return rand;
    }

    function guid() {
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
                s4() + '-' + s4() + s4() + s4();
    }

    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
    }

    function refreshBanner() {
        i++;
        if (i > 10)
            clearInterval(interval);
        console.log(i);
        var uuid = guid(), ts = moment().format('YYYY-MM-DD HH:mm:ss');
        console.log('refreshBanner')
        console.log(moment().format('YYYY-MM-DD HH:mm:ss'))
        $.ajax({
            url: "php/data.php",
            data: {val: random(0, 1000), act: 'insert', uuid: uuid},
            type: 'POST',
            success: function (data) {
                console.log(JSON.parse(data));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        $.ajax({
            url: "php/data.php",
            data: {act: 'back', uuid: uuid},
            type: 'POST',
            success: function (data) {
                console.log(JSON.parse(data));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }

})
