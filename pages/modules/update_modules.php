
<?php
// If the SESSION has not been started, start it now
if (!isset($_SESSION)) {
  session_start();
}

// If there is no username, then we need to send them to the login
if (!isset($_SESSION['username'])){
  $_SESSION['return_location'] = $_SERVER['PHP_SELF']; //sets the return location used on login page
  header('Location: ../login.php');
}
require('../header.php');
require('../navbar.php');
require('../footer.php');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 <?php if($_SESSION['themeColor'] == "dark-edition") { echo "main-dark"; } ?> ">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h3 class="h3">Host Modules</h3>
      </div>

      <form action="" method="POST">
        <div class="content">
          <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

              <div class="card <?php if($_SESSION['themeColor'] == "dark-edition") { echo "card-dark"; } ?>">
                <div class="card-header">
                  <span class="card-title"></span>
                </div>
                <div class="card-body">
                    <?php
                        $result = shell_exec('sudo update-pciids');
                        echo "<tr>" .
                        "<td><pre>Successfully Updated PCI-Ids: {$result}</pre></td>" .
                        "</tr>";

                        $libextension = shell_exec('sudo extension=libvirt.so');
                        If($libextension == "") {
                            echo "<tr>" .
                            "<td><pre>Successfully Updated libvirt.so</pre></td>" .
                            "</tr>";
                        } else {
                            echo "<tr>" .
                            "<td><pre><p style='color:red;'>Failed to Update libvirt.so</p></pre></td>" .
                            "</tr>";
                        }

                        $pullupdate = exec('sudo chown -R www-data .git', $output, $return_var);

                        if($pullupdate == "") {
                            echo "<tr>" .
                            "<td><pre>Git permissions added to the group</pre></td>" .
                            "</tr>";
                        } else {
                            echo "<tr>" .
                            "<td><pre><p style='color:red;'>Failed to Update git permissions</p></pre></td>" .
                            "</tr>";
                        }
                        
                    ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </main>
  <!-- </div> 
</div> end content of physical GPUs -->