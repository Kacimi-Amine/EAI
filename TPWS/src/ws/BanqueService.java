package ws;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import javax.jws.*;
import metier.Compte;

@WebService(serviceName = "BanqueWS")
public class BanqueService {
	@WebMethod(operationName = "ConversionEuroToDH")
	public double conversion(@WebParam(name="montant") double mt) {
		return mt*10.6;
	}
	@WebMethod	
	public Compte getCompte(@WebParam(name="code") Long code) {
		return new Compte(code,Math.random()*9000,new Date());
	}
	@WebMethod
	public List<Compte> listComptes(){
		List<Compte> comptes = new ArrayList<Compte>();
		comptes.add(new Compte(1L,Math.random()*9000,new Date()));
		comptes.add(new Compte(2L,Math.random()*9000,new Date()));
		comptes.add(new Compte(3L,Math.random()*9000,new Date()));
		return comptes;
	}
	
	
}



