/////////////////////////////////////////////////////////
// ** REST - JAX-RS -ANNOTAATIO **
import javax.ws.rs.Path;
import javax.ws.rs.GET;
import javax.ws.rs.Produces;

// Määritellään URL-osoite, josta palvelu on käytettävissä
// HTTP-pyynnön avulla.
@Path ("/testipalvelu")
public class RestPalvelu {

   // Määritellään metodi kutsuttavaksi GET-pyynnöllä
   // ja palauttavaksi teksti-muotoisen paluuarvon.
   @GET
   @Produces ("text/plain")
   
   public String testi() {

           return "Toimiiko??";
   }
}

/////////////////////////////////////////////////////////
// ** SERVLET-MÄÄRITYS **

<?xml version="1.0" encoding="UTF-8"?>
<web-app xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://java.sun.com/xml/ns/javaee" xmlns:web="http://java.sun.com/xml/ns/javaee/web-app_2_5.xsd" xsi:schemaLocation="http://java.sun.com/xml/ns/javaee http://java.sun.com/xml/ns/javaee/web-app_3_0.xsd" id="WebApp_ID" version="3.0">
 <display-name>com.testi.jersey</display-name>
        <servlet>
              <servlet-name>JerseyTest</servlet-name>
               <servlet-class>
                   com.sun.jersey.spi.container.servlet.ServletContainer
               </servlet-class>
           <load-on-startup>1</load-on-startup>

         

        </servlet>
        <servlet-mapping>
              <servlet-name>JerseyTest</servlet-name>
           <url-pattern>/rest/ *</url-pattern>
        </servlet-mapping>

</web-app>

/////////////////////////////////////////////////////////
// ** @PATH -ANNOTAATIO **

import javax.ws.rs.Path;
import javax.ws.rs.GET;
import javax.ws.rs.Produces;
import javax.ws.rs.PathParam;
@Path ("/testipalvelu")
public class RestPalvelu {

    @GET
    @Produces ("text/plain")

    public String testi() 
	{
            return "Toimiiko??”;
    }

    @GET
    @Path ("/uusimetodi")
    @Produces ("text/plain")

    public String uusimetodi()
    {
            return "Uusi metodi!!";
    }  
}

/////////////////////////////////////////////////////////
// ** @PATH -ANNOTAATIO **