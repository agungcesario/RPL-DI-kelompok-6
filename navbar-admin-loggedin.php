        <nav class="navbar navbar-light bg-bdnavy text-white justify-content-between">
            <a class="navbar-brand" style="font-family:Ripeye;">CaRent</a>
            
            <form class="form-inline my-2 my-lg-0">
                
                <a class="text-white mr-3" href="home.php">Home</a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $admin->getUsername(); ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </div>
            </form>
            
        </nav>