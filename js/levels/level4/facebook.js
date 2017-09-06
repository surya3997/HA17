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
    var name = document.getElementById('fbusername').value;
    var pwd = document.getElementById('fbpassword').value;

    if (name == 'sudhir') {
        var levelId = GetCurrentLevelId()['level'];

        $.post('ajax/levelcompletion.php', { level: '4', answer: pwd }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData.status == EnumStatus.OK) {
                InvokeCustomMessageDialog("You have Logged in to the account and removed the comment. Level cleared successfully!", function() {
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
    } else {
        $.post('ajax/levelcompletion.php', { level: '4', answer: pwd }, function(data) {});
        InvokeCustomMessageDialog("Access Denied.");
    }


}