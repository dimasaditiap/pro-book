package service;

import javax.xml.ws.Endpoint;

public class SOAPPublisher {
	public static void main(String[] args) {
		 Endpoint.publish("http://localhost:7000/ws/bookservice", new BookService());
	}
}
