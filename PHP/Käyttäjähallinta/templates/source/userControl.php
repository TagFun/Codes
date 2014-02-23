<?php include "templates/include/header2.php" ?>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
<body>
	<div id="main">

		<!-- Main Title -->
		<div class="icon"></div>
		<h1 class="title">Käyttäjähallinta</h1>
		<h5 class="title">(Etsi käyttäjiä tietokannasta etunimen tai sukunimen avulla)</h5>

		<!-- Main Input -->
		<input type="text"  id="search" autocomplete="off">

		<!-- Show Results -->
		<h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
		<ul id="results"></ul>


	</div>

</body>
</html>