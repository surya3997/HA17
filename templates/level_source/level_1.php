<div class="container" id="india_html">
<div class="row">

    <div class="col-md-12  d-flex align-items-center justify-content-center " style=" height:100vh;">

        <div id="box" style=" padding:50px; border-radius:4px;padding-left: 22%;">

            <img id="compimg1" data-toggle="modal" data-target="#myModal" src="./res/images/levels/level1/computer.png">
            <img id="compimg2" data-toggle="modal" data-target="#myModal1" src="./res/images/levels/level1/computer.png">
        </div>
    </div>
</div>

</div>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

    <div class="modal-content" style="background-color:black; border: 2px solid gray;">
        <div class="modal-header" style="border-bottom:0px; height:80%; background-color:gray; padding:3px; display:block">
            <div class="text-right">
                <img id="minimg" src="./res/images/levels/level1/minimize.png" onclick="closeFn();"></img>
                <img id="closeimg" src="./res/images/levels/level1/close.png" onclick="closeFn();"></img>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <textarea id="textarea1"></textarea>
                </div>
                <div class="col-sm-6">
                    <textarea id="textarea2" readonly></textarea>
                </div>
            </div>


        </div>
        <div class="modal-footer" style="border-top:0px; padding-bottom: 10px;padding-top: 3px; ">
            <button type="button" style="background-color:gray; color:white; " class="btn btn-default" onclick="fn()">CONVERT</button>
        </div>

    </div>
</div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">

    <div class="modal-content" style="background-color:black; border: 2px solid gray;">
        <div class="modal-header" style="border-bottom:0px; height:80%; background-color:gray; padding:3px; display:block">
            <div class="text-right">
                <img id="minimg" src="./res/images/levels/level1/minimize.png" onclick="closeFn1();"></img>
                <img id="closeimg" src="./res/images/levels/level1/close.png" onclick="closeFn1();"></img>
            </div>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 text-right">
                    <img style="height:50px" src="./res/images/levels/level1/account.png"></img>
                </div>
                <div class="col-sm-4">
                    <h3 id="username">sample</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <input type="password" id="pass" style="width: 45%; margin-left:29%" class="form-control form-rounded transparent-input" placeholder="Password">
            </div>


        </div>
        <div class="modal-footer" style="border-top:0px; padding-bottom: 10px;padding-top: 3px; align:center">
            <button type="button" style="background-color:gray; color:white; " class="btn btn-default" onclick="fn1()">SUBMIT</button>
        </div>

    </div>
</div>
</div>