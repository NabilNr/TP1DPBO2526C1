public class Film {
    private String id;
    private String judul;
    private String genre;
    private int durasi;

    public Film() {}

    public Film(String id, String judul, String genre, int durasi) {
        this.id = id;
        this.judul = judul;
        this.genre = genre;
        this.durasi = durasi;
    }

    // Getter
    public String getId() { return id; }
    public String getJudul() { return judul; }
    public String getGenre() { return genre; }
    public int getDurasi() { return durasi; }

    // Setter
    public void setId(String id) { this.id = id; }
    public void setJudul(String judul) { this.judul = judul; }
    public void setGenre(String genre) { this.genre = genre; }
    public void setDurasi(int durasi) { this.durasi = durasi; }
}