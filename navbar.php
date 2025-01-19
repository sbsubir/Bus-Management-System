<header id="header" class="">
    <div class="container d-flex align-items-center">

      <a href="./index.php?page=home" class="logo mr-auto">
        <img src="assets/img/minimabus logo1.jpg" alt="Bus Logo" style="height: 100px width=280">
      </a>

      <nav class="nav-menu d-none d-lg-block" id="top-nav">
        <ul>
          <li class="nav-home"><a href="./index.php?page=home">Home</a></li>
          <li class="nav-schedule"><a href="./index.php?page=schedule">View Bus Schedule</a></li>
          <li class="nav-admin"><a href="./index.php?page=admin">Admin Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
</header>
<script>
    $(document).ready(function(){
        var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
        if(page != ''){
            $('#top-nav li').removeClass('active');
            $('#top-nav li.nav-' + page).addClass('active');
        }
        $('#manage_account').click(function(){
            uni_modal('Manage Account','manage_account.php');
        });
    });
</script>
