function fn_check() {
    var answer = document.getElementById('passwd').value;

    var levelId = GetCurrentLevelId()['level'];

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

}