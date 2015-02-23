<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

?>

<style>
	ul#friends li:hover {
		background: #485563;
	}
</style>

		<div id="flexbox">

			<div id="new-story">

				<a href="new-story-form" id="form-collapse" class="spoilerButton">
					<h2>Skapa story<span class="ion-ios7-plus"></span></h2>
				</a>

				<?php require 'functions/create_story.php'; ?>

			    <script>
			    function selectSubject(event) {
			    	var subject = document.getElementById("search");
			    	var li_result = document.getElementsByClassName("result");
			        var target = event.target || event.srcElement;
			        subject.value = event.target.innerHTML;
			        var subject_id = event.target.id;
			        var input = document.createElement("input");
			        input.setAttribute("type", "hidden");
			        input.setAttribute("name", "subject_id");
			        input.setAttribute("value", subject_id);
			        document.getElementById("hidden-input").appendChild(input);
			        for (var i=0;i<li_result.length;i+=1) {
			  			li_result[i].style.display = "none";
					}
			        return selectSubject;
			    }
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
					<form action="" method="post" id="create-story" onsubmit="return validate();">
						<input type="text" id="search" name="subject" oninput="loadContent();" onkeyup="textBoxShow();" value="Freestyle" placeholder="Ämne">
						<div id="hidden-input"></div>
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
						<div><a href="choose-friends" class="spoilerButton">Välj bland vänner<span class="caret"></span></a></div>
						<textarea rows="2" id="textarea" name="users" autocomplete="off" placeholder="Bjud in författare..." value="" style="resize: vertical;"></textarea><br />
						<div id="choose-friends" style="display: none;">
							<?php
							$sql_friends = sqlSelect('SELECT friends.friend_request_id, users.user_id, users.username 
	FROM users 
	INNER JOIN 
		( 
			SELECT friends.friend_request_id, 
			CASE WHEN friends.user_id = "' . $_SESSION['user_id'] . '" THEN friends.friend_user_id 
			ELSE friends.user_id END person_id 
			FROM friends 
			WHERE (friends.user_id = "' . $_SESSION['user_id'] . '" 
			OR friends.friend_user_id = "' . $_SESSION['user_id'] . '") 
			AND pending = 1 
		)	friends ON users.user_id = friends.person_id;');

if ($sql_friends) {
	echo '<ul id="friends" class="list-group" onclick="selectFriend(event);">';
	foreach ($sql_friends as $friend) { 
		echo '<li class="list-group-item" style="cursor: pointer;">' . $friend['username'] . '</li>';
	}
	echo '</ul>';
} ?>

				<script>
			    function selectFriend(event) {
			    	var textarea = document.getElementById("textarea");
			    	var li_result = document.getElementsByClassName("list-group-item");
			        var target = event.target;
			        if (target) {
			        	if (target.value == 1) {
			        		document.getElementById("textarea").value = textarea.value.replace(target.innerText + '; ', '');
			        		var span_ion = document.getElementsByClassName('ion-close-round ' + target.innerText); 
			        		span_ion[0].parentNode.removeChild(span_ion[0]);
			        		target.value = 0;
			        		
			        	} 
			        	else {
			        		textarea.value += target.innerHTML + '; ';
			        		target.innerHTML += '<span class="ion-close-round ' + target.innerText + '" style="font-size: 1em; color: #CD3700; float: right;"></span>';
			        		target.value = 1;
			        	}
			        }
			    }
			    </script>

						</div>
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

		<script>
			function validate(form) {

				var new_subject = document.getElementById('search');

				if (new_subject.value == "") {
				    confirm('Storyn har just nu inget ämne. Om inget anges kommer den att ha Freestyle som ämne.');
				}
			}
		</script>

		
		<!-- CHARACTER COUNTER -->
		<script src="js/char-left.js"></script>
		<!-- SPOILER FUNCTION -->
		<script src="js/spoiler.js"></script>
		<!-- SEARCH SUBJECTS -->
		<script src="js/search_subjects.js"></script>

<?php require ("footer.php"); ?>