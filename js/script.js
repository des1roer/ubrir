$(function () {
    console.log('load')
    refreshBanner()
    // setInterval( function() { refreshBanner() } , 300)
    function random(min, max) {
        var rand = min + Math.random() * (max - min)
        return rand;
    }
    
    function refreshBanner() {
        console.log('refreshBanner')
        $.ajax({
            url: "php/data.php",
            data: {val: random(0, 1000)},
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
