<p>This is the footer section</p>
<a href="#" id="LogoutUser">Log Out</a>
<script type="text/javascript" src="./js/general/jquery.js"></script>
<script>
    /**
     * This is for the logout button in the Navigation bar
     */
    $("#LogoutUser").on('click', function() {
        console.log("log out clicked");
        $.post('./ajax/logout.php', {}, function(response) {
            window.location = "index.php";
        });
    });
</script>
</body>

</html>