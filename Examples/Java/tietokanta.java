/////////////////////////////////////////////////
// ** YHTEYDEN OTTO TIETOKANTAAN **
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class TietokantaSovellus {
    public static void main(String[] args) {

           Connection yhteys;
           Statement lause;
           ResultSet tulokset;

	String palvelin_url = "jdbc:mysql://localhost:3306/kurssikanta";
        String tunnus = “root”;
        String salas = “”;

            try {            
		// Ladataan tietokanta-ajuri (MySQL J/Connector)
		Class.forName("com.mysql.jdbc.Driver").newInstance();

		// Luodaan yhteys tietokantaan
		// Valitaan samalla käytettävä tietokanta
		yhteys = DriverManager.getConnection(palvelin_url, tunnus, salas);

                // Luodaan lauseke tietokantakyselyä varten
                lause = yhteys.createStatement();
					
		// Suoritetaan kysely ja sijoitetaan tulokset
                tulokset = lause.executeQuery("SELECT * FROM Asiakkaat"
					
                // Käsitellään tulokset jokaisesta palautetusta rivistä ...

                while ( tulokset.next() )
                {
                   // ... tietue kerrallaan
                   int AsiakasID = tulokset.getInt("AsiakasID");
                   String AsiakasNimi = tulokset.getString("Nimi");
                   double AsiakasLuottoraja = tulokset.getDouble("Luottoraja");
                     
                    // Tulostetaan tietueesta luetut tiedot
                     System.out.println("Asiakasnro: " + AsiakasID);
                     System.out.println("Nimi: " + AsiakasNimi);
                     System.out.println("Asiakas: " + AsiakasLuottoraja);
                     System.out.println();

                 }

            }    catch (Exception e) {
                    e.printStackTrace();
            }
    }
}