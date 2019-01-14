package service;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import java.io.BufferedInputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;

import javax.jws.WebService;
import org.apache.commons.io.IOUtils;
import org.json.JSONArray;
import org.json.JSONObject;

@WebService(endpointInterface = "service.BookServiceInterface")
public class BookService implements BookServiceInterface {
	private static final String TITLE_URL = "https://www.googleapis.com/books/v1/volumes?q=intitle:%s&maxResults=%d&startIndex=%d";
	private static final String ID_URL = "https://www.googleapis.com/books/v1/volumes/%s";
	private static final String CATEGORY_URL = "https://www.googleapis.com/books/v1/volumes?q=subject:%s&maxResults=%d&startIndex=%d";
	private static final String DB_URL = "jdbc:mysql://localhost:3306/book_ws";
	private static final String DB_USER = "root";
	private static final String DB_PASS = "";
	private ArrayList<Book> books;
	
	@Override
	public String searchBook(String title) {
		books = new ArrayList<>();
		int startIdx = 0;
		int maxResults = 40;
		String urlString = String.format(TITLE_URL, title.replace(" ", "+"), maxResults, startIdx);
		HttpURLConnection urlConnection = null;
		try {
			URL url = new URL(urlString.toString());
			urlConnection = (HttpURLConnection) url.openConnection();
			urlConnection.connect();
			while(urlConnection.getResponseCode() == 200) {
				String stringFromStream = IOUtils.toString(new BufferedInputStream(urlConnection.getInputStream()),
						"UTF-8");
				JSONObject json = new JSONObject(stringFromStream);
				if(json.has("items")) {
					JSONArray bookItems = json.getJSONArray("items");
					for (int i = 0; i < bookItems.length(); ++i) {
						JSONObject itemAtIdx = bookItems.getJSONObject(i).getJSONObject("volumeInfo");
						Book temp = new Book(bookItems.getJSONObject(i).getString("id"), itemAtIdx.getString("title"));
						if(itemAtIdx.has("publisher")) {
							temp.setPublisher(itemAtIdx.getString("publisher"));
						}
						else {
							temp.setPublisher("No Publishers found");
						}
						if(itemAtIdx.has("subtitle")) {
							temp.setSubtitle(itemAtIdx.getString("subtitle"));
						}
						if(itemAtIdx.has("publishedDate")) {
							temp.setPublishDate(itemAtIdx.getString("publishedDate"));
						}
						else {
							temp.setPublisher("No Published Date");
						}
						if(itemAtIdx.has("description")) {
							temp.setDescription(itemAtIdx.getString("description"));
						}
						else {
							temp.setDescription("No Description");
						}
						if(itemAtIdx.has("imageLinks")) {
							temp.setImageUrl(itemAtIdx.getJSONObject("imageLinks").getString("thumbnail"));
						}
						else {
							temp.setImageUrl("upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png");
						}
						if(itemAtIdx.has("authors")) {
							String[] authors = new String[itemAtIdx.getJSONArray("authors").length()];
							for (int j = 0; j < itemAtIdx.getJSONArray("authors").length(); ++j) {
								authors[j] = itemAtIdx.getJSONArray("authors").getString(j);
							}
							temp.setAuthors(authors);
						}
						else {
							String[] authors = {"No Authors Found"};
							temp.setAuthors(authors);
						}
						if(itemAtIdx.has("categories")) {
							String[] categories = new String[itemAtIdx.getJSONArray("categories").length()];
							for (int j = 0; j < itemAtIdx.getJSONArray("categories").length(); ++j) {
								categories[j] = itemAtIdx.getJSONArray("categories").getString(j);
							}
							temp.setCategories(categories);
						}
						else {
							String[] categories = {"No Categories Found"};
							temp.setCategories(categories);
						}
						JSONObject saleInfo = bookItems.getJSONObject(i).getJSONObject("saleInfo");
						if(saleInfo.has("listPrice")) {
							temp.setPrice(saleInfo.getJSONObject("listPrice").getInt("amount"));
						}
						else {
							temp.setPrice(-1);
						}
						updateDatabase(temp);
						books.add(temp);
					}
					startIdx += maxResults;
					urlString = String.format(TITLE_URL, title.replace(" ", "+"), maxResults, startIdx);
					url = new URL(urlString.toString());
					urlConnection = (HttpURLConnection) url.openConnection();
					urlConnection.connect();
				}
				else {
					break;
				}
			}
		} 
		catch (Exception e) {
			e.printStackTrace();
		} 
		finally {
			if (urlConnection != null) {
				urlConnection.disconnect();
			}
		}
		GsonBuilder gsonBuilder = new GsonBuilder();
		Gson gson = gsonBuilder.create();
		String booksjson = gson.toJson(books);
		return booksjson;
	}
	
	@Override
	public String detailBook(String id) {
		books = new ArrayList<>();
		String urlString = String.format(ID_URL, id);
		HttpURLConnection urlConnection = null;
		try {
			URL url = new URL(urlString.toString());
			urlConnection = (HttpURLConnection) url.openConnection();
			urlConnection.connect();
			if(urlConnection.getResponseCode() == 200) {
				Book book;
				String stringFromStream = IOUtils.toString(new BufferedInputStream(urlConnection.getInputStream()),
						"UTF-8");
				JSONObject json = new JSONObject(stringFromStream);
				JSONObject bookInfo = json.getJSONObject("volumeInfo");
				book = new Book(id, bookInfo.getString("title"));
				if(bookInfo.has("publisher")) {
					book.setPublisher(bookInfo.getString("publisher"));
				}
				else {
					book.setPublisher("No Publishers found");
				}
				if(bookInfo.has("subtitle")) {
					book.setSubtitle(bookInfo.getString("subtitle"));
				}
				if(bookInfo.has("publishedDate")) {
					book.setPublishDate(bookInfo.getString("publishedDate"));
				}
				else {
					book.setPublisher("No Published Date");
				}
				if(bookInfo.has("description")) {
					book.setDescription(bookInfo.getString("description"));
				}
				else {
					book.setDescription("No Description");
				}
				if(bookInfo.has("imageLinks")) {
					book.setImageUrl(bookInfo.getJSONObject("imageLinks").getString("thumbnail"));
				}
				else {
					book.setImageUrl("//upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png");
				}
				if(bookInfo.has("authors")) {
					String[] authors = new String[bookInfo.getJSONArray("authors").length()];
					for (int j = 0; j < bookInfo.getJSONArray("authors").length(); ++j) {
						authors[j] = bookInfo.getJSONArray("authors").getString(j);
					}
					book.setAuthors(authors);
				}
				else {
					String[] authors = {"No Authors Found"};
					book.setAuthors(authors);
				}
				if(bookInfo.has("categories")) {
					String[] categoriesAPI = new String[bookInfo.getJSONArray("categories").length()];
					for (int j = 0; j < bookInfo.getJSONArray("categories").length(); ++j) {
						categoriesAPI[j] = bookInfo.getJSONArray("categories").getString(j);
					}
					book.setCategories(categoriesAPI);
				}
				else {
					String[] categoriesAPI = {"No Categories Found"};
					book.setCategories(categoriesAPI);
				}
				JSONObject saleInfo = json.getJSONObject("saleInfo");
				if(saleInfo.has("listPrice")) {
					book.setPrice(saleInfo.getJSONObject("listPrice").getInt("amount"));
				}
				updateDatabase(book);
				books.add(book);
			}
		} 
		catch (Exception e) {
			e.printStackTrace();
		} 
		finally {
			if (urlConnection != null) {
				urlConnection.disconnect();
			}
		}
		GsonBuilder gsonBuilder = new GsonBuilder();
		Gson gson = gsonBuilder.create();
		String booksjson = gson.toJson(books);
		return booksjson;
	}
	
	public void updateDatabase(Book b) {
		Connection connect = null;
	    PreparedStatement preparedStatement = null;
	    try {
	    	connect = DriverManager.getConnection(DB_URL, DB_USER, DB_PASS);
	    	preparedStatement = connect
                    .prepareStatement("insert into books values (?, ?, ?, ?, ? , ?, ?, ?)");
	    	preparedStatement.setString(1, b.getId());
            preparedStatement.setString(2, b.getTitle());
            preparedStatement.setString(3, b.getSubtitle());
            preparedStatement.setString(4, b.getPublisher());
            preparedStatement.setString(5, b.getPublishDate());
            preparedStatement.setString(6, b.getDescription());
            preparedStatement.setString(7, b.getImageUrl());
            if(b.getPrice() == 0) {
            	b.setPrice(-1);
            }
            preparedStatement.setInt(8, b.getPrice());
            preparedStatement.executeUpdate();
            preparedStatement = connect
            		.prepareStatement("insert into categories values (?, ?)");
            preparedStatement.setString(1, b.getId());
            for(String c : b.getCategories()) {
            	preparedStatement.setString(2, c);
            	preparedStatement.executeUpdate();
            }
            preparedStatement = connect
            		.prepareStatement("insert into authors values (?, ?)");
            preparedStatement.setString(1, b.getId());
            for(String a : b.getAuthors()) {
            	preparedStatement.setString(2, a);
            	preparedStatement.executeUpdate();
            }
	    } 
	    catch(SQLException e) {
	    	e.printStackTrace();
	    } 
	    finally {
	    	try{
	    		if(connect != null)
	    			connect.close();
	    	} 
	    	catch(SQLException e){
	    		e.printStackTrace();
	    	}
	    }
	}

	@SuppressWarnings("resource")
	@Override
	public String recommendBook(String[] categories) {
		class Order{
			String id;
			int quantity;
			Order(String id, int quantity){
				this.id = id;
				this.quantity = quantity;
			}
			@Override
			public String toString() {
				return id + " " + quantity;
			}
		}
		Connection connect = null;
	    PreparedStatement preparedStatement = null;
	    ResultSet resultSet = null;
	    books = new ArrayList<>();
		@SuppressWarnings("unchecked")
		List<Order>[] resultIDs = new List[categories.length];
		try {
	    	connect = DriverManager.getConnection(DB_URL, DB_USER, DB_PASS);
	    	int i = 0;
	    	for(String c : categories) {
		    	preparedStatement = connect
	                    .prepareStatement("select orders.book_id, quantity from orders inner join categories on (orders.book_id = categories.book_id) where category like ?");
		    	preparedStatement.setString(1, "%" + c + "%");
	            resultSet = preparedStatement.executeQuery();
	            resultIDs[i] = new ArrayList<>();
	            while(resultSet.next()) {
	            	resultIDs[i].add(new Order(resultSet.getString("book_id"), resultSet.getInt("quantity")));
	            }
	            i++;
	    	}
	    	for(List<Order> as : resultIDs) {
	    		System.out.println(as.toString());
	    	}
	    	ArrayList<Order> reccBooks = new ArrayList<Order>();
	    	if(categories.length > 1) {
	    		for(Order o1 : resultIDs[0]) {
	    			boolean ins = true;
	    			for(int j = 1; j < i; ++j) {
	    				boolean eq = false;
	    				for(Order o2: resultIDs[j]) {
	    					if(o1.id.equals(o2.id)) {
	    						eq = true;
	    						break;
	    					}
	    				}
	    				if(!eq) {
	    					ins = false;
	    					break;
	    				}
	    			}
	    			if(ins) {
	    				reccBooks.add(o1);
	    			}
	    		}
	    	}
	    	else {
	    		for(Order o : resultIDs[0]) {
	    			reccBooks.add(o);
	    		}
	    	}
	    	for(Order o : reccBooks) {
	    		System.out.println(o.id);
	    	}
	    	Book reccBook;
	    	if(reccBooks.isEmpty()) {
	    		int startIdx = 0;
	    		int maxResults = 1;
	    		String urlString = String.format(CATEGORY_URL, categories[randomInt(0, categories.length)].replace(" ", "+"), maxResults, startIdx);
	    		HttpURLConnection urlConnection = null;
	    		try {
	    			URL url = new URL(urlString.toString());
	    			urlConnection = (HttpURLConnection) url.openConnection();
	    			urlConnection.connect();
	    			if(urlConnection.getResponseCode() == 200) {
	    				String stringFromStream = IOUtils.toString(new BufferedInputStream(urlConnection.getInputStream()),
	    						"UTF-8");
	    				JSONObject json = new JSONObject(stringFromStream);
	    				if(json.has("items")) {
	    					String bookID = json.getJSONArray("items").getJSONObject(0).getString("id");
	    					JSONObject bookInfo = json.getJSONArray("items").getJSONObject(0).getJSONObject("volumeInfo");
	    					reccBook = new Book(bookID, bookInfo.getString("title"));
	    					if(bookInfo.has("publisher")) {
								reccBook.setPublisher(bookInfo.getString("publisher"));
							}
							else {
								reccBook.setPublisher("No Publishers found");
							}
							if(bookInfo.has("subtitle")) {
								reccBook.setSubtitle(bookInfo.getString("subtitle"));
							}
							if(bookInfo.has("publishedDate")) {
								reccBook.setPublishDate(bookInfo.getString("publishedDate"));
							}
							else {
								reccBook.setPublisher("No Published Date");
							}
							if(bookInfo.has("description")) {
								reccBook.setDescription(bookInfo.getString("description"));
							}
							else {
								reccBook.setDescription("No Description");
							}
							if(bookInfo.has("imageLinks")) {
								reccBook.setImageUrl(bookInfo.getJSONObject("imageLinks").getString("thumbnail"));
							}
							else {
								reccBook.setImageUrl("//upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png");
							}
							if(bookInfo.has("authors")) {
								String[] authors = new String[bookInfo.getJSONArray("authors").length()];
								for (int j = 0; j < bookInfo.getJSONArray("authors").length(); ++j) {
									authors[j] = bookInfo.getJSONArray("authors").getString(j);
								}
								reccBook.setAuthors(authors);
							}
							else {
								String[] authors = {"No Authors Found"};
								reccBook.setAuthors(authors);
							}
							if(bookInfo.has("categories")) {
								String[] categoriesAPI = new String[bookInfo.getJSONArray("categories").length()];
								for (int j = 0; j < bookInfo.getJSONArray("categories").length(); ++j) {
									categoriesAPI[j] = bookInfo.getJSONArray("categories").getString(j);
								}
								reccBook.setCategories(categoriesAPI);
							}
							else {
								String[] categoriesAPI = {"No Categories Found"};
								reccBook.setCategories(categoriesAPI);
							}
							JSONObject saleInfo = json.getJSONArray("items").getJSONObject(0).getJSONObject("saleInfo");
							if(saleInfo.has("listPrice")) {
								reccBook.setPrice(saleInfo.getJSONObject("listPrice").getInt("amount"));
							}
							updateDatabase(reccBook);
							books.add(reccBook);
	    				}
	    			}
	    		}	
	    		catch (Exception e) {
	    				e.printStackTrace();
	    			} 
    			finally {
    				if (urlConnection != null) {
    					urlConnection.disconnect();
    				}
    			}
	    	}
	    	else {
	    		Order maxOrder = null;
	    		int maxQuantity = -1;
	    		for(Order o : reccBooks) {
	    			if(o.quantity > maxQuantity) {
	    				maxOrder = o;
	    				maxQuantity = o.quantity;
	    			}
	    		}
	    		preparedStatement = connect
	                    .prepareStatement("select * from books where id = ?");
		    	preparedStatement.setString(1, maxOrder.id);
	            resultSet = preparedStatement.executeQuery();
	            resultSet.next();
	            reccBook = new Book(resultSet.getString("id"), resultSet.getString("title"));
	            reccBook.setSubtitle(resultSet.getString("subtitle"));
	            reccBook.setPublisher(resultSet.getString("publisher"));
	            reccBook.setPublishDate(resultSet.getString("publish_date"));
	            reccBook.setDescription(resultSet.getString("description"));
	            reccBook.setImageUrl(resultSet.getString("imageUrl"));
	            reccBook.setPrice(resultSet.getInt("price"));
	            books.add(reccBook);
	    	}
	    } 
		catch(SQLException e) {
	    	e.printStackTrace();
	    } 
		finally {
	    	try{
	    		if(connect != null) {
	    			connect.close();
	    		}
	    		if(resultSet != null) {
	    			resultSet.close();
	    		}
	    	} 
	    	catch(SQLException e){
	    		e.printStackTrace();
	    	}
	    }
		GsonBuilder gsonBuilder = new GsonBuilder();
		Gson gson = gsonBuilder.create();
		String booksjson = gson.toJson(books);
		return booksjson;
	}
	
	@Override
	public String buyBook(String id, int quantity, String accNum) {
		Connection connect = null;
	    PreparedStatement preparedStatement = null;
	    ResultSet resultSet = null;
	    boolean success = false;
	    try {
	    	connect = DriverManager.getConnection(DB_URL, DB_USER, DB_PASS);
	    	preparedStatement = connect
                    .prepareStatement("select price from books where id = ?");
	    	preparedStatement.setString(1, id);
            resultSet = preparedStatement.executeQuery();
            int price = resultSet.getInt("price");
            //consume bank webservice
            
            if(success) {
            	preparedStatement = connect
                        .prepareStatement("insert into orders (book_id, quantity, total_price) values (?, ?, ?)");
    	    	preparedStatement.setString(1, id);
    	    	preparedStatement.setInt(2, quantity);
    	    	preparedStatement.setInt(3, price * quantity);
    	    	preparedStatement.executeUpdate();
            }
	    } 
	    catch(SQLException e) {
	    	e.printStackTrace();
	    } 
	    finally {
	    	try{
	    		if(connect != null) {
	    			connect.close();
	    		}
	    		if(resultSet != null) {
	    			resultSet.close();
	    		}
	    	} 
	    	catch(SQLException e){
	    		e.printStackTrace();
	    	}
	    }
	    if(success) {
	    	return "1";
	    }
	    else {
	    	return "0";
	    }
	}
	
	public ArrayList<Book> getBooks() {
		return books;
	}

	public void setBooks(ArrayList<Book> books) {
		this.books = books;
	}
	
	public int randomInt(int min, int max) {

		if (min >= max) {
			throw new IllegalArgumentException("max must be greater than min");
		}

		Random r = new Random();
		return r.nextInt((max - min) + 1) + min;
	}
}
