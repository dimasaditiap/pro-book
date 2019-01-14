package service;

import javax.jws.WebMethod;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;

@WebService
@SOAPBinding(style = SOAPBinding.Style.RPC)
public interface BookServiceInterface {
	@WebMethod
	public String searchBook(String title);
	@WebMethod
	public String detailBook(String id);
	@WebMethod
	public String buyBook(String id, int count, String accNum);
	@WebMethod
	public String recommendBook(String[] categories);
}
