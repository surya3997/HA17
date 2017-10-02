var levelId = GetCurrentLevelId()['level'];

setInterval(function () {
    $.post('ajax/levelcompletion.php', { level: levelId, connection: "NOT OKAY", secure_key: "ed17f480c71979c5447ee002aefc7825" }, function (data) {
        var jsonData = JSON.parse(data);
        if (jsonData.status == EnumStatus.OK) {
            InvokeCustomMessageDialog("You have cleared the level.", function () {
                window.location = 'index.php';
            });
        } else if (jsonData.status == EnumStatus.LEVEL_DONE) {
            InvokeCustomMessageDialog("Success. But you have already cleared this level.", function () {
                window.location = 'index.php';
            });
        }
    });

}, 8000);