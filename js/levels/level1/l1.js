$.post('ajax/getleveldata.php', { level: '1', dataKey: 'level_question' }, function(data) {
    var jsonData = JSON.parse(data);

    if (jsonData["status"]) {
        var username = jsonData["dataValue"];
        document.getElementById('username').innerHTML = username;
    }
});

function fn() {
    var str = document.getElementById('textarea1').value;
    var amount = 13;
    if (amount < 0)
        return caesarShift(str, amount + 26);

    var output = '';

    for (var i = 0; i < str.length; i++) {
        var c = str[i];

        if (c.match(/[a-z]/i)) {
            var code = str.charCodeAt(i);
            if ((code >= 65) && (code <= 90))
                c = String.fromCharCode(((code - 65 + amount) % 26) + 65);
            else if ((code >= 97) && (code <= 122))
                c = String.fromCharCode(((code - 97 + amount) % 26) + 97);
        }
        output += c;
    }
    document.getElementById('textarea2').innerHTML = output;
};

function closeFn() {
    $('#myModal').modal('hide');
}

function closeFn1() {
    $('#myModal1').modal('hide');
}

function fn1() {
    var answer = document.getElementById('pass').value;

    var levelId = GetCurrentLevelId()['level'];

    $.post('ajax/levelcompletion.php', { level: levelId, answer: answer }, function(data) {
        var jsonData = JSON.parse(data);
        if (jsonData.status == EnumStatus.OK) {
            closeFn();
            closeFn1();
            InvokeCustomMessageDialog("You have cleared the level.", function() {
                window.location = 'index.php';
            });
        } else if (jsonData.status == EnumStatus.LEVEL_DONE) {
            closeFn();
            closeFn1();
            InvokeCustomMessageDialog("Success. But you have already cleared this level.", function() {
                window.location = 'index.php';
            });
        } else {
            closeFn();
            closeFn1();
            InvokeCustomMessageDialog("Access Denied.");
        }
    });

}