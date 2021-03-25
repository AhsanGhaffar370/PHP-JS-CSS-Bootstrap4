<div class="container-fluid bg-white sh_md">

    <nav class="navbar navbar-expand-lg animated slideInDown navbar-light bg-white pl-4 pr-4 pt-3 pb-3 ml-5">
        <!-- <nav className="navbar navbar-expand-lg fixed-top animated slideInDown navbar-light bg-dark pl-4 pr-4 pt-2 pb-2"> sticky header -->

        <!-- <a class="navbar-brand text-primary" href="#"><i class="fab fa-blogger-b fa-3x text-primary"></i></a> -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            <!-- <input type="button" name="submitbtn" class="btn btn-primary font-weight-bold mr-2 rounded-circle" value="<?PHP //echo $_SESSION['username'] ?>"> -->

            <?PHP
            if(strlen($_SESSION['avatar'])==0)
            {
            ?>
                <a href="profile.php?id=<?PHP echo $_SESSION['id']?>">
                    <img src="profile_images/law9.jpg" class="img-responsive" width="50" height="50" alt="profile pic"
                        style="border-radius: 6.25rem!important;">
                </a>
            <?PHP }
            else{
            ?>
                <a href="profile.php?id=<?PHP echo $_SESSION['id']?>">
                    <img src="profile_images/<?PHP echo $_SESSION['avatar'] ?>" class="img-responsive" width="50"
                        height="50" alt="profile pic" style="border-radius: 6.25rem!important;">
                </a>
            <?PHP } ?>

            <!-- <input type="button" name="submitbtn" class="btn btn-danger size15 font-weight-bold  mr-2 ml-2 rounded-0"
                value="Logout" onclick="window.location.href='logout.php'"> -->

        </div>
    </nav>
</div>