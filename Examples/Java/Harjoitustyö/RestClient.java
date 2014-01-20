// Tuodaan mukaan URI-osoitteen k‰sittelyyn tarkoitettu luokka
import java.net.URI;

//Tuodaan mukaan tarvittavia Jerseyn REST core-luokkia
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.UriBuilder;

//Tuodaan mukaan tarvittavia Jerseyn luokkia REST-asiakkaan toteuttamiseksi
import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.WebResource;
import com.sun.jersey.api.client.config.ClientConfig;
import com.sun.jersey.api.client.config.DefaultClientConfig;

public class RestClient {
		public static void main() {
			
			// Luodaan osoite, joka viittaa palvelun "juureen"
			URI osoite = UriBuilder.fromUri("http://localhost:8080/restsovellus").build();
			
			// Alustetaan REST-Client, lis‰t‰‰n tieto k‰ytett‰v‰n palvelun osoitteesta
			ClientConfig asetukset = new DefaultClientConfig();
			Client asiakas = Client.create(asetukset);
			WebResource palvelu = asiakas.resource( osoite );
			
			/* Kutsutaan haluttuja palvelun tarjoamia REST-palvelun metodeja
			1) GET-kutsuun vastaava, plain/text -muodon palauttava metodi
			(tunnistaa metodin automaattisesti)
			Alla oleva kutsu muodostaa URL-osoitteen:
			http://localhost:8080:/restsovellus/rest/Oraakkeli */
			
			// Kutsutaan haluttuja palvelun tarjoamia REST-palvelun metodeja
			// GET-kutsuun vastaava, plain/text -muodon palauttava metodi (tunnistaa metodin automaattisesti)
			String vastaus = palvelu.path("rest").path("Oraakkeli").accept(MediaType.TEXT_PLAIN).get(String.class);
			System.out.println("Oraakkeli vastasi kysymykseesi: " + vastaus);
			
		}
}
