function caesar(str) {
    var amount = 5;
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
    return output;
};

function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay) {};
}
var i = 0;
dateVal = 0;
monthVal = 0;
yearVal = 0;

hrsVal = 0;
minVal = 5;
secVal = 0;

var log = [];
log.push('Password:' + caesar('genisys'));
log.push('Password:' + caesar('genisys'));
log.push('Password:' + caesar('genisys'));
var directory = [];
directory.push('bin\tetc\troot\tNetwork\tOS');
directory.push('hello.txt\tNetwork.py');
directory.push('hello.txt\tOS.py');
var directoryLs = [];
directoryLs.push('bin\tetc\troot\tNetwork\tOS\tHack-a-Venture.log');
directoryLs.push('hello.txt\tNetwork.py\tNetwork.log');
directoryLs.push('hello.txt\tOS.py\tOS.log');
var directoryL = [];
directoryL.push('dr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tbin\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tetc\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\troot\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tNetwork\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tOS');
directoryL.push('-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\thello.txt\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tNetwork.py');
directoryL.push('-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\thello.txt\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tOS.py');
var directoryLa = [];
directoryLa.push('dr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tbin\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tetc\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\troot\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tNetwork\ndr--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tOS\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tHack-a-Venture.log');
directoryLa.push('-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\thello.txt\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tNetwork.py\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tNetwork.log');
directoryLa.push('-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\thello.txt\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tOS.py\n-r--r--r--\t4\troot\troot\t1240\tJan 15 08:12\tOS.log');
var manHelp = ("Use one of the following commands:\n\tclear .... clear the terminal\n\tdate  ..... display date \n\thelp ..... show how to use a command\n\tls   ..... st the files in the current directory\n\tcd   ..... change directory\n\tcat  ..... contenate into a file\n\thead ..... show the first specified number of lines\n\ttail ..... show the last specified number of lines\n\tman  ..... page for how to use commands\n\tsudo  ..... superuser previlages ");
var clearHelp = "\n\tclear - clear the terminal screen\n\n\n";
var lsHelp = "\n\tls - list directory contents\n\nUsage:\tls [OPTION]... [FILE]...\n\n\nOptions:\n\n\t-a, --all\n\t\t\t\tdo not hide entries starting with .\n\t-A, --almost-all\n\t\t\t\tdo not list implied . and ..\n\t-d, --directory\n\t\t\t\tlist directory entries instead of contents, and do not  dereference symbolic links\n\t--help display this help and exit\n\n\n";
var cdHelp = "\n\tcd - change directory\n\nUsage:\t cd [DIRECTORY]\n\n\n";
var catHelp = "\n\tcat - concatenate files and print on the standard output\n\nUsage:\tcat [FILE]...\n\n\n";
var headHelp = "\n\thead - output the first part of files\n\nUsage:\thead [OPTION]... [FILE]...\n\n\nOptions:\n\n\t-c, --bytes=[-]K\n\t\t\t\tprint the first K bytes of each file; with the leading '-', print all but the last K bytes of each files\n\t-n, --lines=[-]K\n\t\t\t\tprint the first K instead of the first 10; with the leading '-', print all but the last K lines of each file\n\t--help display this help and exit\n\n\n";
var tailHelp = "\n\ttail - output the last part of files\n\nUsage:\ttail [OPTION]... [FILE]...\n\n\nOptions:\n\n\t-c, --bytes=K\n\t\t\t\tprint the last K bytes of each file;\n\t-n, --lines=K\n\t\t\t\tprint the last K instead of the last 10; with the leading\n\t--help display this help and exit\n\n\n";
var sudoHelp = "\n\tsudo - superuser\n\nUsage:\t sudo\n\n\n";
var dateHelp = "\n\tdate - display date and time \n\nUsage:\t date [OPTION]\n\n\nOptions: \n\n\t-s, setdate xxxxxxxxxx \n\n\n\t\t\t\tdate -s {month}{day}{hour}{minute}{year}\n\n";
var manPage = $.makeArray(manHelp);


jQuery(document).ready(function($) {
    var id = 1;
    $('body').terminal(function(command, term) {
        var com = command.split(' ');
        if (command == 'man') {
            term.echo(manPage);
        } else if (command.indexOf('help') == 0) {
            if (com.length > 2) {
                term.echo('You can use only one command for help at a time!!!');
            } else if (com.length < 2) {
                term.echo('You have to give at-least one argument to help');
            } else {
                if (com[1] == 'ls') {
                    term.echo(lsHelp);
                } else if (com[1] == 'clear') {
                    term.echo(clearHelp);
                } else if (com[1] == 'cd') {
                    term.echo(cdHelp);
                } else if (com[1] == 'cat') {
                    term.echo(catHelp);
                } else if (com[1] == 'head') {
                    term.echo(headHelp);
                } else if (com[1] == 'tail') {
                    term.echo(tailHelp);
                } else if (com[1] == 'sudo') {
                    term.echo(sudoHelp);
                } else if (com[1] == 'date') {
                    term.echo(dateHelp);
                } else {
                    term.echo("No help found for " + com[1]);
                }
            }
        } else if (com[0] == 'ls') {
            if (true) {
                if (com[1] == '-a' || com[1] == '--all') {
                    if (com.length == 3) {
                        if (com[2] == '-l')
                            term.echo(directoryLa[i]);
                        else if (com[2] == '-A' || com[2] == '--almost-all')
                            term.echo(directoryLs[i]);
                        else
                            term.echo('ls ' + com[2] + " is not defined");
                    } else
                        term.echo(directoryLs[i])
                } else if (com[1] == '-l') {
                    if (com.length == 3) {
                        if (com[2] == '-a' || com[2] == '--all')
                            term.echo(directoryLa[i]);
                        else if (com[2] == '-A' || com[2] == '--almost-all')
                            term.echo(directoryL[i]);
                        else
                            term.echo('ls ' + com[2] + " is not defined");
                    } else
                        term.echo(directoryL[i]);
                } else if (com[1] == '-A' || com[1] == '--almost-all') {
                    if (com[2] == '-a' || com[2] == '--all')
                        term.echo(directoryLs[i]);
                    else if (com[2] == 'l')
                        term.echo(directoryL[i]);
                    else
                        term.echo(directory[i]);
                } else
                    term.echo(directory[i]);
            }
        } else if (com[0] == 'date') {
            if (true) {
                if (com[1] == '-s' || com[1] == '--all') {
                    if (com.length == 3) {
                        if (com[2].length == 10) {
                            data = com[2]
                            a = []

                            time = new Date;
                            time1 = time;
                            flag = 0;
                            if (data % 1 === 0) {

                                do { a.push(parseInt(data.substring(0, 2))) }
                                while ((data = data.substring(2, data.length)) != "");

                                if (a[0] == 0 && a[1] == 0 && a[2] == 0 && a[3] == 0 && a[4] == 0) {
                                    flag = 1;
                                }

                                time.setDate(a[1]);
                                time.setMonth(a[0] - 1);
                                time.setFullYear(2000 + a[4]);
                                time.setHours(a[2]);
                                time.setMinutes(a[3]);

                                time1 = new Date;
                                dateVal = time1.getDate() - time.getDate();;
                                monthVal = time1.getMonth() - time.getMonth();
                                yearVal = time1.getYear() - time.getYear();

                                hrsVal = time1.getHours() - time.getHours();
                                minVal = time1.getMinutes() - time.getMinutes();
                                secVal = time1.getSeconds() - time.getSeconds();

                                if (flag == 1) {
                                    monthVal = monthVal + 1;
                                    dateVal = dateVal - 1;
                                }

                                term.echo("Time set");
                            } else {
                                term.echo("error in format");
                            }

                        } else
                            term.echo("length of argument is less");
                    } else
                        term.echo("please enter time to set")
                } else {
                    time = new Date;

                    time.setDate(time.getDate() - dateVal);
                    time.setMonth(time.getMonth() - monthVal);
                    time.setYear(time.getFullYear() - yearVal);
                    time.setHours(time.getHours() - hrsVal);
                    time.setMinutes(time.getMinutes() - minVal);
                    time.setSeconds(time.getSeconds() + secVal);

                    term.echo(time);
                }
            }
        } else if (com[0] == 'sudo') {
            term.echo("type exit for exiting");
            term.push(function(command, term) {
                if (command == 'genisys') {
                    term.echo('Congrats the level is passed');
                    term.push(function(command, term) {

                    }, {
                        name: 'sudo',
                        prompt: 'sudo@Hack-a-Venture$ '
                    });
                } else {
                    term.echo('Wrong Password Try AGAIN!!!');
                    log[i] += ('\nPassword:' + caesar(command) + ' (WRONG)');
                }
            }, {
                name: 'password',
                prompt: 'password: '
            });
        } else if (com[0] == 'getpasswd') {
            current = new Date;
            currentp2 = new Date;

            currentp2.setMinutes(currentp2.getMinutes() + 5);
            alert("c2" + currentp2);
            alert("c" + current);

            time = new Date;

            time.setDate(time.getDate() - dateVal);
            time.setMonth(time.getMonth() - monthVal);
            time.setYear(time.getFullYear() - yearVal);
            time.setHours(time.getHours() - hrsVal);
            time.setMinutes(time.getMinutes() - minVal);
            time.setSeconds(time.getSeconds() + secVal);
            alert("t" + time);
            if (time <= currentp2 && time >= current) {
                term.echo('Fetching from server.........');
                term.echo('blockchain');
            } else {
                term.echo('\nFetching from server.........');
                term.echo('timeout');
            }

        } else if (com[0] == 'cd') {
            if (com.length > 2) {
                term.echo('cd takes only one argument');
            } else if (com.length < 2) {
                term.echo('cd takes exact one argument');
            } else {
                if (com[1] == 'Network') {
                    i = 1;
                } else if (com[1] == 'OS') {
                    i = 2;
                } else if (com[1] == '..' || com[i] == '../') {
                    if (i == 0) {
                        term.echo('Permission Denied!!!');
                    } else {
                        if (i == 1 || i == 2) {
                            i = 0;
                        } else
                            i = i - 1;
                    }
                } else {
                    term.echo('Error cannot cd into /' + com[1]);
                }
            }
        } else if (com[0] == 'cat') {
            if (command.includes('>')) {
                term.echo('Permission denied for concatenation');
            } else if (com.length == 2) {
                if (com[1] == 'Hack-a-Venture.log') {
                    term.echo("try getpasswd command......");
                } else {
                    if (directoryLs[i].includes(com[1])) {
                        term.echo('Permission denied for File: ' + com[1]);
                    } else
                        term.echo('File ' + com[1] + " doesnt exist");
                }
            } else
                term.echo('Cannot open more than one file');
        } else if (com[0] == 'head') {
            if (com.length == 2) {
                if (com[1] == 'Hack-a-Venture.log') {
                    term.echo(log[i]);
                } else {
                    if (directoryLs[i].includes(com[1])) {
                        term.echo('Permission denied for File: ' + com[1]);
                    } else
                        term.echo('File ' + com[1] + " doesnt exist");
                }
            } else
                term.echo('Cannot open more than one file');
        } else if (com[0] == 'tail') {
            if (com.length == 2) {
                if (com[1] == 'Hack-a-Venture.log') {
                    term.echo(log[i]);
                } else
                    term.echo('File ' + com[1] + " doesnt exist");
            } else {
                if (directoryLs[i].includes(com[1])) {
                    term.echo('Permission denied for File: ' + com[1]);
                } else
                    term.echo('File ' + com[1] + " doesnt exist");
            }
        } else {
            term.echo("unknown command " + command);
        }
    }, {
        greetings: "Welcome Hacker to the TERMINAL Page\nType man for the supported commands",
        prompt: 'guest@Hack-a-Venture>',
        onBlur: function() {
            return false;
        }
    });
});