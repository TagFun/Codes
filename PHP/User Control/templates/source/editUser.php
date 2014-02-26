<?php include "templates/include/header.php" ?>
 
<form action="index.php?action=editUser" name="form1" id="ff" method="get">
        <input type="hidden" name="editUser" value="true" />

  <div class="wrapper"> 
    <div id="contact_form">
    <h1>Muokkaa henkilön <?php echo $result[0]['Etunimi']; ?> tietoja</h1> 
	  <label>
        <span>Käyttäjätaso*:</span>
   		<select name="kayttajataso">required autofocus>
  			<option value="admin">Admin</option>
  			<option value="user">User</option>
		</select>
        </label>
         
	 <label>
	 <input type="hidden" name="ID" id="ID" value= "<?php echo $result[0]['ID']; ?>">

        <span>Käyttäjätunnus*:</span>   
        <input type="text" placeholder="<?php echo $result[0]['Kayttajatunnus']; ?>" name="kayttajatunnus" id="kayttajatunnus">
        </label>

        <label>
        <span>Salasana*:</span>   
        <input type="password" placeholder="<?php echo $result[0]['Salasana']; ?>" name="salasana" id="salasana">
        </label>

	<label>
        <span>Etunimi*:</span>   
        <input type="text" placeholder="<?php echo $result[0]['Etunimi']; ?>" name="etunimi" id="etunimi">
        </label>

	<label>
        <span>Sukunimi*:</span>   
        <input type="text" placeholder="<?php echo $result[0]['Sukunimi']; ?>" name="sukunimi" id="sukunimi">
        </label>

	<label>
        <span>Ikä*:</span>   
        <input type="number" placeholder="<?php echo $result[0]['Ika']; ?>" name="ika" id="ika">
        </label>

	<label>
        <span>Sukupuoli*:</span>   
        <input type="text" placeholder="<?php echo $result[0]['Sukupuoli']; ?>" name="sukupuoli" id="sukupuoli">
        </label>

	<label>
        <span>Yritys:</span>   
        <input type="text" placeholder="<?php echo $result[0]['Yritys']; ?>" name="yritys" id="yritys">
        </label>

	<label>
        <span>Puhelinnumero:</span>   
        <input type="number" placeholder="<?php echo $result[0]['Puhnum']; ?>" name="puhnum" id="puhnum">
        </label>
       
        <input class="sendButton" type="submit" name="Submit" value="Muokkaa tietoja">
             
    </form>
    </div>
   </div>
 
</body>
</html>
