<?php include "templates/include/header.php" ?>
 
      <form action="index.php?action=login" name="form1" id="ff" method="post">
        <input type="hidden" name="login" value="true" />
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

  <div class="wrapper"> 
    <div id="contact_form">
    <h1>Kirjaudu sisään</h1> 
        <label>
        <span>Käyttäjätunnus*:</span>
        <input type="text" placeholder="Syötä käyttäjätunnus" name="kayttajatunnus" id="kayttajatunnus" required autofocus>
        </label>
         
        <label>
        <span>Salasana*:</span>   
        <input type="password" placeholder="Syötä salasanasi" name="salasana" id="salasana" required>
        </label>
       
        <input class="sendButton" type="submit" name="Submit" value="Kirjaudu">
             
    </form>
    </div>
   </div>
 
</body>
</html>