/////////////////////////////////
// ** HIBERNATEN K�YTT��NOTTO **
////////////////////////////////

// ** PERISISTOITAVA LUOKKA **
public class Asiakas {

    /*Asiakkaat yksil�iv� ID-tunniste
	HUOM! Muutettiin aiemmista esimerkeist�  
	String-merkkijonosta int -koknaisluvuksi */
    private int AsiakasID;
	
    // Asiakkaan nimi
    private String Nimi;
	
    // Asiakkaan luottoraja
    private double Luottoraja;

    // Ominaisuuksien aksessorimetodit
    public int getAsiakasID() {
            return AsiakasID;
    }

    public void setAsiakasID(int asiakasID) {
            AsiakasID = asiakasID;
    }

    public String getNimi() {
            return Nimi;
    }

    public void setNimi(String nimi) {
            Nimi = nimi;
    }

    public double getLuottoraja() {
            return Luottoraja;
    }

    public void setLuottoraja(double luottoraja) {
            Luottoraja = luottoraja;
    }

// ** HIBERNATEN K�YTT�M� KONFIGURAATIOTIEDOSTO **

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE hibernate-configuration PUBLIC "-//Hibernate/Hibernate Configuration DTD 3.0//EN"
										 "http://hibernate.sourceforge.net/hibernate-configuration-3.0.dtd">
										 
<hibernate-configuration>
  <session-factory name="">
<!-- Tietokantayhteyden asetukset -->

<!-- K�ytett�v� tietokanta-ajuri -->
<property name="hibernate.connection.driver_class">com.mysql.jdbc.Driver</property>

<!-- Tietokantapalvelimen osoite  -->
<property name="hibernate.connection.url">jdbc:mysql://localhost</property>

<!-- Yhteyden luova k�ytt�j�tunnus (ja salasana, ellei ole tyhj�)  -->
<property name="hibernate.connection.username">root</property>

<!-- K�ytett�v� tietokanta -->
<property name="hibernate.default_schema">kurssikanta</property>

<!-- Hibernaten k�ytt�m� SQL-murre (sis�lt�� tietokannan erityispiirteet) -->
<property name="hibernate.dialect">org.hibernate.dialect.MySQLDialect</property>

<!-- Luokkien mapping -tiedostot -->
  <mapping resource="Asiakas.hbm.xml"/>

  </session-factory>
</hibernate-configuration>


/* 
** "M�PP�YS" (MAPPING) -TIEDOSTO KYTKEE ASIAKAS-LUOKAN 
OMINAISUUDET ESIMERKKITIETOKANNAN ASIAKAS-TAULUN KENTTIIN** 
*/

<?xml version="1.0"?>
<!DOCTYPE hibernate-mapping PUBLIC "-//Hibernate/Hibernate Mapping DTD 3.0//EN"
                                       "http://hibernate.sourceforge.net/hibernate-mapping-3.0.dtd">

<!-- Generated 5.5.2013 11:35:34 by Hibernate Tools 3.4.0.CR1 -->

<hibernate-mapping>
  <class name="Asiakas" table="Asiakas">
    <id name="AsiakasID" type="int">
      <column name="AsiakasID"/>
      <generator class="assigned"/>
    </id>
    <property generated="never" lazy="false" name="Nimi" type="java.lang.String">
      <column name="Nimi"/>
    </property>
    <property generated="never" lazy="false" name="Luottoraja" type="double">
      <column name="Luottoraja"/>
    </property>
  </class>
</hibernate-mapping>

/* Huomioi, ett� luodut mapping-tiedostot ovat lis�tt�v� hibernate.cfg.xml -tiedoston loppuun, 
jolloin Hibernate tunnistaa ne.
	(Hibernate.cfg.xml -tiedoston loppu) */

		<!-- Luokkien ja tietokannan m�pp�ys-tiedostot -->
			<mapping resource="Asiakas.hbm.xml"/>



			
/* Nyt olemme edell� liitt�neet sovellukseemme tarvitavat luokkakirjastot, 
asettaneet tietokantayhteyden tarvitsemat parametrit (hibernate.cfg.xml), 
sek� kuvanneet sovelluksessamme luokkien ja tietokanna suhteen (Asiakas.hbm.xml).

Laaditaan seuraavaksi yksinkertainen testisovellus, joka luo olion Asiakas-luokasta, asettaa Hibernaten �p��lle� 
olioiden tietojen tallentamiseksi, muokataan luodun Asiakas-olion tietoja ja lopuksi tallennetaan tiedot Hibernaten avulla tietokantaan.  */


// ** ORM K�SITTELY� TESTAAVA SOVELLUS **

import org.hibernate.*;
import org.hibernate.cfg.Configuration;

public class HibernateSovellus {
    public static void main(String[] args) {

            /* Alustetaan Hibernate SessionFactory -luokan avulla
            configure() -metodi lukee asetukset hibernate.cfg.xml tiedostosta */
            SessionFactory sf;
			sf = new Configuration().configure().buildSessionFactory();

            // Luodaan sessio ja aloitetaan transaktio tietojen k�sittelyyn
            Session sessio = sf.openSession();
            sessio.beginTransaction();

            // Luodaan olio, ja asetetaan sille tietoja
            Asiakas asiakas = new Asiakas();
            asiakas.setNimi("ORM-testiasiakas");
            asiakas.setLuottoraja(5500.00);

            // Tallennetaan olion tiedot tietokantaan
            sessio.save( asiakas );

            // P��tet��n transaktio -> tiedot tallentuvat pysytv�sti
            sessio.getTransaction().commit();
    }

}

//Hibernaten avulla voimme my�s ladata tietokannasta aiemmin tallennettuja olioita:
	sessio.load(olio, olion_id_tietokannassa);

//Hibernaten avulla voimme my�s p�ivitt�� olioiden muuttuneet tiedot tietokantaan:
	sessio.update(olio); 

//Luonnollisesti my�s olioiden tietojen poistaminen tietokannasta onnistuu:
	sessio.delete(olio); 

