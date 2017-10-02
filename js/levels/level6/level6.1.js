var i = 1;
setInterval(
    function() {
        if (i < 5) {
            var str = "conv" + i;
            i = i + 1;
            document.getElementById(str).style.display = "block";
            if (i % 2 != 0) {
                var str1 = "p" + i;
                document.getElementById("status").innerHTML = "Online";
                if (i < 5)
                    document.getElementById("input").value = document.getElementById(str1).innerHTML;
            } else {
                var str1 = "p" + i;
                document.getElementById("input").value = "";
                document.getElementById("input").placeholder = "Type a message";
                document.getElementById("status").innerHTML = "Typing...";
            }
        }
    }, 2000);

function validate() {
    var username = document.getElementById("wausername").value;
    var password = document.getElementById("wapassword").value;

    $.post('./ajax/levelCompletion.php', {
        level: '6',
        name: username,
        pass: password
    }, function(response) {
        jsonData = JSON.parse(response); 
        //console.log(response);
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
}

var modal = document.getElementById('myModal');
var btn = document.getElementById("n");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
