<div class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="home.php">Great nonsens <span style="font-family: 'Cinzel', serif;">beta</span></a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li><a href="home.php">Översikt</a></li>
      <li><a href="my_stories_2.php">Mina stories</a></li>
      <li><a href="search.php">Sök författare</a></li>
      <li><a href="subjects.php">Ämnen</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="profile_view.php">Profil</a></li>
          <li><a href="friends.php">Vänner</a></li>
          <li><a href="change_password.php">Ändra lösenord</a></li>
          <li><a href="delete_account.php">Ta bort konto</a></li>
          <li class="divider"></li>
          <li><a href="functions/logout.php">Logga ut</a></li>
        </ul>
      </li>
    </ul>
    <!--<form class="navbar-form navbar-left">
      <input type="text" class="form-control col-lg-8" placeholder="Search">
    </form>-->
  </div>
</div>