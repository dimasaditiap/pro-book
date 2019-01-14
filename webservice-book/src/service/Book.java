package service;
import java.util.Arrays;

public class Book {
	private String id;
	private String title;
	private String subtitle;
	private String publisher;
	private String publishDate;
	private String description;
	private String imageUrl;
	private String[] categories;
	private String[] authors;
	private int price;

	public Book(String id, String title) {
		this.id = id;
		this.title = title;
		this.subtitle = "";
		this.publisher = "";
		this.publishDate = "";
		this.description = "";
		this.imageUrl = "";
		this.price = 0;
	}

	@Override
	public String toString() {
		return "Book [id=" + id + ", title=" + title + ", subtitle=" + subtitle + ", publisher=" + publisher
				+ ", publish_date=" + publishDate + ", description=" + description + ", imageUrl=" + imageUrl
				+ ", categories=" + Arrays.toString(categories) + ", authors=" + Arrays.toString(authors) + ", price="
				+ price + "]";
	}

	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getSubtitle() {
		return subtitle;
	}

	public void setSubtitle(String subtitle) {
		this.subtitle = subtitle;
	}

	public String getPublisher() {
		return publisher;
	}

	public void setPublisher(String publisher) {
		this.publisher = publisher;
	}

	public String getPublishDate() {
		return publishDate;
	}

	public void setPublishDate(String publishDate) {
		this.publishDate = publishDate;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public String getImageUrl() {
		return imageUrl;
	}

	public void setImageUrl(String imageUrl) {
		this.imageUrl = imageUrl;
	}

	public String[] getCategories() {
		return categories;
	}

	public void setCategories(String[] categories) {
		this.categories = categories;
	}

	public String[] getAuthors() {
		return authors;
	}

	public void setAuthors(String[] authors) {
		this.authors = authors;
	}

	public int getPrice() {
		return price;
	}

	public void setPrice(int price) {
		this.price = price;
	}
}
