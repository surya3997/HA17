$(document).ready(function() {
    $('[data-toggle=offcanvas]').click(function() {
        $(this).toggleClass('visible-xs text-center');
        $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
        $('.row-offcanvas').toggleClass('active');
        $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
        $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
        $('#btnShow').toggle();
    });
});

function fn() {
    document.getElementById('remove').value = "";
}

function verify() {
    var typed = document.getElementById('remove').value;
    if (typed == 'oxymoron') {
        var levelId = GetCurrentLevelId()['level'];
        var answer = 'a';
        $.post('ajax/levelcompletion.php', { level: levelId, answer: answer }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData.status == EnumStatus.OK) {
                InvokeCustomMessageDialog("You have cleared the level.", function() {
                    window.location = 'index.php';
                });
            } else if (jsonData.status == EnumStatus.LEVEL_DONE) {
                InvokeCustomMessageDialog("Success. But you have already cleared this level.", function() {
                    window.location = 'index.php';
                });
            } else {
                InvokeCustomMessageDialog("Access Denied.");
            }

        });
        alert("passed the level");
    } else {
        alert("try again");
    }
}