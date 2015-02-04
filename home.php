<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

?>

		<div id="flexbox">

			<div id="new-story">

				<a href="new-story-form" id="form-collapse" class="spoilerButton">
					<h2>Skapa story<span class="ion-ios7-plus"></span></h2>
				</a>

				<?php require 'functions/create_story.php'; ?>

			    <script>
			    function selectSubject(event) {
			    	var selectedFriend = document.getElementById("search");
			    	var li_result = document.getElementsByClassName("result");
			        var target = event.target || event.srcElement;
			        selectedFriend.value = event.target.innerHTML;
			        for (var i=0;i<li_result.length;i+=1) {
			  			li_result[i].style.display = "none";
					}
			        return selectSubject;
			    }
			    </script>
			    <script>
			    	textarea.split(/[ ,]+/);
			    </script>
			    <script>
			    function textBoxShow() {
			    	document.getElementById("text-box").style.display = "block";
			    }
			    function textBoxHide() {
			    	document.getElementById("text-box").style.display = "none";
			    }
			    </script>

				<div id="new-story-form" class="spoiler">
					<form action="" method="post">
						<input type="text" id="search" name="subject" oninput="loadContent();" value="Freestyle" placeholder="Ämne">
						<ul id="results" onclick="selectSubject(event);" style="margin-bottom: 50px;">
						</ul>
						<div id="charCounter" style="text-align: left;">
            				<span id="charLeft">50</span> Tecken kvar
          				</div>
						<textarea id="app" name="opening_row" rows="10" cols="50" placeholder="Write something..." style="width: 300px;"></textarea><br/>
						<input type="text" name="num_of_rows" placeholder="Max antal rader..."><br />
						<input type="text" name="num_of_writers" placeholder="Max antal författare..."><br />
						<span id="question" class="ion-help-circled" onmouseover="textBoxShow();" onmouseout="textBoxHide();"></span>
						<div id="text-box" style="display: none;">Separera namn med ; och använd mellanslag.<br />Namn1; Namn2; Namn3<br />Bjud in minst två personer</div>
						<textarea rows="2" id="search" name="users" autocomplete="off" placeholder="Bjud in författare..." value="" style="resize: vertical;"></textarea><br />
						<div>
							<div>Vill du vara administratör av den här storyn?</div>
							<input type="checkbox" name="admin_yes"> Ja <input type="checkbox" name="admin_no"> Nej<br />
						</div>
						<div>
							<div>Ska den här storyn vara flexibel?</div>
							<input type="checkbox" name="flexible_yes" value="Yes"> Ja <input type="checkbox" name="flexible_no" value="No"> Nej<br />
						</div>
						<input type="submit" name="create_table" value="Skapa"><br />
					</form>
				</div>

			</div> <!-- END #NEW-STORY -->

			<div id="stories-finished">

				<h2>Färdiga stories</h2>

				<?php require 'functions/story_finished.php'; ?>

			</div> <!-- END #STORY-FINISHED -->

			<div id="existing-stories">

				<h2>Min tur</h2>

				<?php require 'functions/current_stories.php'; ?>

			</div> <!-- END #EXISTING-STORIES -->

		</div> <!-- END #FLEXBOX -->

		<!-- CHARACTER COUNTER -->
		<script src="js/char-left.js"></script>
		<!-- SPOILER FUNCTION -->
		<script src="js/spoiler.js"></script>
		<script src="js/search_subjects.js"></script>

<?php require ("footer.php"); ?>