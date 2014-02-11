import javax.faces.bean.ApplicationScoped;
import javax.faces.bean.ManagedBean;
//import javax.faces.bean.SessionScoped;
import java.io.Serializable;

	@ManagedBean
	@ApplicationScoped 
	
public class Kayttajatiedot implements Serializable {
	
	// ID mikä on "leimattu" olioon, yleensä sarjoitettu hashCodeen
	private static final long serialVersionUID = 1L;
	
	// Private muuttujat
	private int KayttajatiedotID;
	private String kTunnus;
	private String sSana;
	private String eNimi;
	private String sNimi;
	private int Ika;
	private String sPuoli;
	
	///////////////////////////////////////////////////////
	
	// Funktio "Luo"n totetuttamiseen
	public void HibernateKutsuLuo()
	{
		HibernateConnection.hibernateLuo();
	}
	
	///////////////////////////////////////////////////////
	
	// Funtion "Poista":n toteuttamiseen
	public void HibernateKutsuPoista()
	{
		HibernateConnection.hibernatePoista();
	}
	
	///////////////////////////////////////////////////////
	
	public void HibernateKutsuMuokkaa()
	{
		HibernateConnection.hibernateMuokkaa();
	}
	
	///////////////////////////////////////////////////////
	// Aksessorimetodit private muuttujien kutsumiseen
	public int getKayttajatiedotID()
	{
		return KayttajatiedotID;
	}
	
	public void setKayttajatiedotID(int uusi_KayttajatiedotID)
	{
		KayttajatiedotID = uusi_KayttajatiedotID;
	}
	
	//////////////////////////////////////////////////////
	
	public String getkTunnus()
	{
		return kTunnus;
	}
	
	public void setkTunnus(String uusi_kTunnus)
	{
		kTunnus = uusi_kTunnus;
	}
	
	//////////////////////////////////////////////////////
	
	public String getsSana()
	{
		return sSana;
	}
	
	public void setsSana(String uusi_sSana)
	{
		sSana = uusi_sSana;
	}
	
	//////////////////////////////////////////////////////
	
	public String geteNimi()
	{
		return eNimi;
	}
	
	public void seteNimi(String uusi_eNimi)
	{
		eNimi = uusi_eNimi;
	}
	
	//////////////////////////////////////////////////////
	
	public String getsNimi()
	{
		return sNimi;
	}
	
	public void setsNimi(String uusi_sNimi)
	{
		sNimi = uusi_sNimi;
	}
	
	//////////////////////////////////////////////////////
	
	public int getIka()
	{
		return Ika;
	}
	
	public void setIka(int uusi_Ika)
	{
		Ika = uusi_Ika;
	}
	
	//////////////////////////////////////////////////////
	
	public String getsPuoli()
	{
		return sPuoli;
	}
	
	public void setsPuoli(String uusi_sPuoli)
	{
		sPuoli = uusi_sPuoli;
	}
}
